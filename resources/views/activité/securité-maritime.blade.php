@extends('template')
@section('layout')

<section class="laws-section">
    <div class="background-overlay-law"></div>
    
    <div class="container main-content-law">
        <h1 class="title-law">SÉCURITÉ MARITIME</h1>

        <div class="security-wrapper">
            <div class="security-visual reveal-left">
                <div class="image-frame">
                    <img src="{{ asset('assets/images/image82.jpeg') }}" alt="Sécurité Maritime" id="parallax-img">
                </div>
                <div class="decorative-rect"></div>
            </div>

            <div class="security-info reveal-right">
                <div class="info-header">
                    <span class="law-ref">LOI N° 61-349 DU 9 NOVEMBRE 1961</span>
                    <h2>Code de la Marine Marchande</h2>
                </div>
                
                <div class="info-body">
                    <p class="main-text">
                        La sécurité maritime se définit par l'ensemble des moyens matériels garantissant l'intégrité du navire en ses articles suivants : 
                    </p>
                    
                    <div class="article-highlight">
                        <span class="article-number">ARTICLE 10</span>
                        <div class="article-content">
                            <p>
                                Par sécurité maritime, il faut entendre notamment l'ensemble des moyens matériels
                                qui donnent au navire : coque, appareils propulseurs, apparaux divers, instruments et documents nautiques;
                            </p>
                            
                            <div id="extraContent" class="article-extra">
                                <p>
                                   la possibilité d'effectuer normalement et sans danger, dans les parages autorisés, la mission à, laquelle il est destiné dans les conditions prévisibles d'exploitation ; 
                                   l'ensemble des moyens de lutte contre l'incendie et les voies d'eau ; le bon état du matériel de sauvetage collectif et individuel pour l'équipage et les passagers ainsi que les mesures en cas d'alarme et d'évacuation du navire.
                                   L'arrimage satisfaisant des marchandises et la stabilité du navire, l'observation des règles de franc bord et de la réglementation concernant les marchandises dangereuses.
                                   Les dispositions relatives à l'hygiène et à l'habitabilité, au matériel médical et pharmaceutique.
                            </div>
                        </div>

                        <button id="btnLire" class="btn-lire-suite" onclick="toggleArticle()">
                            <span class="btn-text">Lire la suite</span>
                            <span class="btn-icon">↓</span>
                        </button>
                    </div>
                </div>

                <div class="info-footer">
                    <a href="#extraContent" class="btn-action" onclick="openAndScroll(event)">
                        <span>Consulter le code complet</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* --- STYLES PRÉCÉDENTS CONSERVÉS --- */
.laws-section { padding: 100px 0; background-image: url("{{ asset('assets/images/image33.jpeg') }}"); background-size: cover; background-position: center; background-attachment: fixed; position: relative; min-height: 100vh; overflow: hidden; }
.laws-section::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.65); }
.main-content-law { position: relative; z-index: 2; }
.title-law { text-align: center; font-size: 35px; font-weight: bold; margin-bottom: 60px; color: #ffffff; text-transform: uppercase; letter-spacing: 3px; }
.security-wrapper { display: flex; align-items: center; gap: 60px; max-width: 1200px; margin: 0 auto; }
.security-visual { flex: 1; position: relative; }
.image-frame { width: 100%; height: 450px; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.5); z-index: 2; position: relative; }
.image-frame img { width: 100%; height: 100%; object-fit: cover; }
.decorative-rect { position: absolute; top: -20px; left: -20px; width: 100px; height: 100px; border-left: 5px solid #3b82c4; border-top: 5px solid #3b82c4; z-index: 1; }
.security-info { flex: 1.2; color: white; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.2); }
.law-ref { color: #3b82c4; font-weight: bold; font-size: 0.9rem; letter-spacing: 1px; }
.security-info h2 { font-size: 2.2rem; margin: 10px 0 25px; font-weight: 800; }
.main-text { font-size: 1.15rem; line-height: 1.7; margin-bottom: 30px; color: #e0e0e0; }

/* --- NOUVEAU STYLE POUR LE BOUTON LIRE LA SUITE --- */
.article-highlight {
    background: rgba(255, 255, 255, 0.05);
    padding: 25px;
    border-radius: 15px;
    border-left: 4px solid #3b82c4;
}

.article-extra {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
    transition: opacity 0.4s, max-height 0.6s;
}

.article-extra.active {
    max-height: 500px; /* Assez grand pour le texte */
    opacity: 1;
    margin-top: 15px;
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

.btn-lire-suite:focus,
.btn-lire-suite:active {
    outline: none !important;
    box-shadow: none !important;
}

.btn-lire-suite .btn-icon {
    transition: transform 0.3s;
}

.btn-lire-suite.active .btn-icon {
    transform: rotate(180deg);
}

/* ==========================================================================
   BOUTON "CONSULTER LE CODE COMPLET" - FILTRE BLANC ET TRAIT SUPPRIMÉS DE FORCE
   ========================================================================== */
a.btn-action,
a.btn-action:link,
a.btn-action:visited {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    margin-top: 30px;
    padding: 12px 30px;
    background: #3b82c4 !important;
    color: white !important;
    border-radius: 50px;
    font-weight: 600;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
    text-decoration: none !important;
    border: none !important;
    border-bottom: none !important;
    outline: none !important;
    box-shadow: none !important;
    -webkit-tap-highlight-color: transparent !important;
}

a.btn-action:hover {
    background: #ffffff !important;
    color: #0b3c6d !important;
    transform: translateY(-3px);
    text-decoration: none !important;
    border-bottom: none !important;
    outline: none !important;
    box-shadow: none !important;
}

a.btn-action:focus,
a.btn-action:active,
a.btn-action:focus-visible,
a.btn-action:focus-within {
    background: #3b82c4 !important;
    color: white !important;
    text-decoration: none !important;
    border-bottom: none !important;
    outline: none !important;
    box-shadow: none !important;
    background-image: none !important;
    filter: none !important;
}

/* --- ANIMATIONS --- */
.reveal-left { opacity: 0; transform: translateX(-50px); transition: 1s ease-out; }
.reveal-right { opacity: 0; transform: translateX(50px); transition: 1s ease-out; }
.is-visible { opacity: 1; transform: translateX(0); }
</style>

<script>
function toggleArticle() {
    const extra = document.getElementById('extraContent');
    const btn = document.getElementById('btnLire');
    const btnText = btn.querySelector('.btn-text');

    extra.classList.toggle('active');
    btn.classList.toggle('active');

    if (extra.classList.contains('active')) {
        btnText.innerText = "Réduire";
    } else {
        btnText.innerText = "Lire la suite";
    }
}

// Fonction pour le bouton du bas : ouvre l'article s'il est fermé et scrolle
function openAndScroll(e) {
    const extra = document.getElementById('extraContent');
    if (!extra.classList.contains('active')) {
        toggleArticle();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const visual = document.querySelector('.reveal-left');
    const info = document.querySelector('.reveal-right');
    const img = document.getElementById('parallax-img');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                visual.classList.add('is-visible');
                info.classList.add('is-visible');
            }
        });
    }, { threshold: 0.2 });

    observer.observe(document.querySelector('.security-wrapper'));

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        img.style.transform = `translateY(${scrolled * 0.05}px) scale(1.1)`;
    });

    // Force la suppression du filtre blanc / halo au clic (framework agressif)
    document.querySelectorAll(".btn-action").forEach((btn) => {
        const killRing = () => {
            btn.style.setProperty("outline", "none", "important");
            btn.style.setProperty("box-shadow", "none", "important");
            btn.style.setProperty("border-bottom", "none", "important");
            btn.style.setProperty("text-decoration", "none", "important");
            btn.style.setProperty("filter", "none", "important");
            btn.style.setProperty("background-image", "none", "important");
        };
        btn.addEventListener("mousedown", killRing);
        btn.addEventListener("focus", killRing);
        btn.addEventListener("click", killRing);
    });
});
</script>

@endsection