@extends('template')
@section('layout')

<section class="laws-section">
    <div class="background-overlay-law"></div>
    
    <div class="container main-content-law">
        <h1 class="title-law">COORDINATION DE SAUVETAGE MARITIME</h1>

        <div class="security-wrapper">
            <div class="security-visual reveal-left">
                <div class="image-frame">
                    <img src="{{ asset('assets/images/image89.jpeg') }}" alt="Sauvetage Maritime" id="parallax-img-surete">
                </div>
                <div class="decorative-rect"></div>
            </div>

            <div class="security-info reveal-right">
                <div class="info-header">
                    <span class="law-ref">ASSURANCE & SURVEILLANCE</span>
                    <h2>Stratégie</h2>
                </div>
                
                <div class="info-body">
                    <ul class="main-list">
                        <li>Assurer la veille de détresse de sécurité et de sûreté dans l’espace maritime ivoirien (203 000 KM2)</li>
                        <li>Assurer la coordination des opérations de recherche et de sauvetage maritimes ;</li>
                        <li>Apporter l’assistance nécessaire aux navires en difficulté ;</li>
                        <li>Surveiller les côtes et les approches maritimes ;</li>
                        <li>Surveiller le trafic maritime et alerter en cas de pollution marine</li>
                    </ul>
                    
                    <div id="extraSurete" class="article-extra">
                        <div class="article-highlight">
                            <p>
                                (conformément au Plan Pollumar; Plan d’urgence de la convention d’Abidjan )<br>
                                • Participer à la mise en œuvre du plan POLLUMAR ;<br>
                                • Participer à la surveillance des pêches maritimes ;<br>
                                • Assigner et surveiller des fréquences maritimes ;<br>
                                • Participer aux missions de renseignement maritime en matière de sécurité nationale.<br><br>
                                <strong>MRCC Abidjan</strong> est le Centre principal SAR de la zone UEMOA depuis le 25 mai 2018. 
                                Il est chargé de coordonner les actions des centres secondaires.
                            </p>

                            <h4 class="table-title">Événements SAR par type de navires (Tableau 1)</h4>
                            <div class="table-responsive">
                                <table class="custom-sar-table">
                                    <thead>
                                        <tr>
                                            <th>Cause</th>
                                            <th>2018</th>
                                            <th>2019</th>
                                            <th>2020</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Navires de pêche</td><td>10</td><td>11</td><td>12</td></tr>
                                        <tr><td>Navires de plaisance</td><td>04</td><td>02</td><td>---</td></tr>
                                        <tr><td>Navires de commerce</td><td>05</td><td>---</td><td>07</td></tr>
                                        <tr><td>Navires à passager</td><td>04</td><td>02</td><td>---</td></tr>
                                        <tr class="row-others"><td>Autres</td><td>03</td><td>01</td><td>18</td></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="row-total"><td>Total</td><td>26</td><td>16</td><td>37</td></tr>
                                    </tfoot>
                                </table>
                            </div>

                            <h4 class="table-title" style="margin-top: 30px;">Statistiques Comparatives (Tableau 2)</h4>
                            <div class="table-responsive">
                                <table class="custom-sar-table">
                                    <thead>
                                        <tr>
                                            <th>Cause</th>
                                            <th>2018</th>
                                            <th>2019</th>
                                            <th>2020</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Nauffrage</td><td>01</td><td>---</td><td>01</td></tr>
                                        <tr><td>collision</td><td>03</td><td>---</td><td>01</td></tr>
                                        <tr><td>Chavirement/Echouement</td><td>---</td><td>02</td><td>---</td></tr>
                                        <tr><td>Disparution des navires</td><td>02</td><td>---</td><td>---</td></tr>
                                        <tr><td>Assistance/Remorquage</td><td>02</td><td>01</td><td>---</td></tr>
                                        <tr><td>Homme à la mer</td><td>03</td><td>02</td><td>01</td></tr>
                                        <tr><td>Accident de plongée</td><td>---</td><td>01</td><td>---</td></tr>
                                        <tr><td>EVASAN</td><td>04</td><td>02</td><td>08</td></tr>
                                        <tr><td>Balise de détresse</td><td>04</td><td>02</td><td>08</td></tr>
                                        <tr><td>Fausses alertes</td><td>04</td><td>05</td><td>10</td></tr> 
                                        <tr><td>Alertes de sécurité</td><td>03</td><td>01</td><td>03</td></tr>
                                        <tr><td>Piraterie</td><td>---</td><td>---</td><td>04</td></tr>
                                        <tr><td>Pêche illicite</td><td>---</td><td>---</td><td>01</td></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="row-total"><td>Total</td><td>24</td><td>16</td><td>37</td></tr>
                                    </tfoot>
                                </table>
                            </div>
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
/* --- DESIGN HARMONISÉ --- */
.laws-section { padding: 100px 0; background-image: url("{{ asset('assets/images/image33.jpeg') }}"); background-size: cover; background-position: center; background-attachment: fixed; position: relative; min-height: 100vh; }
.laws-section::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); }
.main-content-law { position: relative; z-index: 2; }
.title-law { text-align: center; font-size: 35px; font-weight: bold; margin-bottom: 60px; color: #ffffff; text-transform: uppercase; letter-spacing: 3px; }

.security-wrapper { display: flex; align-items: flex-start; gap: 60px; max-width: 1200px; margin: 0 auto; }
.security-visual { flex: 1; position: sticky; top: 100px; }
.image-frame { width: 100%; height: 450px; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px rgba(0,0,0,0.5); }
.image-frame img { width: 100%; height: 100%; object-fit: cover; }
.decorative-rect { position: absolute; top: -15px; left: -15px; width: 80px; height: 80px; border-left: 4px solid #3b82c4; border-top: 4px solid #3b82c4; }

.security-info { flex: 1.5; color: white; background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(15px); padding: 45px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.15); }
.law-ref { color: #3b82c4; font-weight: bold; font-size: 0.85rem; letter-spacing: 1.5px; }
.security-info h2 { font-size: 2.2rem; margin: 10px 0 25px; font-weight: 800; }

.main-list { list-style: none; padding: 0; margin-bottom: 20px; }
.main-list li { margin-bottom: 12px; padding-left: 25px; position: relative; line-height: 1.6; color: #e0e0e0; }
.main-list li::before { content: "✓"; position: absolute; left: 0; color: #3b82c4; font-weight: bold; }

/* --- STYLE TABLEAU HARMONISÉ --- */
.table-title { color: #3b82c4; font-size: 1.1rem; margin-bottom: 15px; text-transform: uppercase; font-weight: 700; border-bottom: 1px solid rgba(59, 130, 196, 0.3); padding-bottom: 5px; }
.table-responsive { overflow-x: auto; margin-bottom: 20px; border-radius: 10px; }

.custom-sar-table { width: 100%; border-collapse: collapse; background: rgba(255, 255, 255, 0.03); color: #fff; font-size: 0.95rem; }
.custom-sar-table th { background: #3b82c4; color: white; padding: 12px; text-align: left; font-weight: 600; }
.custom-sar-table td { padding: 10px 12px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
.custom-sar-table tbody tr:hover { background: rgba(59, 130, 196, 0.1); }

.row-others { font-style: italic; color: #b0c4de; }
.row-total { background: rgba(59, 130, 196, 0.2); font-weight: 800; color: #fff; font-size: 1.1rem; }
.row-total td { border-top: 2px solid #3b82c4; }

/* --- ANIMATIONS --- */
.article-extra { max-height: 0; overflow: hidden; transition: max-height 0.8s ease, opacity 0.5s; opacity: 0; }
.article-extra.active { max-height: 2000px; opacity: 1; margin-top: 25px; }
.article-highlight { background: rgba(255, 255, 255, 0.05); padding: 25px; border-radius: 15px; border-left: 4px solid #3b82c4; }

/* ==========================================================================
   BOUTON "LIRE LA SUITE / RÉDUIRE LES STATISTIQUES" - FILTRE BLANC ET TRAIT SUPPRIMÉS DE FORCE
   ========================================================================== */
a.btn-action,
a.btn-action:link,
a.btn-action:visited {
    display: inline-flex;
    align-items: center;
    gap: 12px;
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

/* S'applique aussi quand le bouton est "actif" (texte = Réduire les statistiques) */
a.btn-action.active,
a.btn-action.active:focus,
a.btn-action.active:active {
    background: #3b82c4 !important;
    color: white !important;
    text-decoration: none !important;
    border-bottom: none !important;
    outline: none !important;
    box-shadow: none !important;
}

.arrow-icon { transition: transform 0.3s; }
.btn-action.active .arrow-icon { transform: rotate(180deg); }

.reveal-left { opacity: 0; transform: translateX(-40px); transition: 1s ease-out; }
.reveal-right { opacity: 0; transform: translateX(40px); transition: 1s ease-out; }
.is-visible { opacity: 1; transform: translateX(0); }

@media (max-width: 992px) {
    .security-wrapper { flex-direction: column; }
    .security-visual { position: relative; top: 0; margin-bottom: 30px; }
}
</style>

<script>
function toggleSurete() {
    const extra = document.getElementById('extraSurete');
    const btn = document.getElementById('btnToggleSurete');
    const btnText = btn.querySelector('.btn-text');

    extra.classList.toggle('active');
    btn.classList.toggle('active');

    btnText.innerText = extra.classList.contains('active') ? "Réduire les statistiques" : "Lire la suite";
}

document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.querySelector('.reveal-left').classList.add('is-visible');
                entry.target.querySelector('.reveal-right').classList.add('is-visible');
            }
        });
    }, { threshold: 0.1 });

    observer.observe(document.querySelector('.security-wrapper'));

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