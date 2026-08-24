@extends('template')
@section('layout')

<section class="tech-visit-section">
    <div class="tech-background"></div>
    <div class="tech-content">
        <span class="tech-badge">{{ $service->badge ?? 'Conformité & Sécurité' }}</span>
        <h1 class="tech-title">{{ $service->titre ?? 'Visite Technique' }}</h1>
        <p class="tech-description">{!! $service->description ?? "Garantissez la navigabilité et la sécurité de vos installations. Nos experts procèdent à des inspections rigoureuses pour certifier la conformité de vos équipements." !!}</p>
        
        <div class="tech-actions">
            <a href="#" class="btn-tech-explore" onclick="document.getElementById('detailsModal').style.display='flex'; return false;">
                <span class="btn-text">{{ $service->bouton_texte ?? 'Prendre rendez-vous' }}</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
        <h2 class="details-modal-title">{{ $service->titre ?? 'Visite Technique des Navires' }}</h2>

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
    .tech-visit-section {
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

    .tech-background {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

    .tech-visit-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.5) 100%);
        z-index: 2;
    }

    .tech-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 700px;
        padding: 30px;
        backdrop-filter: blur(6px);
        background: rgba(255, 255, 255, 0.03);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.1);
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }

    .tech-content.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .tech-badge {
        display: inline-block;
        background: #007bff;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .tech-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .tech-description {
        font-size: 1rem;
        margin-bottom: 25px;
        opacity: 0.9;
        font-weight: 300;
    }

    .btn-tech-explore {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.4s ease;
    }

    .btn-tech-explore,
    .btn-tech-explore:hover,
    .btn-tech-explore:focus,
    .btn-tech-explore:active {
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

    .btn-tech-explore:hover .btn-circle::before { top: 0; }
    .btn-tech-explore:hover .btn-text { color: #007bff; }
    
    .btn-circle svg { 
        width: 22px; 
        z-index: 2; 
        transition: all 0.3s ease;
    }
    
    .btn-tech-explore:hover svg { 
        transform: scale(1.2); 
        stroke: white;
    }

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-tech-explore:hover .btn-text,
    .btn-tech-explore:focus .btn-text {
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
    const tSection = document.querySelector('.tech-visit-section');
    const tContent = document.querySelector('.tech-content');
    const tBg = document.querySelector('.tech-background');
    const tBtn = document.querySelector('.btn-tech-explore');

    const tObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) tContent.classList.add('is-visible');
        });
    }, { threshold: 0.2 });

    tObserver.observe(tSection);

    tSection.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        
        const xBg = (clientX / window.innerWidth - 0.5) * 15;
        const yBg = (clientY / window.innerHeight - 0.5) * 15;
        tBg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.05)`;

        const rect = tBtn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        
        if(dist < 100) {
            tBtn.style.transform = `translate(${(clientX - (rect.left + rect.width/2)) * 0.3}px, ${(clientY - (rect.top + rect.height/2)) * 0.3}px)`;
        } else {
            tBtn.style.transform = `translate(0, 0)`;
        }
    });

    tSection.addEventListener('mouseleave', () => {
        tBg.style.transform = `translate(0, 0) scale(1)`;
        tBtn.style.transform = `translate(0, 0)`;
    });

    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});
</script>

@endsection