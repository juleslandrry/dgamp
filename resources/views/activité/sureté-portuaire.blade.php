@extends('template')
@section('layout')

<section class="laws-section">
    <div class="background-overlay-law"></div>
    
    <div class="container main-content-law">
        <h1 class="title-law">SÛRETÉ MARITIMES & PORTUAIRE</h1>

        <div class="security-wrapper">
            <div class="security-visual reveal-left">
                <div class="image-frame">
                    <img src="{{ asset('assets/images/image83.jpeg') }}" alt="Sûreté Portuaire" id="parallax-img-surete">
                </div>
                <div class="decorative-rect"></div>
            </div>

            <div class="security-info reveal-right">
                <div class="info-header">
                    <span class="law-ref">PROTECTION DES INSTALLATIONS</span>
                    <h2>Normes de Sûreté</h2>
                </div>
                
                <div class="info-body">
                    <p class="main-text">
                        Sûreté maritime désigne, l’ensemble des mesures visant à protéger les navires, 
                        les plateformes fixes ou flottantes au large, les installations portuaires, les ports contre les menaces d’actes illicites.
                        En Côte d’Ivoire, l’Autorité désignée chargée du suivi de la mise en œuvre des mesures de sûreté est la Direction des Affaires Maritimes et Portuaires.
                    </p>
                    
                    <div id="extraSurete" class="article-extra">
                        <div class="article-highlight">
                            <p>
                                Elle a pour mission générale d’assurer la coordination, le contrôle, la formation, l’application de la législation et de la réglementation en matière de sûreté des navires, des ports et des installations portuaires.
L’Autorité désignée exerce ses missions à travers la sous-direction de la sûreté maritime et portuaire. Elle est particulièrement chargée :
de l’initiation, de l’application et du suivi des procédures de sûreté maritime ;
de l’identification des installations portuaires et des navires battant pavillon ivoirien  soumis aux dispositions du du code ISPS et de la réglementation en vigueur;
de l’approbation des évaluations et des plans de sûreté ainsi que de l’approbation de leurs modifications ;
de l’établissement des niveaux de sûreté applicables ;
d’examiner les dossiers de demande d’agrément des organismes de sûreté reconnu ;
du contrôle du maintien des mesures de sûreté ;
du contrôle des organismes de sûreté reconnus et de tout prestataire de services de sûreté ;
de la communication des informations liées à la sûreté à l’Organisation Maritime Internationale ;
de la communication de toutes informations ou tous  renseignements se rapportant à la sûreté maritime y compris à la sûreté des ports qui peuvent être consultés par les compagnies et les navires ;
d’établir les prescriptions applicables à une déclaration de sûreté.
de mener des enquêtes, procéder à des examens, des fouilles, des saisies et des arrestations sur les navires et les installations portuaires;
d’enquêter et engager des poursuites.
d’exercer son autorité d’Organe chargé de l’application des lois dans toutes les affaires relatives à la sûreté maritime.
L’autorité désignée à titre onéreux les documents administratifs de sûreté suivants :

l’agrément d’organismes de sûreté reconnus
les visas d’agrément d’organismes de sûreté reconnus
 la déclaration de conformité de l’installation portuaire et des plateformes
le Certificat international de sûreté du navire ou le Certificat international provisoire de sûreté du navire
les attestations ou certificats de formation. 
 

La sous-direction de la sûreté maritime et portuaire est structurée comme suit :

une cellule d’inspecteurs techniques de sûreté,
un service promotion de la sûreté et formation aux normes du Code ISPS
un service gestion de la sûreté maritime et portuaire
deux points de contact ISPS à Abidjan et San-Pedro.
LEGISLATION ET REGLEMENTATION

Règlementation internationale
Chapitre XI-2 de SOLAS
Code Internationale de Sûreté des navires et des Installations Portuaires dit Code ISPS
Législation nationale
Loi n°2017-442 du 30juin 2017 portant Code maritime;
Décret n°2020-330 du 11 mars 2020  fixant les modalités d’application des mesures relatives à la sûreté des navires et des installations portuaires ;
Arrêté n°879/MAM/CAB du 21 septembre 2020 portant réglementation de la formation à la sûreté maritime et modalités de délivrances des titres de formation à la sûreté ;
Arrêté n°1186/MAM/CAB du 29 décembre 2020 portant condition d’établissement des niveaux de sûreté par l’autorité désignée;
Décision n° 087/MT/DGAMP/DG du 20 juillet 2011 portant directives relatives à la conduite des audits internes et des exercices et entraînements de sûreté ;
circulaire n° 058/MT/DGAMP/DG du 19 juin 2012 portant rappel des directives de sûreté relatives à l’entrée et au séjour des navires dans les ports ivoiriens;
circulaire n°062/MT/DGAMP/DG du 08 mai 2012 portant condition d’établissement de déclaration de sûreté ;
Décision n° 427/MT/DGAMP/DG du 27 décembre 2013 portant conduite des exercices et entraînements.

                            </p>
                        </div>
                    </div>
                </div>

                <div class="info-footer">
                    <a href="javascript:void(0)" class="btn-action" id="btnToggleSurete" onclick="toggleSurete()">
                        <span class="btn-text">Réglementations ISPS</span>
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
   BOUTON "RÉGLEMENTATIONS ISPS" - FILTRE BLANC ET TRAIT SUPPRIMÉS DE FORCE
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
        btnText.innerText = "Réglementations ISPS";
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