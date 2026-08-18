@extends('template')
@section('layout')

<section class="visa-section">
    <div class="visa-background"></div>
    <div class="visa-content">
        <span class="visa-badge">Services Officiels</span>
        <h1 class="ship-title">Agrément & Visa</h1>
        <p class="visa-description">Simplifiez vos démarches administratives avec notre expertise. Nous vous accompagnons dans l'obtention de vos certifications et documents de voyage.</p>
        
        <div class="visa-actions">
            <a href="#" class="btn-explore">
                <span class="btn-text">En savoir plus</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

<style>
    :root {
        --primary-color: #007bff; 
        --accent-color: #ffd700;
        --text-light: #ffffff;
    }

    .visa-section {
        position: relative;
        height: 450px; /* Taille réduite comme au début */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: var(--text-light);
        font-family: 'Inter', sans-serif;
    }

    .visa-background {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    .visa-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
        z-index: 2;
    }

    .visa-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 700px;
        padding: 30px; /* Padding réduit */
        backdrop-filter: blur(5px);
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.1);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }

    .visa-content.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .visa-badge {
        display: inline-block;
        background: var(--primary-color);
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

      .ship-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .visa-description {
        font-size: 1rem;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    /* Bouton Magnétique Compact */
    .btn-explore {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.4s ease;
    }

    .btn-explore,
    .btn-explore:hover,
    .btn-explore:focus,
    .btn-explore:active {
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
        background: var(--primary-color);
        transition: all 0.4s ease;
        z-index: 1;
    }

    .btn-explore:hover .btn-circle::before { top: 0; }
    .btn-explore:hover .btn-text { color: #007bff; }
    .btn-circle svg { width: 18px; z-index: 2; transition: transform 0.3s ease; }
    .btn-explore:hover svg { transform: translateX(3px); }

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-explore:hover .btn-text,
    .btn-explore:focus .btn-text {
        text-decoration: none !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.visa-section');
    const content = document.querySelector('.visa-content');
    const bg = document.querySelector('.visa-background');
    const btn = document.querySelector('.btn-explore');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) content.classList.add('is-visible');
        });
    }, { threshold: 0.2 });

    observer.observe(section);

    section.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const xBg = (clientX / window.innerWidth - 0.5) * 20;
        const yBg = (clientY / window.innerHeight - 0.5) * 20;
        bg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.05)`;

        const rect = btn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        if(dist < 120) {
            btn.style.transform = `translate(${(clientX - (rect.left + rect.width/2)) * 0.3}px, ${(clientY - (rect.top + rect.height/2)) * 0.3}px)`;
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