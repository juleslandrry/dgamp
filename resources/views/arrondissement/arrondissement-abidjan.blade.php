@extends('template')
@section('layout')

<section class="adiake-section">
    <div class="adiake-bg-fixed"></div>

    <div class="adiake-container">
        
        <div class="adiake-header-main">
            <h3 class="adiake-main-title">Arrondissement Maritime d'Abidjan</h3>
        </div>

        <div class="adiake-grid">
            <div class="adiake-visual">
                <div class="frame-3d">
                    <img src="assets/images/image95.jpeg" alt="Littoral d'Abidjan">
                    <div class="frame-overlay"></div>
                </div>
            </div>

            <div class="adiake-text-box">
                <div class="text-scroll-area">
                    <div class="content-visible">
                        <section class="text-part">
                            <h4>I/ Fonctionnement et Organisation</h4>
                            <div class="sub-part">
                                <h5>A/ Fonctionnement</h5>
                                <p>
                                    C’est un Arrondissement atypique par rapport aux (7) sept autres. Son ressort territorial n’épouse pas les limites du Département d’Abidjan d’une part et d’autre part, il n’a pas d’attribution exclusif car, sur l’espace territorial qui lui est concédé, les missions opérationnelles ne sont pas de son seul ressort. Des Services de l’Administration Centrale de la DGAMP exercent des missions opérationnelles au même titre que l’Arrondissement Maritime d’Abidjan.
                                </p>

                                <h5>B/ Organisation</h5>
                                <p>L’Arrondissement Maritime d’Abidjan comprend les Services suivants :</p>
                                <ul class="adiake-list">
                                    <li>Un secrétariat</li>
                                    <li>Une Assistante comptable</li>
                                    <li>Une Régie de Recettes</li>
                                    <li>Un Service des Ressources Humaines et du Matériel</li>
                                    <li>Un Service du Domaine Public et des activités balnéaires</li>
                                    <li>Un Service de la Police</li>
                                    <li>Un Service manifeste</li>
                                </ul>
                                <p>Outre ses Services, il comprend :</p>
                                <ul class="adiake-list">
                                    <li>L’Antenne Maritime de Bingerville</li>
                                    <li>La Station Maritime d’Anyama-débarcadère située dans la Sous-préfecture de Brofodoumé</li>
                                </ul>
                            </div>
                        </section>

                        <section class="text-part">
                            <h4>II/ Les Activités</h4>
                            <div class="sub-part">
                                <p>En dehors des compétences spécifiques du Chef d’Arrondissement (signatures de relevés, rôles d'équipage, enquêtes...), les activités portent sur :</p>
                                <ul class="adiake-list">
                                    <li>La police balnéaire et de la navigation</li>
                                    <li>La surveillance du plan d’eau intérieur</li>
                                    <li>La police du Domaine et des activités balnéaires</li>
                                    <li>L’émission des Ordres de Recettes et le Recouvrement des Taxes</li>
                                </ul>
                            </div>
                        </section>
                    </div>

                    <div class="content-hidden" id="extra-content">
                        <section class="text-part">
                            <h4>III/ Les Partenaires</h4>
                            <ul class="adiake-list">
                                <li>Les consignataires et compagnies d’armements à la pêche</li>
                                <li>Les occupants du Domaine Public Maritime et Lagunaire</li>
                                <li>Les plaisanciers et transporteurs lagunaires</li>
                                <li>Les marins et propriétaires de dragues/barges</li>
                                <li>Les ateliers de réparations et de constructions navales</li>
                            </ul>
                        </section>

                        <section class="text-part">
                            <h4>IV/ Les Moyens de l'Arrondissement</h4>
                            
                            <div class="moyens-block">
                                <strong>A/ Au plan humain</strong>
                                <div class="table-container">
                                    <table class="dgam-table">
                                        <thead>
                                            <tr>
                                                <th>Personnel</th>
                                                <th>Abidjan</th>
                                                <th>Bingerville</th>
                                                <th>Anyama</th>
                                                <th class="col-total">Totaux</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td class="label">Administrateurs</td><td>01</td><td>-</td><td>-</td><td class="row-total">01</td></tr>
                                            <tr><td class="label">Officiers</td><td>02</td><td>01</td><td>-</td><td class="row-total">03</td></tr>
                                            <tr><td class="label">Contrôleurs</td><td>06</td><td>05</td><td>02</td><td class="row-total">13</td></tr>
                                            <tr>
                                                <td class="label">Agents de Police</td>
                                                <td>40 <small>(dont 15 stag.)</small></td>
                                                <td>23 <small>(dont 15 stag.)</small></td>
                                                <td>15 <small>(stag.)</small></td>
                                                <td class="row-total">78</td>
                                            </tr>
                                            <tr><td class="label">Assistants comptable</td><td>01</td><td>-</td><td>-</td><td class="row-total">01</td></tr>
                                            <tr><td class="label">Secrétaires</td><td>01</td><td>02</td><td>-</td><td class="row-total">03</td></tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="final-total">
                                                <td>Effectif total :</td><td>51</td><td>31</td><td>17</td><td class="grand-total">99</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="moyens-block">
                                <strong>B/ Au plan matériel</strong>
                                <div class="table-container">
                                    <table class="dgam-table">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Type d’engin</th>
                                                <th>Usage</th>
                                                <th>Marque</th>
                                                <th>Date</th>
                                                <th>Immatriculation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td class="num">01</td><td class="label">Véhicule SUV</td><td>Fonction</td><td>KIA Seltos</td><td>14/10/21</td><td class="plate">D 60 142</td></tr>
                                            <tr><td class="num">02</td><td class="label">Véhicule 4*4 Abidjan</td><td>Service</td><td>Toyota Hilux</td><td>28/02/20</td><td class="plate">D 60 527</td></tr>
                                            <tr><td class="num">03</td><td class="label">Véhicule 4*4 Bingerville</td><td>Service</td><td>Toyota Hilux</td><td>2021</td><td class="plate">D 60 288</td></tr>
                                            <tr><td class="num">04</td><td class="label">Quadricycle <span class="status-off">(HS)</span></td><td>Service</td><td>CAN-AM</td><td>24/01/20</td><td class="plate">D 60 195</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="adiake-actions">
                    <button class="btn-adiake-explore" id="toggle-btn">
                        <span class="btn-text" id="btn-label">Voir plus de détails</span>
                        <span class="btn-circle">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 10L12 15L17 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    :root {
        --adiake-accent: #1361b5;
        --glass-bg: rgba(255, 255, 255, 0.03);
    }

    .adiake-section {
        position: relative;
        min-height: 850px;
        padding: 80px 0;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        font-family: 'Inter', sans-serif;
    }

    .adiake-bg-fixed {
        position: absolute;
        inset: 0;
        background: url('assets/images/image33.jpeg') center/cover no-repeat fixed;
        filter: brightness(0.15);
        z-index: 1;
    }

    .adiake-container {
        position: relative;
        z-index: 3;
        width: 90%;
        max-width: 1250px;
        margin: 0 auto;
    }

    .adiake-header-main {
        text-align: center;
        margin-bottom: 50px;
        opacity: 0;
        transform: translateY(-30px);
        transition: 1s ease-out;
    }

    .adiake-main-title {
        font-size: 3.5rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .adiake-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 50px;
        align-items: flex-start;
    }

    /* Visuel 3D */
    .adiake-visual { perspective: 1200px; position: sticky; top: 100px; }
    .frame-3d {
        position: relative;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.1);
        transition: transform 0.2s ease-out;
    }
    .frame-3d img { width: 100%; height: 550px; object-fit: cover; display: block; }

    /* Zone de Texte */
    .adiake-text-box {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        padding: 40px;
        border-radius: 30px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .text-part { margin-bottom: 30px; }
    .text-part h4 { color: var(--adiake-accent); font-size: 1.25rem; margin-bottom: 15px; text-transform: uppercase; font-weight: 700; }
    .sub-part h5 { color: #fff; font-size: 1rem; margin: 15px 0 10px; font-weight: 600; }
    .text-part p { font-size: 0.95rem; line-height: 1.6; opacity: 0.85; margin-bottom: 15px; }

    .adiake-list { list-style: none; padding-left: 0; margin-bottom: 15px; }
    .adiake-list li {
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
        font-size: 0.9rem;
        opacity: 0.85;
    }
    .adiake-list li::before {
        content: "→";
        position: absolute;
        left: 0;
        color: var(--adiake-accent);
    }

    .moyens-block { margin-top: 25px; }
    .moyens-block strong { display: block; margin-bottom: 10px; color: var(--adiake-accent); }

    /* Tableaux */
    .table-container { overflow-x: auto; margin-top: 15px; border-radius: 12px; }
    .dgam-table { width: 100%; border-collapse: collapse; background: rgba(255,255,255,0.02); font-size: 0.85rem; }
    .dgam-table th, .dgam-table td { padding: 12px; border: 1px solid rgba(255,255,255,0.1); text-align: center; }
    .dgam-table th { background: rgba(255,255,255,0.05); text-transform: uppercase; font-size: 0.75rem; }
    .dgam-table td.label { text-align: left; font-weight: 600; color: #fff; }
    .col-total, .row-total { background: rgba(0, 175, 193, 0.1); font-weight: bold; }
    .grand-total { background: var(--adiake-accent) !important; color: #fff; }
    .num { color: var(--adiake-accent); font-weight: bold; }
    .plate { font-family: monospace; background: rgba(255,255,255,0.05); }
    .status-off { color: #ff4d4d; }
    small { opacity: 0.6; font-style: italic; }

    /* Animation Voir Plus */
    .content-hidden { max-height: 0; overflow: hidden; opacity: 0; transition: all 0.7s ease; }
    .content-hidden.is-open { max-height: 1500px; opacity: 1; }

    /* Bouton */
    .btn-adiake-explore {
        background: transparent; border: none; display: inline-flex;
        align-items: center; gap: 15px; color: #fff; cursor: pointer;
        font-weight: 600; transition: all 0.3s ease; margin-top: 20px;
        outline: none;
        -webkit-tap-highlight-color: transparent;
    }
    .btn-adiake-explore:hover,
    .btn-adiake-explore:focus,
    .btn-adiake-explore:active,
    .btn-adiake-explore:focus-visible {
        outline: none;
        border: none;
        box-shadow: none;
    }
    .btn-circle {
        width: 45px; height: 45px; border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        position: relative; overflow: hidden; transition: 0.4s;
    }
    .btn-circle::before {
        content: ''; position: absolute; top: 100%; left: 0; width: 100%; height: 100%;
        background: var(--adiake-accent); transition: 0.4s; z-index: 1;
    }
    .btn-adiake-explore:hover .btn-circle::before { top: 0; }
    .btn-adiake-explore:hover .btn-text { color: var(--adiake-accent); }
    .btn-circle svg { width: 18px; z-index: 2; transition: 0.4s; stroke: #fff; }
    .btn-adiake-explore.active .btn-circle svg { transform: rotate(180deg); }

    .adiake-section.is-visible .adiake-header-main { opacity: 1; transform: translateY(0); }

    @media (max-width: 992px) {
        .adiake-grid { grid-template-columns: 1fr; }
        .adiake-visual { display: none; }
        .adiake-main-title { font-size: 2.2rem; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.adiake-section');
    const toggleBtn = document.getElementById('toggle-btn');
    const extraContent = document.getElementById('extra-content');
    const frame = document.querySelector('.frame-3d');
    const btnLabel = document.getElementById('btn-label');

    setTimeout(() => section.classList.add('is-visible'), 150);

    toggleBtn.addEventListener('click', () => {
        const isOpen = extraContent.classList.toggle('is-open');
        toggleBtn.classList.toggle('active');
        btnLabel.textContent = isOpen ? "Réduire les informations" : "Voir plus de détails";
    });

    section.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e;
        const xMove = (clientX / window.innerWidth - 0.5) * 15;
        const yMove = (clientY / window.innerHeight - 0.5) * 15;
        frame.style.transform = `rotateY(${xMove}deg) rotateX(${-yMove}deg)`;

        const rect = toggleBtn.getBoundingClientRect();
        const dist = Math.hypot(clientX - (rect.left + rect.width/2), clientY - (rect.top + rect.height/2));
        if(dist < 100) {
            toggleBtn.style.transform = `translate(${(clientX - (rect.left + rect.width/2)) * 0.3}px, ${(clientY - (rect.top + rect.height/2)) * 0.3}px)`;
        } else {
            toggleBtn.style.transform = `translate(0, 0)`;
        }
    });

    section.addEventListener('mouseleave', () => {
        frame.style.transform = `rotateY(0) rotateX(0)`;
        toggleBtn.style.transform = `translate(0, 0)`;
    });
});
</script>

@endsection