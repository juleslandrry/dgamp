@extends('template')
@section('layout')

<section class="maritime-titles-section">
    <div class="titles-background"></div>
    <div class="titles-content">
        <span class="titles-badge">Carrière & Compétences</span>
        <h1 class="titles-title">Titres Maritimes</h1>
        <p class="titles-description">Valorisez votre expertise en mer. Nous délivrons les brevets, certificats et titres professionnels attestant de vos qualifications selon les standards internationaux STCW.</p>
        
        <div class="titles-actions">
            <a href="#" class="btn-titles-explore">
                <span class="btn-text">voir plus</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 15L15 12M15 12L12 9M15 12H9M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<style>
    .maritime-titles-section {
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

    .titles-background {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        /* Image suggérée : Un sextant, une boussole en laiton ou un officier de marine en uniforme */
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    /* Overlay élégant : dégradé bleu-noir royal */
    .maritime-titles-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.6) 100%);
        z-index: 2;
    }

    .titles-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 700px;
        padding: 35px;
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.03);
        border-radius: 24px;
        border: 1px solid rgba(212, 175, 55, 0.2); /* Bordure dorée très subtile */
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.9s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .titles-content.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .titles-badge {
        display: inline-block;
        background: #007bff; /* Or / Laiton */
        color: #ffffff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .titles-title {
        font-size: 2.6rem;
        margin-bottom: 12px;
        font-weight: 800;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }

    .titles-description {
        font-size: 1.05rem;
        margin-bottom: 30px;
        opacity: 0.9;
        font-weight: 300;
        line-height: 1.6;
    }

    /* Bouton Magnétique "Officer Class" */
    .btn-titles-explore {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.4s ease;
    }

    .btn-titles-explore,
    .btn-titles-explore:hover,
    .btn-titles-explore:focus,
    .btn-titles-explore:active {
        text-decoration: none !important;
    }

    .btn-circle {
        width: 48px;
        height: 48px;
        border: 1px solid rgba(212, 175, 55, 0.5);
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

    .btn-titles-explore:hover .btn-circle::before { top: 0; }
    .btn-titles-explore:hover .btn-text { color: #007bff; }
    
    .btn-circle svg { 
        width: 22px; 
        z-index: 2; 
        transition: all 0.3s ease;
    }
    
    .btn-titles-explore:hover svg { 
        stroke: #000;
        transform: scale(1.1);
    }

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-titles-explore:hover .btn-text,
    .btn-titles-explore:focus .btn-text {
        text-decoration: none !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const titlesSec = document.querySelector('.maritime-titles-section');
    const titlesCont = document.querySelector('.titles-content');
    const titlesBg = document.querySelector('.titles-background');
    const titlesBtn = document.querySelector('.btn-titles-explore');

    const titlesObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) titlesCont.classList.add('is-visible');
        });
    }, { threshold: 0.2 });

    titlesObs.observe(titlesSec);

    titlesSec.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        
        // Parallaxe lent (effet prestige)
        const xBg = (clientX / window.innerWidth - 0.5) * 12;
        const yBg = (clientY / window.innerHeight - 0.5) * 12;
        titlesBg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.08)`;

        // Magnétisme
        const rect = titlesBtn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        
        if(dist < 130) {
            const xMove = (clientX - (rect.left + rect.width/2)) * 0.3;
            const yMove = (clientY - (rect.top + rect.height/2)) * 0.3;
            titlesBtn.style.transform = `translate(${xMove}px, ${yMove}px)`;
        } else {
            titlesBtn.style.transform = `translate(0, 0)`;
        }
    });

    titlesSec.addEventListener('mouseleave', () => {
        titlesBg.style.transform = `translate(0, 0) scale(1)`;
        titlesBtn.style.transform = `translate(0, 0)`;
    });
});
</script>

@endsection