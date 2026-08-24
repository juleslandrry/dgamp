<!doctype html>
<html lang="en">

<head>
    <!--
    /   Multipurpose: Free Template by FreeHTML5.co
    /   Author: https://freehtml5.co
    /   Facebook: https://facebook.com/fh5co
    /   Twitter: https://twitter.com/fh5co
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Affaires Maritimes Ivoiriennes</title>
    <link rel="icon" href="assets/images/logo_Dgamp.jpeg" type="image/jp">

    <!-- Stylesheets & Fonts -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i%7CRajdhani:400,600,700"
        rel="stylesheet">
    <!-- Plugins Stylesheets -->
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- Loader Start 
    <div class="css-loader">
        <div class="loader-inner line-scale d-flex align-items-center justify-content-center"></div>
    </div>
     Loader End -->
    <!-- Header Start -->
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DGAMP - Direction Générale des Affaires Maritimes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<header class="main-header">
    <div class="top-header">
            <div class="container-fluid px-lg-5">
                <div class="top-header-wrapper">

                    <div class="contact-links">
                        <a href="tel:+2252722408035">
                            <i class="fa fa-phone"></i> (+225) 27 22 40 80 35
                        </a>

                        <a href="mailto:info@dgamp.ci">
                            <i class="fa fa-envelope"></i> info@dgamp.ci
                        </a>
                    </div>

                    <div class="social-links">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </div>

                </div>
            </div>
    </div>

    <div class="navbar-section">
        <div class="container-fluid px-lg-5">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ route ('accueildgamp') }}">
                    <img src="{{ asset('assets/images/logo_Dgamp.jpeg') }}" alt="Logo DGAMP">
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavMenu">
                    <span class="navbar-toggler-icon"><i class="fa fa-bars" style="color:#19173a; font-size:24px;"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavMenu">
                    <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item">
                            <a href="" class="nav-link">Accueil</a>
                            <ul class="dropdown-menu-custom">
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">À propos</a>
                                    <ul class="submenu-custom">
                                        <li class="dropdown-item-container">
                                            <a href="#" class="has-arrow">Direction Générale</a>
                                            <ul class="submenu-custom">
                                                <li><a href="{{ route('motdudg') }}">Mot du DG</a></li>
                                                <li><a href="{{ route('biographiedudg') }}">Biographie</a></li>
                                                <li><a href="{{ route ('ecrireaudg') }}">Écrits du DG</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item-container">
                                            <a href="#" class="has-arrow">Organisation</a>
                                            <ul class="submenu-custom">
                                                <li><a href="{{ route('historiquedgam') }}">Historique</a></li>
                                                <li><a href="{{ route('missionetobjectif') }}">Missions et Objectifs</a></li>
                                                <li><a href="{{ route('organigramedgam') }}">Organigramme</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-item-container">
                                            <a href="#" class="has-arrow">Documentation</a>
                                            <ul class="submenu-custom">
                                                <li class="dropdown-item-container">
                                                    <a href="#" class="has-arrow">Textes Nationaux</a>
                                                    <ul class="submenu-custom">
                                                        <li><a href="{{ route('loisdgam') }}">Lois</a></li>
                                                        <li><a href="{{ route('decretdgam') }}">Décrets</a></li>
                                                        <li><a href="{{ route('arretededecision') }}">Arrêtés et Décisions</a></li>
                                                    </ul>
                                                </li>
                                                <li class="dropdown-item-container">
                                                    <a href="#" class="has-arrow">Textes Internationaux</a>
                                                    <ul class="submenu-custom">
                                                        <li><a href="{{ route('conventiondgam') }}">Conventions</a></li>
                                                        <li><a href="{{ route('accorddgam') }}">Accords</a></li>
                                                        <li><a href="{{ route('protocoledgam') }}">Protocoles</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Agenda</a>
                                    <ul class="submenu-custom">
                                        <li><a href="{{ route('evenàvenir') }}">Événements à venir</a></li>
                                        <li><a href="{{ route('evenpassé') }}">Événements passés</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Recrutement</a>
                                    <ul class="submenu-custom">
                                        <li><a href="{{ route('ena') }}">ENA</a></li>
                                        <li><a href="{{ route('fonctionpublique') }}">Fonction Publique</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Multimédia</a>
                                    <ul class="submenu-custom">
                                        <li><a href="{{ route('galerie_img') }}">Galerie Images</a></li>
                                        <li><a href="{{ route('galerie_vidéo') }}">Galerie Vidéos</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('communiqué') }}">Communiqués</a></li>
                                 <li><a href="{{ route('actualité') }}">Actualité</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Nos Activités</a>
                            <ul class="dropdown-menu-custom dropdown-activites">
                                <li><a href="{{ route('securitémaritime') }}">Sécurité Maritime</a></li>
                                <li><a href="{{ route('suretéportuaire') }}">Sûreté Maritime et Portuaire</a></li>
                                <li><a href="{{ route ('santépopulationmer') }}">Santé de la population en mer</a></li>
                                <li><a href="{{ route('gestionpopulationmer') }}">Gestion de la population en mer</a></li>
                                <li><a href="{{ route('plaisanceactiviténautique') }}">Plaisance et Activité Nautique</a></li>
                                <li><a href="{{ route('transportfluviolagunaire') }}">Transport Maritime & Fluvio Lagunaire</a></li>
                                <li><a href="{{ route('recouvrement') }}">Recouvrement</a></li>
                                <li><a href="{{ route('coordinationsauvetagemaritime') }}">Sauvetage Maritime (MRCC)</a></li>
                            </ul>
                        </li>

                              <li class="nav-item">
                            <a href="#" class="nav-link">Services en ligne</a>
                            <ul class="dropdown-menu-custom">
                                @foreach($servicesEnLigneMenu ?? [] as $s)
                                    <li><a href="{{ route('service.show', $s->slug) }}">{{ $s->titre }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Régions et Arrondissements</a>
                            <ul class="dropdown-menu-custom dropdown-arrondissements">
                                <li><a href="{{ route('arrondissementadiaké') }}">Arrondissement d'adiaké</a></li>
                                <li><a href="{{ route('arrondissementsanpedro') }}">Arrondissement de San-Pedro</a></li>
                                <li><a href="{{ route('arrondissementgrandbassam') }}">Arrondissement de Grand-Bassam</a></li>
                                <li><a href="{{ route('arrondissementtabou') }}">Arrondissement de Tabou</a></li>
                                <li><a href="{{ route('arrondissementabidjan') }}">Arrondissement d' abidjan</a></li>
                                <li><a href="{{ route('arrondissementjacqueville') }}">Arrondissement de jacqueville</a></li>
                                <li><a href="{{ route('arrondissementsassandra') }}">Arrondissement de sassandra</a></li>
                                <li><a href="{{ route('arrondissementgrandlahou') }}">Arrondissement de grand lahou</a></li>
                                <li><a href="{{ route('arrondissementbingerville') }}">Arrondissement de bingerville</a></li>
                                <li><a href="{{ route('arrondissementfresco') }}">Arrondissement de fresco</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Personnel</a>
                            <ul class="dropdown-menu-custom">
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Type de personnel</a>
                                    <ul class="submenu-custom">
                                        <li><a href="{{ route('personnelmilitaire') }}">Personnel Militaire</a></li>
                                        <li><a href="{{ route('personnelinterministériel') }}">Personnel Interministériel</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Vie Associative</a>
                                    <ul class="submenu-custom">
                                        <li><a href="{{ route('fondprévoyance') }}">Fonds de Prévoyance</a></li>
                                        <li><a href="{{ route('viesocial') }}">Vie Sociale</a></li>
                                        <li><a href="{{ route('autreassociation') }}">Autres Associations</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item"><a href="{{ route('opérateur') }}" class="nav-link">Opérateurs</a></li>
                        <li class="nav-item"><a href="{{ route ('partenaire') }}" class="nav-link">Partenaires</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="flash-info-container">
        <span class="flash-label"><i class="fa fa-bolt"></i> FLASH INFOS</span>
        <div class="flash-marquee">
            <div class="flash-track">
                <div class="flash-content">| Les concours DGAM/DGAM sont gérés par la Fonction Publique. Aucun concours de Police Maritime en 2024.</div>
                <div class="flash-content">| La DGAM devient la DGAM (Décret 2024-274 du 08 mai 2024). Visitez notre nouveau portail pour plus d'infos.</div>
                <div class="flash-content">| Les concours DGAM/DGAM sont gérés par la Fonction Publique. Aucun concours de Police Maritime en 2024.</div>
                <div class="flash-content">| La DGAMP devient la DGAM (Décret 2024-274 du 08 mai 2024). Visitez notre nouveau portail pour plus d'infos.</div>
            </div>
        </div>
    </div>
</header>

    <style>
                /* --- RESET & BASE --- */
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { font-family: 'Poppins', sans-serif; overflow-x: hidden; background-color: #f4f7f6; }

                /* --- HEADER PLEINE LARGEUR --- */
                .main-header {
                    width: 100%;
                    position: sticky;
                    top: 0;
                    z-index: 2000;
                    background-color: #4f85d6;
                }

                /* TOP HEADER */
                .top-header {
                    background: #0c9735;
                    padding: 8px 0;
                    font-size: 14px;
                }

                .top-header-wrapper {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap; /* important pour responsive */
                }

                .contact-links a,
                .social-links a {
                    color: #fff;
                    margin-right: 15px;
                    text-decoration: none;
                    transition: 0.3s;
                }

                .contact-links a:hover,
                .social-links a:hover {
                    color: #ea810a;
                }

                /* Icônes sociales */
                .social-links a {
                    font-size: 16px;
                }

                /* 📱 MOBILE */
                @media (max-width: 768px) {

                    .top-header-wrapper {
                        flex-direction: column;
                        text-align: center;
                        gap: 8px;
                    }

                    .contact-links {
                        display: flex;
                        flex-direction: column;
                        gap: 5px;
                    }

                    .social-links {
                        margin-top: 5px;
                    }
                }

                /* Très petit écran */
                @media (max-width: 400px) {
                    .contact-links a {
                        font-size: 12px;
                    }

                    .social-links a {
                        font-size: 14px;
                    }
                }

                /* Top Bar */
                .top-header {
                    background-color: #4f85d6;
                    padding: 10px 0;
                    border-bottom: 1px solid rgba(255,255,255,0.1);
                }
                .top-header a { color: #fff; font-size: 13px; text-decoration: none; margin-right: 25px; transition: 0.3s; }
                .top-header a:hover { color: #ffffff; }
                .top-header i { color: #ffffff; margin-right: 8px; }

                /* Navbar Section */
                .navbar-section { background-color: #fff; border-bottom: 1px solid #ddd; }
                .navbar { padding: 0; }
                .navbar-brand img { height: 65px; padding: 5px 0; }

                /* --- NAVIGATION & DROPDOWNS --- */
                .navbar-nav .nav-item { position: relative; }
                .nav-link {
                    color: #191e3a !important;
                    font-weight: 700;
                    font-size: 13px;
                    text-transform: uppercase;
                    padding: 25px 15px !important;
                    transition: 0.3s;
                    
                }
                .nav-link:hover { color: #64b1da !important; background: #f8f9fa; }

                /* Menus Déroulants (Niveau 1) */
                .dropdown-menu-custom {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    background: #fff;
                    min-width: 200px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                    opacity: 0;
                    visibility: hidden;
                    transform: translateY(15px);
                    transition: all 0.3s ease;
                    list-style: none;
                    padding: 5px 0;
                    border-top: 4px solid #1b7015;
                    z-index: 2000;
                }

                /* Sous-menus (Niveaux 2 et 3) */
                .submenu-custom {
                    position: absolute;
                    top: 0;
                    left: 100%; /* S'ouvre à droite */
                    background: #fff;
                    min-width: 170px;
                    box-shadow: 5px 5px 20px rgba(0,0,0,0.1);
                    opacity: 0;
                    visibility: hidden;
                    transform: translateX(15px);
                    transition: all 0.3s ease;
                    list-style: none;
                    padding: 10px 0;
                    border-left: 2px solid #156916;
                    flex-wrap: wrap
                    
                }
        

                /* Hover Logic */
                .nav-item:hover > .dropdown-menu-custom,
                .dropdown-item-container:hover > .submenu-custom {
                    opacity: 1;
                    visibility: visible;
                    transform: translate(0, 0);
                }

                .dropdown-menu-custom li a {
                    display: block;
                    padding: 12px 20px;
                    color: #333;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                    border-bottom: 1px solid #f1f1f1;
                }
                .dropdown-menu-custom li a:hover {
                    background: #26842e;
                    color: #fff;
                    padding-left: 25px;
                }
                .dropdown-item-container { position: relative; }

                /* Indicateur de sous-menu */
                .has-arrow::after {
                    content: "\f105";
                    font-family: FontAwesome;
                    float: right;
                    margin-top: 2px;
                }

                /* --- FLASH INFO PLEINE LARGEUR --- */
                .flash-info-container {
                    width: 100%;
                    background: #4f85d6;
                    display: flex;
                    align-items: center;
                    overflow: hidden;
                    padding: 2px;
                }
                .flash-label {
                    background: #118106;
                    color: #fff;
                    padding: 0 15px;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    font-weight: 800;
                    font-size: 15px;
                    white-space: nowrap;
                    z-index: 1;
                    position: relative;
                }
                .flash-marquee { flex: 1; overflow: hidden; }
                .flash-track {
                    display: flex;
                    width: max-content;
                    animation: flashScroll 35s linear infinite;
                }
                .flash-content {
                    color: #fff;
                    font-weight: 500;
                    font-size: 14px;
                    padding-right: 120px;
                    white-space: nowrap;
                }
                @keyframes flashScroll {
                    0% { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                .flash-info-container:hover .flash-track { animation-play-state: paused; }

                /* Mobile Fix */
                @media (max-width: 991px) {
                    .navbar-collapse { background: #fff; max-height: 80vh; overflow-y: auto; }
                    .submenu-custom { position: static; visibility: visible; opacity: 1; transform: none; display: none; box-shadow: none; padding-left: 20px; }
                    .dropdown-item-container:hover .submenu-custom { display: block; }
                }

                /* ===== CORRECTIF POUR RÉGIONS & ARRONDISSEMENTS ET NOS ACTIVITÉS ===== */
                .main-header {
                    overflow: visible !important;
                }
                .navbar-section,
                .navbar,
                .navbar-nav,
                .navbar-collapse {
                    overflow: visible !important;
                }
                .dropdown-arrondissements,
                .dropdown-activites {
                    z-index: 9999 !important;
                    max-height: 80vh;
                    overflow-y: auto;
                    scrollbar-width: thin;
                    scrollbar-color: #1b7015 #f1f1f1;
                }
                .dropdown-arrondissements::-webkit-scrollbar,
                .dropdown-activites::-webkit-scrollbar {
                    width: 4px;
                }
                .dropdown-arrondissements::-webkit-scrollbar-thumb,
                .dropdown-activites::-webkit-scrollbar-thumb {
                    background: #1b7015;
                    border-radius: 4px;
                }

    </style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



<script>
        document.addEventListener("DOMContentLoaded", function () {

            if (window.innerWidth <= 991) {

                document.querySelectorAll(".nav-item > .nav-link").forEach(function(link) {
                    link.addEventListener("click", function(e) {
                        const parent = this.parentElement;
                        const submenu = parent.querySelector(".dropdown-menu-custom");

                        if (submenu) {
                            e.preventDefault();
                            parent.classList.toggle("active");
                        }
                    });
                });

                document.querySelectorAll(".dropdown-item-container > .has-arrow").forEach(function(link) {
                    link.addEventListener("click", function(e) {
                        const parent = this.parentElement;
                        const submenu = parent.querySelector(".submenu-custom");

                        if (submenu) {
                            e.preventDefault();
                            parent.classList.toggle("active");
                        }
                    });
                });

            }
        });
        
</script>



 @yield('layout')


 <footer>
        <!-- Widgets Start -->
    <div class="footer-widgets">
        <div class="container">

            <div class="row dernière_partie">
                        <!-- LIGNE 1 : 3 COLONNES -->

                    <!-- LOCALISATION -->
                    <div class="col-md-4 mb-4">
                        <div class="footer-item">
                            <div class="icon-title">
                                <i class="fa fa-map-marker"></i>
                                <h4>LOCALISATION</h4>
                            </div>
                            <p> Vous pouvez nous retrouver ici:
                            <div class="map-footer">
                                    <iframe 
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.227642840733!2d-4.000955126503041!3d5.38222743537576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1954b63b533a7%3A0x4df51f6b1a72359e!2sDgamp!5e0!3m2!1sen!2sci!4v1772038225999!5m2!1sen!2sci" 
                                        width="100%" 
                                        height="200" 
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy">
                                    </iframe>
                            </div>

                        </div>
                    </div>
                    <!-- CONTACT -->
                    <div class="col-md-4 mb-4">
                        <div class="footer-item">
                            <div class="icon-title">
                                <i class="fa fa-phone"></i>
                                <h4>CONTACT</h4>
                            </div>

                            <p class="contact-line">
                                <i class="fa fa-phone"></i>
                                (+225) 27 22 40 80 35
                            </p>

                            <p class="contact-line">
                                <i class="fa fa-envelope"></i>
                                info@dgamp.ci
                            </p>

                            <p class="contact-line">
                                <i class="fa fa-globe"></i>
                                www.dgamp.ci
                            </p>
                        </div>
                    </div>


                    <!-- SUIVEZ NOUS -->
                    <div class="col-md-4 mb-4">
                        <div class="footer-item">
                            <div class="icon-title">
                                <i class="fa fa-share-alt"></i>
                                <h4>SUIVEZ-NOUS</h4>
                            </div>

                            <ul class="social-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
            </div>
       

           <hr>

          <!-- LIGNE 2 : CONTACTEZ NOUS -->
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mb-4">CONTACTEZ-NOUS</h3>

                    <form class="contact-form">

                        <!-- INPUTS HORIZONTAUX -->
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" placeholder="Votre nom">
                            </div>
                            <div class="col-md-4">
                                <input type="email" placeholder="Votre email">
                            </div>
                            <div class="col-md-4">
                                <input type="text" placeholder="Objet">
                            </div>
                        </div>

                        <!-- MESSAGE -->
                        <textarea placeholder="Votre message..."></textarea>

                        <!-- BOUTON -->
                        <div class="text-center">
                            <button type="submit" class="btn-send">Envoyer</button>
                        </div>

                    </form>
                </div>
            </div>
         </div>
    </div>
   <!-- Foot Note End -->
</footer>

<style>

    body {
    overflow-x: hidden; /* Empêche le scroll horizontal dû au 100vw */
}

.footer-widgets .container {
    max-width: 1140px !important; /* Redonne une largeur propre au contenu */
    margin: 0 auto;
}

        .footer-widgets {
            background: #19173a;
            color: #fff;
            padding: 60px 0;
        }
        

        .map-footer iframe {
            border-radius: 8px;
            margin-top: 10px;
        }


        /* Icône à côté du titre */
        .icon-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .icon-title i {
            font-size: 22px;
            color: #f09309;
        }

        .icon-title h3 {
            font-size: 18px;
            margin: 0;
            
        }

        /* Social icons */
        .social-nav {
            display: flex;
            gap: 15px;
            list-style: none;
            padding: 0;
        }

        .social-nav li a {
            width: 38px;
            height: 38px;
            background: #444;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: 0.3s;
        }

        .social-nav li a:hover {
            background: #f38f0c;
        }

        /* FORMULAIRE */
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            background: #333;
            color: #fff;
            border-radius: 4px;
        }

        .contact-form textarea {
            min-height: 120px;
        }

        /* Bouton pas trop grand */
        .btn-send {
            background: #118106;
            color: #fff;
            padding: 10px 35px;
            border: none;
            border-radius: 4px;
            font-size: 15px;
        }

        .btn-send:hover {
            background: #118106;
        }


        /* Supprimer les barres / contours au clic */
        .social-nav li a:focus,
        .social-nav li a:active {
            outline: none;
            box-shadow: none;
        }

                .contact-line {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .contact-line i {
            color: #fda50d;
            font-size: 16px;
            min-width: 20px;
        }


        .dernière_partie{
            display:flex;
            flex-direction:row;
            flex-wrap: wrap;
            justify-content:space-between;
        }

        /* ===============================
        CORRECTION LARGEUR RUBRIQUES
        ================================ */

        .actualite-bar {
            position: relative;
            left: 50%;
            right: 50%;
            width: 100vw;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        /* ===============================
        CORRECTION FOOTER PLEINE LARGEUR
        ================================ */

        footer {
            position: relative;
            left: 50%;
            right: 50%;
            width: 100vw;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        footer .container {
            max-width: none !important;
        }



        /* --- Gestion du Responsive (Mobile & Tablettes) --- */
        @media (max-width: 768px) {
            .dernière_partie {
                flex-direction: column; /* Empilement vertical */
                text-align: center; /* Centrage du texte pour une meilleure esthétique mobile */
            }

            .icon-title {
                justify-content: center; /* Centre les titres et icônes */
            }

            .social-nav {
                justify-content: center; /* Centre les icônes sociales */
                margin-bottom: 20px;
            }

            .contact-line {
                justify-content: center;
            }

            /* Éviter que le footer ne déborde horizontalement */
            footer, .copyright-bar, .actualite-bar {
                width: 100%;
                left: 0;
                right: 0;
                margin-left: 0;
                margin-right: 0;
                padding:3;
            }
        }

</style>


<div class="container">
    <div class="copyright-bar">
        © 2026 Copyright DGAMP | Tous droits réservés. 
        <span>Designed by <strong>GROUPE KOMPTECH CIMAT</strong></span>
    </div>
</div>
<style>
       /* COPYRIGHT BAR PLEINE LARGEUR */
        .copyright-bar {
            position: relative;
            left: 50%;
            right: 50%;
            width: 100vw;
            margin-left: -50vw;
            margin-right: -50vw;
            text-align: center;
            background: #4f85d6;
            color: #fff;
            font-size: 14px;
            z-index: 999;
        }


        .copyright-bar span {
            color: #222236;
        }

        
</style>

    <script src="assets/js/jquery-3.3.1.js"></script>
    <!--Plugins-->
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/loaders.css.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/lightgallery-all.min.js"></script>
    <!--Template Script-->
    <script src="assets/js/main.js"></script>