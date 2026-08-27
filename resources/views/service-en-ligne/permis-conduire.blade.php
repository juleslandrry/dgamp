@extends('template')
@section('layout')

<section class="license-section">
    <div class="license-background"></div>
    <div class="license-content">
        <span class="license-badge">{{ $service->badge ?? 'Formation & Certification' }}</span>
        <h1 class="license-title">{{ $service->titre ?? 'Permis de Conduire' }}</h1>
        <p class="license-description">{!! $service->description ?? "Obtenez votre précieux sésame en toute sérénité. De l'inscription à l'examen final, nous vous accompagnons pour faire de vous un conducteur responsable et certifié." !!}</p>
        
        <div class="license-actions">
            <a href="#" class="btn-license-explore" onclick="document.getElementById('detailsModal').style.display='flex'; return false;">
                <span class="btn-text">{{ $service->bouton_texte ?? 'Démarrer mon inscription' }}</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 5L21 11M21 11L15 17M21 11H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

{{-- Popup "En savoir plus" --}}
<div id="detailsModal" class="details-modal">
    <div class="details-modal-box">
        <span class="details-modal-close" onclick="document.getElementById('detailsModal').style.display='none';">&times;</span>
        <h2 class="details-modal-title">{{ $service->titre ?? 'Permis de Conduire des Navires' }}</h2>

        @if($service && $service->detail_texte)
            <p class="details-modal-text">{!! $service->detail_texte !!}</p>
        @else
            <p class="details-modal-text">Les informations détaillées sur ce service seront bientôt disponibles.</p>
        @endif

        @if($service && !empty($service->detail_points))
            <ul class="details-modal-list">
                @foreach($service->detail_points as $point)
                    <li>{{ $point }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<style>
    .license-section {
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

    .license-background {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    .license-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(44, 44, 44, 0.4) 100%);
        z-index: 2;
    }

    .license-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 700px;
        padding: 30px;
        backdrop-filter: blur(5px);
        background: rgba(255, 255, 255, 0.04);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.1);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .license-content.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .license-badge {
        display: inline-block;
        background: #007bff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        box-shadow: 0 4px 10px rgba(243, 156, 18, 0.2);
    }

    .license-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .license-description {
        font-size: 1rem;
        margin-bottom: 25px;
        opacity: 0.9;
        font-weight: 300;
        line-height: 1.5;
    }

    .btn-license-explore {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.4s ease;
    }

    .btn-license-explore,
    .btn-license-explore:hover,
    .btn-license-explore:focus,
    .btn-license-explore:active {
        text-decoration: none !important;
    }

    .btn-circle {
        width: 45px;
        height: 45px;
        border: 1px solid rgba(255, 255, 255, 0.3);
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

    .btn-license-explore:hover .btn-circle::before { top: 0; }
    .btn-license-explore:hover .btn-text { color: #007bff; }
    
    .btn-circle svg { 
        width: 18px; 
        z-index: 2; 
        transition: transform 0.3s ease;
    }
    
    .btn-license-explore:hover svg { 
        transform: translateX(5px);
        stroke: white;
    }

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-license-explore:hover .btn-text,
    .btn-license-explore:focus .btn-text {
        text-decoration: none !important;
    }

    .details-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.75);
        align-items: center;
        justify-content: center;
        padding: 20px;
        box-sizing: border-box;
    }

    .details-modal-box {
        background: #ffffff;
        color: #1C2733;
        max-width: 600px;
        width: 100%;
        max-height: 80vh;
        overflow-y: auto;
        border-radius: 16px;
        padding: 36px 32px;
        position: relative;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .details-modal-close {
        position: absolute;
        top: 16px;
        right: 20px;
        font-size: 28px;
        cursor: pointer;
        color: #66707B;
        line-height: 1;
        transition: color 0.2s ease;
    }
    .details-modal-close:hover { color: #0B2340; }

    .details-modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #0B2340;
        margin: 0 0 18px;
    }

    .details-modal-text {
        font-size: 15px;
        line-height: 1.7;
        color: #1C2733;
        margin: 0 0 18px;
        white-space: pre-line;
    }

    .details-modal-list {
        margin: 0;
        padding-left: 20px;
    }
    .details-modal-list li {
        font-size: 14.5px;
        line-height: 1.8;
        color: #1C2733;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const lSection = document.querySelector('.license-section');
    const lContent = document.querySelector('.license-content');
    const lBg = document.querySelector('.license-background');
    const lBtn = document.querySelector('.btn-license-explore');

    const lObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) lContent.classList.add('is-visible');
        });
    }, { threshold: 0.2 });

    lObserver.observe(lSection);

    lSection.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        
        const xBg = (clientX / window.innerWidth - 0.5) * 20;
        const yBg = (clientY / window.innerHeight - 0.5) * 10;
        lBg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.05)`;

        const rect = lBtn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        
        if(dist < 120) {
            const xMove = (clientX - (rect.left + rect.width/2)) * 0.35;
            const yMove = (clientY - (rect.top + rect.height/2)) * 0.35;
            lBtn.style.transform = `translate(${xMove}px, ${yMove}px)`;
        } else {
            lBtn.style.transform = `translate(0, 0)`;
        }
    });

    lSection.addEventListener('mouseleave', () => {
        lBg.style.transform = `translate(0, 0) scale(1)`;
        lBtn.style.transform = `translate(0, 0)`;
    });

    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});
</script>

@endsection