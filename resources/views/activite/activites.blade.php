@extends('template')
@section('layout')

<section class="laws-section">
    <div class="background-overlay-law"></div>
    
    <div class="container main-content-law">
        {{-- TITRE DYNAMIQUE DE L'ACTIVITÉ --}}
        <h1 class="title-law">{{ $activite->titre }}</h1>

        <div class="security-wrapper">
            {{-- IMAGE DYNAMIQUE DE L'ACTIVITÉ --}}
            <div class="security-visual reveal-left">
                <div class="image-frame">
                    <img src="{{ $activite->image ? asset('storage/' . $activite->image) : asset('assets/images/image82.jpeg') }}" alt="{{ $activite->titre }}" id="parallax-img">
                </div>
                <div class="decorative-rect"></div>
            </div>

            <div class="security-info reveal-right">
                
                {{-- BOUCLE SUR LES RÉGLEMENTATIONS DE L'ACTIVITÉ --}}
                @forelse($activite->reglementations as $index => $reg)
                    <div class="reglementation-block {{ !$loop->first ? 'mt-5 pt-4 border-top border-white-50' : '' }}">
                        
                        {{-- TITRE & SOUS-TITRE --}}
                        <div class="info-header">
                            
                            @if($reg->sous_titre)
                                <span class="law-ref">{{ $reg->sous_titre }}</span>
                            @endif
                            <h2>{{ $reg->titre }}</h2>
                        </div>
                        
                        <div class="info-body">
                            {{-- TEXTE D'INTRODUCTION --}}
                            @if($reg->intro)
                                <p class="main-text">
                                    {{ $reg->intro }}
                                </p>
                            @endif
                            
                            {{-- DESCRIPTION / CONTENU EN HTML (Rendu du WYSIWYG) --}}
                            <div class="article-highlight">
                                <div class="article-content">
                                    <div id="extraContent-{{ $reg->id }}" class="article-extra">
                                        {!! $reg->description !!}
                                    </div>
                                </div>

                                <button id="btnLire-{{ $reg->id }}" class="btn-lire-suite" onclick="toggleArticle({{ $reg->id }})">
                                    <span class="btn-text">Lire la suite</span>
                                    <span class="btn-icon">↓</span>
                                </button>
                            </div>
                        </div>

                        <div class="info-footer">
                            <a href="#extraContent-{{ $reg->id }}" class="btn-action" onclick="openAndScroll(event, {{ $reg->id }})">
                                <span>Consulter le texte complet</span>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="alert alert-info bg-transparent text-white border-light text-center p-4">
                        Aucune réglementation enregistrée pour cette activité actuellement.
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</section>

<style>
/* --- STYLES OBLIGATOIRES POUR LE DÉPLOIEMENT DU CONTENU DYNAMIQUE --- */
.laws-section { padding: 100px 0; background-image: url("{{ asset('assets/images/image33.jpeg') }}"); background-size: cover; background-position: center; background-attachment: fixed; position: relative; min-height: 100vh; overflow: hidden; }
.laws-section::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.65); }
.main-content-law { position: relative; z-index: 2; }
.title-law { text-align: center; font-size: 35px; font-weight: bold; margin-bottom: 60px; color: #ffffff; text-transform: uppercase; letter-spacing: 3px; }
.security-wrapper { display: flex; align-items: flex-start; gap: 60px; max-width: 1200px; margin: 0 auto; }
.security-visual { flex: 1; position: sticky; top: 100px; }
.image-frame { width: 100%; height: 450px; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.5); z-index: 2; position: relative; }
.image-frame img { width: 100%; height: 100%; object-fit: cover; }
.decorative-rect { position: absolute; top: -20px; left: -20px; width: 100px; height: 100px; border-left: 5px solid #3b82c4; border-top: 5px solid #3b82c4; z-index: 1; }
.security-info { flex: 1.2; color: white; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.2); }
.law-ref { color: #3b82c4; font-weight: bold; font-size: 0.9rem; letter-spacing: 1px; text-transform: uppercase; }
.security-info h2 { font-size: 2.2rem; margin: 10px 0 25px; font-weight: 800; }
.main-text { font-size: 1.15rem; line-height: 1.7; margin-bottom: 30px; color: #e0e0e0; }

.article-highlight {
    background: rgba(255, 255, 255, 0.05);
    padding: 25px;
    border-radius: 15px;
    border-left: 4px solid #3b82c4;
}

/* Le bloc de description rétracté par défaut */
.article-extra {
    max-height: 120px; /* Aperçu court */
    overflow: hidden;
    transition: max-height 0.6s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s;
    opacity: 0.8;
}

.article-extra.active {
    max-height: 3000px; /* Permet d'afficher tout le texte formaté */
    opacity: 1;
}

.btn-lire-suite {
    background: transparent;
    border: 1px solid #3b82c4;
    color: #3b82c4;
    padding: 8px 20px;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    margin-top: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s;
    outline: none !important;
    box-shadow: none !important;
}

.btn-lire-suite:hover {
    background: #3b82c4;
    color: white;
}

.btn-lire-suite .btn-icon {
    transition: transform 0.3s;
}

.btn-lire-suite.active .btn-icon {
    transform: rotate(180deg);
}

a.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    margin-top: 25px;
    padding: 12px 30px;
    background: #3b82c4 !important;
    color: white !important;
    border-radius: 50px;
    font-weight: 600;
    transition: 0.3s;
    text-decoration: none !important;
}

a.btn-action:hover {
    background: #ffffff !important;
    color: #0b3c6d !important;
    transform: translateY(-3px);
}

.reveal-left { opacity: 0; transform: translateX(-50px); transition: 1s ease-out; }
.reveal-right { opacity: 0; transform: translateX(50px); transition: 1s ease-out; }
.is-visible { opacity: 1; transform: translateX(0); }
</style>

<script>
// Adaptation avec support des ID dynamiques
function toggleArticle(id) {
    const extra = document.getElementById('extraContent-' + id);
    const btn = document.getElementById('btnLire-' + id);
    const btnText = btn.querySelector('.btn-text');

    extra.classList.toggle('active');
    btn.classList.toggle('active');

    if (extra.classList.contains('active')) {
        btnText.innerText = "Réduire";
    } else {
        btnText.innerText = "Lire la suite";
    }
}

function openAndScroll(e, id) {
    const extra = document.getElementById('extraContent-' + id);
    if (!extra.classList.contains('active')) {
        toggleArticle(id);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const visual = document.querySelector('.reveal-left');
    const info = document.querySelector('.reveal-right');
    const img = document.getElementById('parallax-img');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if(visual) visual.classList.add('is-visible');
                if(info) info.classList.add('is-visible');
            }
        });
    }, { threshold: 0.2 });

    const wrapper = document.querySelector('.security-wrapper');
    if (wrapper) observer.observe(wrapper);

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        if(img) img.style.transform = `translateY(${scrolled * 0.03}px) scale(1.05)`;
    });
});
</script>

@endsection