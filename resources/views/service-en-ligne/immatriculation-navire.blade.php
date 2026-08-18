@extends('template')
@section('layout')

<section class="ship-reg-section">
    <div class="ship-background"></div>
    <div class="ship-content">
        <span class="ship-badge">Autorité Maritime</span>
        <h1 class="ship-title">Immatriculation des Navires</h1>
        <p class="ship-description">Officialisez votre présence en mer. Nous gérons l'enregistrement, le pavillon et la conformité de votre flotte avec une précision rigoureuse.</p>
        
        <div class="ship-actions">
            <a href="#" class="btn-ship-explore">
                <span class="btn-text">Consulter le registre</span>
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
    /* Section compacte (450px comme demandé précédemment) */
    .ship-reg-section {
        position: relative;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        padding-top: 20px; /* Espace entre les deux rubriques, sans laisser apparaître le blanc */
        box-sizing: border-box;
    }

    .ship-background {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        /* Utilise une image de proue de navire ou de mer profonde */
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    /* Overlay bleu nuit pour l'aspect maritime */
    .ship-reg-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.4) 100%);
        z-index: 2;
    }

    .ship-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 700px;
        padding: 30px;
        backdrop-filter: blur(4px);
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.08);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }

    .ship-content.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .ship-badge {
        display: inline-block;
        background: #007bff; /* Bleu mer vif */
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .ship-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .ship-description {
        font-size: 1rem;
        margin-bottom: 25px;
        opacity: 0.85;
        font-weight: 300;
    }

    /* Bouton Magnétique Maritime */
    .btn-ship-explore {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.4s ease;
    }

    .btn-ship-explore,
    .btn-ship-explore:hover,
    .btn-ship-explore:focus,
    .btn-ship-explore:active {
        text-decoration: none !important;
    }

    .btn-circle {
        width: 45px;
        height: 45px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .btn-circle::before {
        content: '';
        position: absolute;
        top: 100%; left: 0; width: 100%; height: 100%;
        background: #007bff;
        transition: all 0.4s ease;
        z-index: 1;
    }

    .btn-ship-explore:hover .btn-circle::before { top: 0; }
    .btn-ship-explore:hover .btn-text { color: #007bff; }
    
    .btn-circle svg { 
        width: 20px; 
        z-index: 2; 
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }
    
    .btn-ship-explore:hover svg { transform: rotate(180deg); } /* Effet boussole */

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-ship-explore:hover .btn-text,
    .btn-ship-explore:focus .btn-text {
        text-decoration: none !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sSection = document.querySelector('.ship-reg-section');
    const sContent = document.querySelector('.ship-content');
    const sBg = document.querySelector('.ship-background');
    const sBtn = document.querySelector('.btn-ship-explore');

    // Apparition
    const sObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) sContent.classList.add('is-visible');
        });
    }, { threshold: 0.2 });

    sObserver.observe(sSection);

    // Parallaxe & Magnétisme
    sSection.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        
        // Fond
        const xBg = (clientX / window.innerWidth - 0.5) * 15;
        const yBg = (clientY / window.innerHeight - 0.5) * 15;
        sBg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.05)`;

        // Bouton
        const rect = sBtn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        
        if(dist < 100) {
            const xMove = (clientX - (rect.left + rect.width/2)) * 0.3;
            const yMove = (clientY - (rect.top + rect.height/2)) * 0.3;
            sBtn.style.transform = `translate(${xMove}px, ${yMove}px)`;
        } else {
            sBtn.style.transform = `translate(0, 0)`;
        }
    });

    sSection.addEventListener('mouseleave', () => {
        sBg.style.transform = `translate(0, 0) scale(1)`;
        sBtn.style.transform = `translate(0, 0)`;
    });
});
</script>


@endsection