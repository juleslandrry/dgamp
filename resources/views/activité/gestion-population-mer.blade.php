@extends('template')
@section('layout')

<section class="laws-section">
    <div class="background-overlay-law"></div>
    
    <div class="container main-content-law">
        <h1 class="title-law">GESTION DES POPULATION EN MER</h1>

        <div class="security-wrapper">
            <div class="security-visual reveal-left">
                <div class="image-frame">
                    <img src="{{ asset('assets/images/image85.jpeg') }}" alt="Sûreté Portuaire" id="parallax-img-surete">
                </div>
                <div class="decorative-rect"></div>
            </div>

            <div class="security-info reveal-right">
                <div class="info-header">
                    <span class="law-ref">PROTECTION DES GESTIONS</span>
                    <h2>Normes de Sûreté</h2>
                </div>
                
                <div class="info-body">
                    <p class="main-text">
                       Au sens de l’article 361 du Code maritime ivoirien, on entend par marin ou gens de mer,
                       toute personne salariée engagée par un armateur ou son représentant, par un intermédiaire 
                       ou embarquée pour son propre compte en vue d’occuper à bord d’un navire de commerce ou de servitude
                    </p>
                    
                    <div id="extraSurete" class="article-extra">
                        <div class="article-highlight">
                            <p>
                               de pêche, de navigation intérieure ou de plaisance un emploi relatif à la marche, 
                               à la conduite et à l’exploitation du navire. La qualité de marin est constatée par
                               l’inscription sur le registre d’identification des marins, tenu par l’autorité maritime administrative.
                               L’on estime aujourd’hui que 90% du commerce mondial fait appel au transport maritime ou fluvial qui dépend
                               des gens de mer pour l’exploitation des navires. Dès lors, les marins sont essentiels au commerce international
                               et au système économique global. Le transport maritime étant le premier secteur réellement mondialisé, la plupart 
                               du temps, des marins de différentes nationalités sont engagés à bord de navires enregistrés dans un autre État, 
                               appartenant à un armateur qui n’a parfois ni la nationalité du navire ni celle de l’un des marins. En droit international,
                               l’État du pavillon – qui est le pays dans lequel un navire est enregistré et dont le navire bâtera le pavillon – est l’État
                               internationalement responsable pour prendre et mettre en œuvre les mesures nécessaires pour assurer la sécurité en mer, notamment
                               en ce qui concerne les conditions de travail, quelle que soit la nationalité des marins ou de l’armateur. En Côte d’Ivoire, les gens 
                               de mer sont estimés à environ huit mille(8.000), tout métier confondu.


                            </p>
                        </div>
                    </div>
                </div>

                <div class="info-footer">
                    <a href="javascript:void(0)" class="btn-action" id="btnToggleSurete" onclick="toggleSurete()">
                        <span class="btn-text">Lire la suite</span>
                        <svg class="arrow-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* --- DESIGN IDENTIQUE AUX AUTRES RUBRIQUES --- */
.laws-section { padding: 100px 0; background-image: url("{{ asset('assets/images/image33.jpeg') }}"); background-size: cover; background-position: center; background-attachment: fixed; position: relative; min-height: 100vh; overflow: hidden; }
.laws-section::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.65); }
.main-content-law { position: relative; z-index: 2; }
.title-law { text-align: center; font-size: 35px; font-weight: bold; margin-bottom: 60px; color: #ffffff; text-transform: uppercase; letter-spacing: 3px; }

.security-wrapper { display: flex; align-items: center; gap: 60px; max-width: 1200px; margin: 0 auto; }
.security-visual { flex: 1; position: relative; }
.image-frame { width: 100%; height: 450px; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.5); z-index: 2; position: relative; }
.image-frame img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease-out; }
.decorative-rect { position: absolute; top: -20px; left: -20px; width: 100px; height: 100px; border-left: 5px solid #3b82c4; border-top: 5px solid #3b82c4; z-index: 1; }

.security-info { flex: 1.2; color: white; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); padding: 40px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.2); }
.law-ref { color: #3b82c4; font-weight: bold; font-size: 0.9rem; letter-spacing: 1px; }
.security-info h2 { font-size: 2.2rem; margin: 10px 0 25px; font-weight: 800; }
.main-text { font-size: 1.15rem; line-height: 1.7; color: #e0e0e0; }

/* --- ANIMATION DU CONTENU SUPPLÉMENTAIRE --- */
.article-extra { 
    max-height: 0; 
    overflow: hidden; 
    transition: max-height 0.6s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s; 
    opacity: 0; 
}
.article-extra.active { max-height: 600px; opacity: 1; margin-top: 25px; }
.article-highlight { background: rgba(255, 255, 255, 0.05); padding: 20px; border-radius: 15px; border-left: 4px solid #3b82c4; }

/* ==========================================================================
   BOUTON "LIRE LA SUITE" - FILTRE BLANC ET TRAIT SUPPRIMÉS DE FORCE
   ========================================================================== */
a.btn-action,
a.btn-action:link,
a.btn-action:visited {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    margin-top: 30px;
    padding: 12px 35px;
    background: #3b82c4 !important;
    color: white !important;
    border-radius: 50px;
    font-weight: 600;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
    cursor: pointer;
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

.arrow-icon { transition: transform 0.3s; }
.btn-action.active .arrow-icon { transform: rotate(180deg); }

/* --- REVEAL ANIMATIONS --- */
.reveal-left { opacity: 0; transform: translateX(-50px); transition: 1s ease-out; }
.reveal-right { opacity: 0; transform: translateX(50px); transition: 1s ease-out; }
.is-visible { opacity: 1; transform: translateX(0); }

@media (max-width: 992px) {
    .security-wrapper { flex-direction: column; text-align: center; }
    .decorative-rect { display: none; }
}
</style>

<script>
function toggleSurete() {
    const extra = document.getElementById('extraSurete');
    const btn = document.getElementById('btnToggleSurete');
    const btnText = btn.querySelector('.btn-text');

    extra.classList.toggle('active');
    btn.classList.toggle('active');

    if (extra.classList.contains('active')) {
        btnText.innerText = "Réduire les détails";
    } else {
        btnText.innerText = "Lire la suite";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelector('.reveal-left').classList.add('is-visible');
                entry.target.querySelector('.reveal-right').classList.add('is-visible');
            }
        });
    }, { threshold: 0.2 });

    observer.observe(document.querySelector('.security-wrapper'));

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const img = document.getElementById('parallax-img-surete');
        if(img) img.style.transform = `scale(1.05) translateY(${scrolled * 0.02}px)`;
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