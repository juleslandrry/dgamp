@extends('template')
@section('layout')

<section class="military-staff-section">
    <div class="military-staff-bg"></div>
    
    <div class="military-staff-content">
        <span class="staff-badge">Marine Nationale</span>
        <h2 class="staff-title">Personnel Maritime</h2>
        
        <div class="staff-categories">
            <div class="category-pill" data-target="officiers">
                Officiers
            </div>
            <div class="category-pill" data-target="mariniers">
                Mariniers
            </div>
            <div class="category-pill" data-target="matelots">
                Matelots
            </div>
            <div class="category-pill" data-target="special">
             Spécialités
            </div>
        </div>

        <p class="staff-description" id="staffText">
           
                Le <strong>personnel maritime militaire</strong> désigne l'ensemble des militaires servant au sein de la marine nationale. 
                Organisés en une <strong>hiérarchie stricte</strong>, ils assurent des missions de commandement, d'encadrement et d'exécution.
    
        </p>
        <div class="staff-actions">
            <a href="#" class="btn-staff-explore" id="mainStaffBtn">
                <span class="btn-text">Consulter la hiérarchie</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L12 22M12 2L15 5M12 2L9 5M22 12H2M19 15L22 12L19 9M5 9L2 12L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<style>
    .military-staff-section {
        position: relative;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        padding-top: 20px;
        box-sizing: border-box;
    }

    .military-staff-bg {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    .military-staff-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.4) 100%);
        z-index: 2;
    }

    .military-staff-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 800px;
        width: 90%;
        padding: 40px;
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.03);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.1);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }

    .military-staff-content.is-visible { opacity: 1; transform: translateY(0); }

    .staff-badge {
        display: inline-block;
        background: #007bff;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .staff-title { font-size: 2.8rem; margin-bottom: 15px; font-weight: 800; text-transform: uppercase; }
    .staff-title span { color: #007bff; }

    /* Pills Navigation */
    .staff-categories {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .category-pill {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .category-pill:hover, .category-pill.active {
        background: #007bff;
        border-color: #007bff;
        transform: translateY(-3px);
    }

    .staff-description {
        font-size: 1rem;
        margin-bottom: 30px;
        line-height: 1.6;
        min-height: 50px;
        color: rgba(255,255,255,0.8);
    }

    /* Button Style identique au modèle */
    .btn-staff-explore {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.4s ease;
    }

    .btn-staff-explore,
    .btn-staff-explore:hover,
    .btn-staff-explore:focus,
    .btn-staff-explore:active {
        text-decoration: none !important;
    }

    .btn-circle {
        width: 45px; height: 45px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden;
    }

    .btn-circle::before {
        content: ''; position: absolute; top: 100%; left: 0; width: 100%; height: 100%;
        background: #007bff; transition: all 0.4s ease; z-index: 1;
    }

    .btn-staff-explore:hover .btn-circle::before { top: 0; }
    .btn-staff-explore:hover .btn-text { color: #007bff; }
    .btn-circle svg { width: 20px; z-index: 2; transition: transform 0.4s ease; }
    .btn-staff-explore:hover svg { transform: rotate(180deg); }

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-staff-explore:hover .btn-text,
    .btn-staff-explore:focus .btn-text {
        text-decoration: none !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.military-staff-section');
    const content = document.querySelector('.military-staff-content');
    const bg = document.querySelector('.military-staff-bg');
    const btn = document.querySelector('.btn-staff-explore');
    const textElement = document.getElementById('staffText');
    const pills = document.querySelectorAll('.category-pill');

    const dataContent = {
        officiers: "<strong>Officiers :</strong> Commandement et stratégie. Responsables de la conduite des navires et des opérations navales majeures.",
        mariniers: "<strong>Officiers Mariniers :</strong> L'épine dorsale technique. Ils encadrent les équipes et gèrent les systèmes complexes.",
        matelots: "<strong>Matelots :</strong> Force d'exécution opérationnelle. Experts en manœuvre, navigation et sécurité à bord.",
        special: "<strong>Spécialités :</strong> Fusiliers marins, plongeurs, mécaniciens et électroniciens. L'expertise pointue au combat."
    };

    // Apparition
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) content.classList.add('is-visible');
        });
    }, { threshold: 0.2 });
    observer.observe(section);

    // Changement de contenu au clic sur les pills
    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            const target = pill.getAttribute('data-target');
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            
            textElement.style.opacity = 0;
            setTimeout(() => {
                textElement.innerHTML = dataContent[target];
                textElement.style.opacity = 1;
            }, 200);
        });
    });

    // Parallaxe & Magnétisme
    section.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const xBg = (clientX / window.innerWidth - 0.5) * 15;
        const yBg = (clientY / window.innerHeight - 0.5) * 15;
        bg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.05)`;

        const rect = btn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        if(dist < 100) {
            const xMove = (clientX - (rect.left + rect.width/2)) * 0.3;
            const yMove = (clientY - (rect.top + rect.height/2)) * 0.3;
            btn.style.transform = `translate(${xMove}px, ${yMove}px)`;
        } else {
            btn.style.transform = `translate(0, 0)`;
        }
    });

    section.addEventListener('mouseleave', () => {
        bg.style.transform = `translate(0, 0) scale(1)`;
        btn.style.transform = `translate(0, 0)`;
    });
});
</script>

@endsection