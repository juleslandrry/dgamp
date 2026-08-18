@extends('template')
@section('layout')

<div class="associations-container">
    <div class="global-overlay-assoc"></div>

    <div class="container content-z">
        <div class="assoc-header text-center">
            <span class="badge-assoc">Réseau & Partenariats</span>
            <h1 class="text-white">Autres Associations</h1>
            <p class="lead text-white">Découvrez les structures partenaires qui gravitent autour de la DGAM.</p>
        </div>

        <section class="intro-assoc-section">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="assoc-text-box">
                        <h2 class="section-title text-white">Synergie et Collaboration</h2>
                        <p class="text-white">Au-delà de nos missions régaliennes, la DGAMP collabore avec diverses associations professionnelles et culturelles. Ces partenariats visent à renforcer l'impact de nos actions sociales et à dynamiser la vie de notre secteur.</p>
                        <ul class="check-list">
                            <li class="text-white">-Réseautage professionnel</li>
                            <li class="text-white">-Partage de compétences</li>
                            <li class="text-white">-Rayonnement du secteur maritime</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 text-center">
                    <div class="img-wrapper">
                        <img src="assets/images/image105.jpeg" alt="Associations" class="img-fluid rounded-20 shadow-lg img-75-centered">
                    </div>
                </div>
            </div>
        </section>

        <section class="assoc-list-section">
            <div class="intervention-grid">
                <div class="i-card-glass text-center">
                    <div class="i-icon-circle bg-assoc"><i class=""></i></div>
                    <h3 class="text-white">Assoc. des Officiers</h3>
                    <ul class="key-points text-white">
                        <li>Défense des intérêts des cadres</li>
                        <li>Veille technique et réglementaire</li>
                        <li>Organisation de séminaires</li>
                    </ul>
                </div>
                <div class="i-card-glass text-center">
                    <div class="i-icon-circle bg-assoc"><i class=""></i></div>
                    <h3 class="text-white">Club Nautique</h3>
                    <ul class="key-points text-white">
                        <li>Promotion des sports nautiques</li>
                        <li>Activités de loisirs maritimes</li>
                        <li>Formation des jeunes talents</li>
                    </ul>
                </div>
                <div class="i-card-glass text-center">
                    <div class="i-icon-circle bg-assoc"><i class=""></i></div>
                    <h3 class="text-white">Amicale des Femmes</h3>
                    <ul class="key-points text-white">
                        <li>Promotion du leadership féminin</li>
                        <li>Actions caritatives et sociales</li>
                        <li>Entraide entre les membres</li>
                    </ul>
                </div>
            </div>
        </section>

        
    </div>
</div>

<style>
    /* BACKGROUND GLOBAL (Réutilisation de l'image 33 pour la cohérence) */
    .associations-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-image: url('assets/images/image33.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding-bottom: 80px;
    }

    .global-overlay-assoc {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(24, 23, 23, 0.9) 100%);
        z-index: 1;
    }

    .content-z { position: relative; z-index: 2; }

    /* HEADER : Alignement strict sur Prévoyance et Vie Sociale */
    .assoc-header { 
        padding: 100px 0 50px; 
        color: white; 
    }
    .assoc-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }

    /* IMAGE 75% */
    .img-75-centered {
        max-width: 75% !important;
        height: auto;
        margin: 0 auto;
        display: block;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .badge-assoc { background: #e37419; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #e37419; margin-top: 10px; }

    /* LISTES */
    .check-list { list-style: none; padding: 0; margin-top: 20px; }
    .check-list li { margin-bottom: 12px; }
    .check-list li i { color: #e37419; margin-right: 12px; }

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

    /* CARTES & ICONES */
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
        width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; 
        margin: 0 auto 15px; font-size: 24px; color: white; 
    }
    .bg-assoc { background: #e37419; }

    

    @media (max-width: 768px) {
        .assoc-header h1 { font-size: 2.2rem; }
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
    }
</style>

@endsection