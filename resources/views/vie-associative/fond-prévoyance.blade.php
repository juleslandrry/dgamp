@extends('template')
@section('layout')

<div class="prevoyance-site-container">
    <div class="global-overlay"></div>

    <div class="container content-z">
        <div class="prevoyance-header-v2 text-center">
            <span class="badge-top">Protection & Solidarité</span>
            <h1>Fonds de Prévoyance DGAM</h1>
            <p class="lead">Garantir l'avenir de ceux qui veillent sur nos côtes.</p>
            
            <div class="header-stats">
                <div class="stat-item text-center">
                    <span class="stat-val">100%</span>
                    <span class="stat-lab">Engagé</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item text-center">
                    <span class="stat-val">Solidarité</span>
                    <span class="stat-lab">Notre Force</span>
                </div>
            </div>
        </div>

        <section class="vision-section">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="vision-text-box">
                        <h2 class="section-title">Pourquoi ce fonds ?</h2>
                        <p>Le Fonds de Prévoyance de la DGAM est un levier de solidarité agissant pour l'amélioration du bien-être social des agents. Il intervient pour soutenir les membres face aux aléas de la vie.</p>
                        <ul class="check-list">
                            <li>_Assistance en cas de maladie</li>
                            <li>_Soutien aux familles (Décès)</li>
                            <li>_Prêts sociaux et secours immédiats</li>
                            <li>_Accompagnement à la retraite</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 text-center">
                    <div class="vision-img-container">
                        <img src="assets/images/image104.jpeg" alt="Solidarité" class="img-fluid rounded-20 shadow-lg img-75-centered">
                    </div>
                </div>
            </div>
        </section>

        <section class="intervention-section">
            <h2 class="text-center mb-5 text-white fw-bold">Nos Domaines d'Intervention</h2>
            <div class="intervention-grid">
                <div class="i-card-glass">
                    <div class="i-icon"><i class="fas fa-hand-holding-medical"></i></div>
                    <h3>Santé & Soins</h3>
                    <p>Prise en charge complémentaire des frais médicaux et évacuations sanitaires pour l'agent et sa famille.</p>
                </div>
                <div class="i-card-glass">
                    <div class="i-icon"></div>
                    <h3>Risques Vie</h3>
                    <p>Une couverture solide en cas d'invalidité ou de décès, assurant un capital aux ayants droit.</p>
                </div>
                <div class="i-card-glass">
                    <div class="i-icon"></div>
                    <h3>Épargne Retraite</h3>
                    <p>Préparer votre fin de carrière en toute sérénité avec des dispositifs d'épargne bonifiés.</p>
                </div>
            </div>
        </section>

        <div class="cta-glass-box">
            <div class="row align-items-center">
                <div class="col-md-8 text-center text-md-start text-white">
                    <h3>Devenir membre du Fonds de Prévoyance</h3>
                    <p class="mb-md-0">Téléchargez le formulaire d'adhésion et consultez le règlement intérieur.</p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <a href="#" class="btn-orange-action">
                        <i class="fas fa-file-pdf"></i> Guide de l'adhérent
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* BACKGROUND GLOBAL */
    .prevoyance-site-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-image: url('assets/images/image33.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding-bottom: 100px;
    }

    .global-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.7) 0%, rgba(6, 6, 6, 0.8) 50%, rgba(0, 0, 0, 0.6) 100%);
        z-index: 1;
    }

    .content-z { position: relative; z-index: 2; }

    /* STYLE DE L'IMAGE D'ILLUSTRATION REDUITE */
    .img-75-centered {
        max-width: 75% !important; /* Taille à 75% */
        height: auto;
        margin: 0 auto; /* Centrage */
        display: block;
    }

    /* TYPOGRAPHIE & COULEURS */
    .prevoyance-header-v2 { padding: 100px 0 50px; color: white; }
    .prevoyance-header-v2 h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }
    .badge-top { background: #ea810a; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }
    
    .header-stats { display: flex; justify-content: center; gap: 30px; margin-top: 25px; color: white; }
    .stat-val { font-size: 2.2rem; font-weight: 800; color: #ea810a; display: block; }
    .stat-divider { width: 1px; height: 50px; background: rgba(255,255,255,0.3); }

    .vision-section { padding: 50px 0; color: white; }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #ea810a; margin-top: 10px; }
    .check-list { list-style: none; padding: 0; margin-top: 20px; }
    .check-list li { margin-bottom: 12px; display: flex; align-items: center; }
    .check-list li i { color: #ea810a; margin-right: 12px; }

    .rounded-20 { border-radius: 20px; }

    /* CARTES GLASS */
    .intervention-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; }
    .i-card-glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 35px 25px;
        border-radius: 20px;
        text-align: center;
        color: white;
        transition: 0.3s;
    }
    .i-card-glass:hover { transform: translateY(-8px); border-color: #ea810a; }
    .i-icon { width: 60px; height: 60px; background: #ea810a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 24px; }

    /* CTA */
    .cta-glass-box { background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 35px; border-radius: 20px; margin-top: 40px; }
    .btn-orange-action { background: #ea810a; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: 0.3s; display: inline-block; }
    .btn-orange-action:hover { background: white; color: #ea810a; text-decoration: none; }

    @media (max-width: 768px) {
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
        .stat-divider { display: none; }
        .header-stats { flex-direction: column; gap: 15px; }
    }
</style>

@endsection