@extends('template')
@section('layout')

<div class="vie-sociale-container">
    <div class="global-overlay-social"></div>

    <div class="container content-z">
        <div class="social-header text-center">
            <span class="badge-social">Épanouissement & Cohésion</span>
            <h1 class="text-white">Vie Sociale à la DGAM</h1>
            <p class="lead text-white">Plus qu'une administration, une communauté soudée au service de la mer.</p>
            
            <div class="social-tags mt-4">
                <span class="tag text-white"><i class="fas fa-cocktail"></i> Loisirs</span>
                <span class="tag text-white"><i class="fas fa-running"></i> Sport</span>
                <span class="tag text-white"><i class="fas fa-handshake"></i> Entraide</span>
            </div>
        </div>

        <section class="activities-section">
            <div class="row align-items-center">
                <div class="col-md-5 text-center order-md-2">
                    <div class="img-wrapper">
                        <img src="assets/images/image68.jpeg" alt="Vie de groupe" class="img-fluid rounded-20 shadow-lg img-75-centered">
                    </div>
                </div>
                <div class="col-md-7 order-md-1">
                    <div class="social-text-box">
                        <h2 class="section-title text-white">Le Bien-être au Travail</h2>
                        <p class="text-white">La Direction Générale des Affaires Maritimes et Portuaires s'engage à offrir un cadre de vie stimulant. Nous croyons que la performance passe par l'équilibre et la fraternité entre les agents.</p>
                        <div class="row mt-4">
                            <div class="col-6">
                                <ul class="social-list">
                                    <li class="text-white">-Espaces de détente</li>
                                    <li class="text-white">-Tournois sportifs</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="social-list">
                                    <li class="text-white">-Sorties de cohésion</li>
                                    <li class="text-white">-Cérémonies annuelles</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pillars-section">
            <div class="intervention-grid">
                <div class="i-card-glass text-center">
                    <div class="i-icon-circle bg-pink"></div>
                    <h3 class="text-white">Clubs des Agents</h3>
                    <ul class="key-points text-white">
                        <li>Partage de passions communes</li>
                        <li>Renforcement des liens inter-services</li>
                        <li>Activités hebdomadaires</li>
                    </ul>
                </div>
                <div class="i-card-glass text-center">
                    <div class="i-icon-circle bg-green"></div>
                    <h3 class="text-white">Arbre de Noël</h3>
                    <ul class="key-points text-white">
                        <li>Célébration familiale annuelle</li>
                        <li>Distribution de cadeaux</li>
                        <li>Spectacles et animations</li>
                    </ul>
                </div>
                <div class="i-card-glass text-center">
                    <div class="i-icon-circle bg-purple"></div>
                    <h3 class="text-white">Excursions</h3>
                    <ul class="key-points text-white">
                        <li>Découverte du patrimoine maritime</li>
                        <li>Détente hors du cadre pro</li>
                        <li>Voyages de groupe organisés</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="cta-glass-box text-center">
            <h3 class="text-white">Revivez nos meilleurs moments</h3>
            <p class="text-white">Consultez l'album photo des événements récents de la DGAM.</p>
            <a href="{{ route('galerie_img') }}" class="btn-social-action mt-3">
                <i class="fas fa-images"></i> Voir la Galerie Photo
            </a>
        </div>
    </div>
</div>

<style>
    /* BACKGROUND GLOBAL */
    .vie-sociale-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-image: url('assets/images/image33.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding-bottom: 80px;
    }

    .global-overlay-social {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(20, 20, 20, 0.85) 100%);
        z-index: 1;
    }

    .content-z { position: relative; z-index: 2; }

    /* HEADER : Même niveau que Prévoyance (100px) */
    .social-header { 
        padding: 100px 0 50px; 
        color: white; 
    }
    .social-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }

    /* IMAGE 75% */
    .img-75-centered {
        max-width: 75% !important;
        height: auto;
        margin: 0 auto;
        display: block;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .badge-social { background: #e37419; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }
    .tag { background: rgba(255, 255, 255, 0.15); padding: 8px 15px; border-radius: 10px; margin: 0 5px; font-size: 0.9rem; border: 1px solid rgba(255,255,255,0.1); }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #e37419; margin-top: 10px; }

    /* LISTES ET POINTS */
    .social-list { list-style: none; padding: 0; }
    .social-list li { margin-bottom: 12px; }
    .social-list li i { color: #e37419; margin-right: 10px; }

    .key-points { 
        list-style: none; 
        padding: 0; 
        margin-top: 15px; 
        text-align: left;
        display: inline-block;
    }
    .key-points li { 
        position: relative;
        padding-left: 20px;
        margin-bottom: 8px;
        font-size: 0.95rem;
        opacity: 0.9;
    }
    .key-points li::before {
        content: "•";
        color: #e37419;
        font-weight: bold;
        position: absolute;
        left: 0;
        font-size: 1.2rem;
    }

    /* CARTES & ICONES : Alignées sur le modèle Prévoyance */
    .intervention-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-top: 50px; }
    .i-card-glass {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 35px 25px;
        border-radius: 20px;
        transition: 0.3s;
    }
    .i-card-glass:hover { transform: translateY(-8px); border-color: #e37419; }

    .i-icon-circle { 
        width: 60px; 
        height: 60px; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        margin: 0 auto 15px; 
        font-size: 24px; 
        color: white; 
    }
    .bg-pink, .bg-purple { background: #e37419; }
    .bg-green { background: #1d976c; }

    /* CTA & BOUTON (Pas de barre bleue) */
    .cta-glass-box { background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); padding: 35px; border-radius: 20px; margin-top: 40px; }
    .btn-social-action { 
        background: #1d976c; 
        color: white !important; 
        padding: 12px 25px; 
        border-radius: 8px; 
        text-decoration: none !important; 
        font-weight: 700; 
        display: inline-block;
        border: none;
        outline: none !important;
        box-shadow: none !important;
    }
    .btn-social-action:hover { background: #e37419; color: white !important; }

    @media (max-width: 768px) {
        .social-header h1 { font-size: 2.2rem; }
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
    }
</style>

@endsection