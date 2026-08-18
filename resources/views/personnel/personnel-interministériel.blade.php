@extends('template')
@section('layout')

<section class="ministerial-staff-section">
    <div class="ministerial-bg"></div>
    
    <div class="ministerial-content">
        <span class="staff-badge">Administration Centrale</span>
        <h2 class="staff-title">Personnel Interministériel</h2>
        
        <div class="staff-categories">
            <div class="category-pill" data-target="cabinet">
             Cabinet
            </div>
            <div class="category-pill" data-target="directions">
                 Directions
            </div>
            <div class="category-pill" data-target="services">
                Services
            </div>
            <div class="category-pill" data-target="experts">
              Experts
            </div>
        </div>

        <p class="staff-description" id="staffText">
            L'excellence administrative au service de l'État. Sélectionnez une entité pour découvrir les rôles stratégiques et opérationnels.
        </p>
        
        <div class="staff-actions">
            <a href="#" class="btn-staff-explore" id="mainStaffBtn">
                <span class="btn-text">Découvrir l'organigramme</span>
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
    /* Structure de base respectant tes 450px */
    .ministerial-staff-section {
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

    .ministerial-bg {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        /* Image suggérée : Façade de ministère ou bureau officiel */
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    /* Overlay : Dégradé plus "institutionnel" (Bleu nuit vers transparent) */
    .ministerial-staff-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.4) 100%);
        z-index: 2;
    }

    .ministerial-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 800px;
        width: 90%;
        padding: 40px;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.05);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.12);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .ministerial-content.is-visible { opacity: 1; transform: translateY(0); }

    .staff-badge {
        display: inline-block;
        background: #007bff; /* Bleu plus sobre pour le ministériel */
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .staff-title { font-size: 2.8rem; margin-bottom: 15px; font-weight: 800; text-transform: uppercase; }
    .staff-title span { color: #007bff; }

    .staff-categories {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .category-pill {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-pill:hover, .category-pill.active {
        background: #007bff;
        border-color: #007bff;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 86, 179, 0.4);
    }

    .staff-description {
        font-size: 1.05rem;
        margin-bottom: 30px;
        line-height: 1.6;
        min-height: 55px;
        color: rgba(255,255,255,0.9);
        font-weight: 300;
    }

    /* Bouton avec l'effet magnétique conservé */
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
    .btn-circle svg { width: 20px; z-index: 2; transition: transform 0.5s ease; }
    .btn-staff-explore:hover svg { transform: rotate(90deg); } /* Rotation différente pour varier */

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
    const section = document.querySelector('.ministerial-staff-section');
    const content = document.querySelector('.ministerial-content');
    const bg = document.querySelector('.ministerial-bg');
    const btn = document.querySelector('.btn-staff-explore');
    const textElement = document.getElementById('staffText');
    const pills = document.querySelectorAll('.category-pill');

    const ministerialData = {
        cabinet: "<strong>Le Cabinet :</strong> Collaborateurs directs du Ministre. Ils assurent le pilotage politique, la communication et l'agenda stratégique.",
        directions: "<strong>Directions Générales :</strong> Les piliers opérationnels du ministère. Responsables de l'application des politiques publiques.",
        services: "<strong>Services Communs :</strong> Gestion des ressources humaines, logistique et finances pour assurer la continuité administrative.",
        experts: "<strong>Conseillers Techniques :</strong> Experts sectoriels chargés d'apporter une vision pointue sur des dossiers spécifiques."
    };

    // Intersection Observer pour l'animation d'entrée
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) content.classList.add('is-visible');
        });
    }, { threshold: 0.2 });
    observer.observe(section);

    // Interaction au clic sur les pilules
    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            const target = pill.getAttribute('data-target');
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            
            textElement.style.opacity = 0;
            textElement.style.transform = "translateY(10px)";
            
            setTimeout(() => {
                textElement.innerHTML = ministerialData[target];
                textElement.style.opacity = 1;
                textElement.style.transform = "translateY(0)";
            }, 250);
        });
    });

    // Effet Parallaxe et Magnétisme
    section.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const xBg = (clientX / window.innerWidth - 0.5) * 20;
        const yBg = (clientY / window.innerHeight - 0.5) * 20;
        bg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.08)`;

        const rect = btn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        if(dist < 120) {
            const xMove = (clientX - (rect.left + rect.width/2)) * 0.4;
            const yMove = (clientY - (rect.top + rect.height/2)) * 0.4;
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