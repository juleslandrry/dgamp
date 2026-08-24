@extends('template')
@section('layout')

<section class="ship-reg-section">
    <div class="ship-background"></div>
    <div class="ship-content">
        <span class="ship-badge">{{ $service->badge ?? 'Autorité Maritime' }}</span>
        <h1 class="ship-title">{{ $service->titre ?? 'Immatriculation des Navires' }}</h1>
        <p class="ship-description">{!! $service->description ?? "Officialisez votre présence en mer. Nous gérons l'enregistrement, le pavillon et la conformité de votre flotte avec une précision rigoureuse." !!}</p>
        
        <div class="ship-actions">
            <a href="#" class="btn-ship-explore" onclick="document.getElementById('detailsModal').style.display='flex'; return false;">
                <span class="btn-text">{{ $service->bouton_texte ?? 'Consulter le registre' }}</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L12 22M12 2L15 5M12 2L9 5M22 12H2M19 15L22 12L19 9M5 9L2 12L5 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
        <h2 class="details-modal-title">{{ $service->titre ?? 'Immatriculation des Navires' }}</h2>

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
    .ship-reg-section {
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

    .ship-background {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

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
        background: #007bff;
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
    
    .btn-ship-explore:hover svg { transform: rotate(180deg); }

    .btn-text {
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-ship-explore:hover .btn-text,
    .btn-ship-explore:focus .btn-text {
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
    const sSection = document.querySelector('.ship-reg-section');
    const sContent = document.querySelector('.ship-content');
    const sBg = document.querySelector('.ship-background');
    const sBtn = document.querySelector('.btn-ship-explore');

    const sObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) sContent.classList.add('is-visible');
        });
    }, { threshold: 0.2 });

    sObserver.observe(sSection);

    sSection.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        
        const xBg = (clientX / window.innerWidth - 0.5) * 15;
        const yBg = (clientY / window.innerHeight - 0.5) * 15;
        sBg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.05)`;

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

    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});
</script>

@endsection