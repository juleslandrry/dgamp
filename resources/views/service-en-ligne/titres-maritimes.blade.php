@extends('template')
@section('layout')

<section class="maritime-titles-section">
    <div class="titles-background"></div>
    <div class="titles-content">
        <span class="titles-badge">{{ $service->badge ?? 'Carrière & Compétences' }}</span>
        <h1 class="titles-title">{{ $service->titre ?? 'Titres Maritimes' }}</h1>
        <p class="titles-description">{!! $service->description ?? "Valorisez votre expertise en mer. Nous délivrons les brevets, certificats et titres professionnels attestant de vos qualifications selon les standards internationaux STCW." !!}</p>
        
        <div class="titles-actions">
            <a href="#" class="btn-titles-explore" onclick="document.getElementById('detailsModal').style.display='flex'; return false;">
                <span class="btn-text">{{ $service->bouton_texte ?? 'voir plus' }}</span>
                <span class="btn-circle">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 15L15 12M15 12L12 9M15 12H9M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

{{-- Popup "voir plus" --}}
<div id="detailsModal" class="details-modal">
    <div class="details-modal-box">
        <span class="details-modal-close" onclick="document.getElementById('detailsModal').style.display='none';">&times;</span>
        <h2 class="details-modal-title">{{ $service->titre ?? 'Livrets et Titres Maritimes' }}</h2>

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
        background: url('assets/images/image33.jpeg') center/cover no-repeat;
        z-index: 1;
        transition: transform 0.1s ease-out;
    }

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
        border: 1px solid rgba(212, 175, 55, 0.2);
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
        background: #007bff;
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
        
        const xBg = (clientX / window.innerWidth - 0.5) * 12;
        const yBg = (clientY / window.innerHeight - 0.5) * 12;
        titlesBg.style.transform = `translate(${xBg}px, ${yBg}px) scale(1.08)`;

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

    document.getElementById('detailsModal').addEventListener('click', function(e) {
        if (e.target === this) this.style.display = 'none';
    });
});
</script>

@endsection