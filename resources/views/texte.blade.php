<section class="slider">
  <div class="slides">

    <div class="slide">
      <img src="assets/images/image1.jpeg" alt="Image 1">
      <div class="slide-text">
        <h2>
            Bienvenue sur le site de la <br>
            Direction Generale des Affaires Maritimes et Portuaires
        </h2>
      </div>
    </div>
    
    <div class="slide">
      <img src="assets/images/image2.jpeg" alt="Image 2">
      <div class="slide-text">
         <h2>
            Bienvenue sur le site de la <br>
            Direction Generale des Affaires Maritimes et Portuaires
        </h2>
      </div>
    </div>

    <div class="slide">
      <img src="assets/images/image3.jpeg" alt="Image 3">
      <div class="slide-text">
         <h2>
            Bienvenue sur le site de la <br>
            Direction Generale des Affaires Maritimes et Portuaires
        </h2>
      </div>
    </div>

    <div class="slide">
      <img src="assets/images/image4.jpeg" alt="Image 4">
      <div class="slide-text">
        <h2>
            Bienvenue sur le site de la <br>
            Direction Generale des Affaires Maritimes et Portuaires
        </h2>
      </div>
    </div>

    <div class="slide">
      <img src="assets/images/image5.jpeg" alt="Image 5">
      <div class="slide-text">
         <h2>
            Bienvenue sur le site de la <br>
            Direction Generale des Affaires Maritimes et Portuaires
        </h2>
      </div>
    </div>

    <div class="slide">
      <img src="assets/images/image6.jpeg" alt="Image 6">
      <div class="slide-text">
         <h2>
            Bienvenue sur le site de la <br>
            Direction Generale des Affaires Maritimes et Portuaires
        </h2>
      </div>
    </div>

    <div class="slide">
        <img src="assets/images/image1.jpeg" alt="Image 1">
        <div class="slide-text"></h2>
            <h2>
                Bienvenue sur le site de la <br>
                Direction Generale des Affaires Maritimes et Portuaires
            </h2>
            
        </div>
    </div>

 </div>

 <!-- Boutons de navigation -->
<div class="nav-btn prev">&#10094;</div>
<div class="nav-btn next">&#10095;</div>
 

</section>
    
<style>

    .slider {
    width: 100%;
    height: 450px;           /* Hauteur du header */
    overflow: hidden;
    position: relative;
    }

    .slides {
    display: flex;
    transition: transform 2s ease-in-out; /* Défilement fluide */
    }

    .slide {
    min-width: 100%;
    height: 100%;
    position: relative;
    }

    .slide img {
    width: 100%; 
    height: 100%;
    object-fit: cover;      /* Remplit sans déformer */
    filter: brightness(0.7); /* Image légèrement assombrie pour lisibilité du texte */
    display: block;
    }

    /* Texte sur chaque image */
    .slide-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -120%);
    text-align: center;
    color: #fff;
    
    }

    .slide-text h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    }

    .slide-text p {
    font-size: 1.2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
    .slider {
        height: 300px;
    }
    }

    .nav-btn:hover {
        background: rgba(0,0,0,0.6);
    }

    .nav-btn.prev { 
        left: 20px; 
    }

    .nav-btn.next { 
        right: 20px; 
        }

</style> 
<script>
    const slides = document.querySelector('.slides');
    const slideItems = document.querySelectorAll('.slide');
    const slideCount = slideItems.length;
    let currentIndex = 0;

    function nextSlide() {
        currentIndex++;
        slides.style.transition = 'transform 1s ease-in-out';
        slides.style.transform = `translateX(-${currentIndex * 100}%)`;

        // Quand on arrive sur la fausse dernière slide
        if (currentIndex === slideCount - 1) {
            setTimeout(() => {
                slides.style.transition = 'none';
                currentIndex = 0;
                slides.style.transform = 'translateX(0)';
            }, 2000); // même durée que la transition
        }
    }

    setInterval(nextSlide, 8000);

</script>

 <script>
    const slides = document.querySelectorAll('.slide');
    const next = document.querySelector('.next');
    const prev = document.querySelector('.prev');
    let index = 0;

    function showSlide(i) {
    slides.forEach(slide => slide.classList.remove('active'));
    slides[i].classList.add('active');
    }

    next.addEventListener('click', () => {
    index = (index + 1) % slides.length;
    showSlide(index);
    });

    prev.addEventListener('click', () => {
    index = (index - 1 + slides.length) % slides.length;
    showSlide(index);
    });

    // Auto défilement toutes les 6 secondes
    setInterval(() => {
    index = (index + 1) % slides.length;
    showSlide(index);
    }, 6000);
</script>




<ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#">accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Nos activités</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Service en ligne</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Region et arrondissement</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Personnel</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Operateur agrées</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Partenaire</a></li>
                    </ul>




                    <script>
  document.querySelectorAll('.dropdown').forEach(item => {
    item.addEventListener('mouseenter', () => {
      item.querySelector('.dropdown-menu').style.display = 'block';
    });

    item.addEventListener('mouseleave', () => {
      item.querySelector('.dropdown-menu').style.display = 'none';
    });
  });
</script>




 <style> 
    .navbar-nav {
        list-style: none;
        display: flex;
        gap: 25px;
    }

    .nav-link {
        text-decoration: none;
        color: #000;
        font-weight: 600;
        padding: 10px;
    }

    .dropdown,
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-menu,
    .submenu {
    position: absolute;
    top: 100%;
    left: 0;
    background: #fff;
    min-width: 200px;
    display: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    border-radius: 5px;
    }

    .dropdown-submenu > .submenu {
    top: 0;
    left: 100%;
    }

    .dropdown:hover > .dropdown-menu,
    .dropdown-submenu:hover > .submenu {
    display: block;
    }

    .dropdown-menu li,
    .submenu li {
    list-style: none;
    }

    .dropdown-menu a,
    .submenu a {
    padding: 10px 15px;
    display: block;
    color: #333;
    white-space: nowrap;
    }

    .dropdown-menu a:hover,
    .submenu a:hover {
    background: #f1f1f1;
    text-decoration:none
    

    }


 </style>




<div class="media">
                                <i class="fa fa-fax"></i>
                                <div class="media-body ml-3">
                                    <h3>SUIVEZ-NOUS SUR</h3>
                            <ul 
                                    class="nav social-nav">
                                <li><a href="https://www.facebook.com/dgampci/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                                </div>


<style>
                                 
.social-nav {
  display: flex;
  gap: 18px;                 /* ⬅️ ESPACEMENT ENTRE ICÔNES */
  align-items: center;
  padding: 0;
  margin: 0;
  list-style: none;
}

.social-nav li a {
  width: 42px;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;        /* icône ronde */
  background: #f1f1f1;
  color: #333;
  font-size: 18px;
  transition: all 0.3s ease;
  text-decoration: none;
}

/* Effet hover */
.social-nav li a:hover {
  background: #0d6efd;
  color: #fff;
  transform: translateY(-3px);
}

.social-nav .fa-facebook { color: #1877f2; }
.social-nav .fa-twitter { color: #1da1f2; }
.social-nav .fa-linkedin { color: #0077b5; }
.social-nav .fa-youtube { color: #db4437; }



.tags-widget {
  margin: -10px -10px 0 0;
}

.tags-widget a {
  color: #aaa;
  display: inline-block;
  padding: 10px 12px;
  border-radius: 2px;
  background-color: #363636;
  font-size: 14px;
  font-family: "Rajdhani", sans-serif;
  font-weight: 700;
  margin: 10px 10px 0 0;
}

.tags-widget a:hover {
  text-decoration: none;
  color: #26264b;
  background-color: #df7e0e;
}



body[data-aos-delay='800'] [data-aos].aos-animate, [data-aos][data-aos][data-aos-delay='800'].aos-animate {
  transition-delay: 800ms;
}
</style>

<div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget contact-widget" data-aos="fade-up" data-aos-delay="0">
                           
                            <div class="media">
                                
                                <i class="fa fa-map-marker"></i>
                                <div class="media-body ml-3">
                                    <h3>LOCALISATION</h3>
                                        
                                     <P> Abidjan, Deux Plateaux Aghien </P>

                                     <hr class="separator">

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget contact-widget" data-aos="fade-up" data-aos-delay="0">
                            
                            <div class="media">
                                <i class="fa fa-fax"></i>
                                <div class="media-body ml-3">
                                    <h3>SUIVEZ-NOUS SUR</h3>
                                    <ul 
                                            class="nav social-nav">
                                        <li><a href="https://www.facebook.com/dgampci/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget twitter-widget" data-aos="fade-up" data-aos-delay="200">
                            <h3>CONTACTS</h3>
                            <div class="media">
                               <i class="fa fa-phone"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="#"> (+225) 27 22 40 80 35</a></h6>
                                    
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-envelope-o"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="#"> info@dgamp.ci,</a></h6>
                                    
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-globe"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="https://www.dgamp.ci" target="_blank">www.dgamp.ci</a></h6>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        
                        <div class="single-widget recent-post-widget" data-aos="fade-up" data-aos-delay="400">
                            <h3>CONTACTEZ NOUS</h3>
                                    <section class="contact-section">

                                            <form class="contact-form">
                                                <input type="text" placeholder="Entrez votre nom">
                                                <input type="email" placeholder="Entrez votre Email">
                                                <input type="text" placeholder="Objet">
                                                <textarea placeholder="Laissez nous un message..."></textarea>

                                                <button type="submit">Envoyer</button>
                                            </form>
                                    </section>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

 <style>
    .separator {
            border: none;
            height: 3px;
            width: 80px;
           

            margin-top: 30px;     
            /* espace au-dessus */
            
            margin-bottom: 60px; 
             
            /* ⬇️ FAIT DESCENDRE PLUS */
    }
  

    .social-nav {
        display: flex;
        gap: 18px;                 /* ⬅️ ESPACEMENT ENTRE ICÔNES */
        align-items: center;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .social-nav li a {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;        /* icône ronde */
        background: #f1f1f1;
        color: #333;
        font-size: 18px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    /* Effet hover */
    .social-nav li a:hover {
        background: #0d6efd;
        color: #fff;
        transform: translateY(-3px);
    }

    .social-nav .fa-facebook { color: #1877f2; }
    .social-nav .fa-twitter { color: #1da1f2; }
    .social-nav .fa-linkedin { color: #0077b5; }
    .social-nav .fa-google-plus { color: #db4437; }


</style>

<style>
        .contact-section {
        width: 100%;
        max-width: 400px;
        padding: px;
        font-family: Arial, sans-serif;
        }

        .contact-section h2 {
        color: #2da3df;
        font-size: 32px;
        margin-bottom: 25px;
        }

        .contact-form input,
        .contact-form textarea {
        width: 100%;
        background: #3b3b3b;
        border: none;
        padding: 15px;
        margin-bottom: 15px;
        color: #fff;
        font-size: 16px;
        border-radius: 4px;
        }

        .contact-form textarea {
        height: 120px;
        resize: vertical;
        }

        /* Placeholder */
        .contact-form input::placeholder,
        .contact-form textarea::placeholder {
        color: #bfbfbf;
        }

        /* Focus */
        .contact-form input:focus,
        .contact-form textarea:focus {
        outline: none;
        background: #2f2f2f;
        }

        /* Bouton */
        .contact-form button {
        background: #0f8c1e;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        width: 100%;
        }

        .contact-form button:hover {
        background: #df7117;
        }

</style>       

        <!-- Widgets End -->
        <!-- Foot Note Start -->
        <div class="foot-note">
            <div class="container">
                <div
                    class="footer-content text-center text-lg-left d-lg-flex justify-content-between align-items-center">
                    <p class="mb-0" data-aos="fade-right" data-aos-offset="0">&copy;  2026 Copyright DGAMP | Tous droits réservés. Designed by GROUPE KOMPTECH </p>
                   
                </div>
        
            </div>
        </div>   




        <div class="footer-widgets">
    <div class="container">

        <!-- LIGNE 1 : 3 COLONNES -->
        <div class="row text-center text-md-left">

            <!-- LOCALISATION -->
       <div class="col-md-4 mb-4">
            <div class="single-widget">
                      <i class="fa fa-map-marker fa-2x mb-2"></i>
                        <h1>LOCALISATION</h1>
                        <p>Abidjan, Deux Plateaux Aghien</p>   
            </div>
      </div>


            <!-- CONTACTS -->
            <div class="col-md-4 mb-4">
                <div class="single-widget">
                    <i class="fa fa-phone fa-2x mb-2"></i>
                    <h1>CONTACTS</h1>
                    <p>(+225) 27 22 40 80 35</p>
                    <p>info@dgamp.ci</p>
                    <p>www.dgamp.ci</p>
                </div>
            </div>

            <!-- SUIVEZ NOUS -->
            <div class="col-md-4 mb-4">
                <div class="single-widget">
                    <i class="fa fa-share-alt fa-2x mb-2"></i>
                    <h1>SUIVEZ-NOUS</h1>

                    <ul class="nav social-nav justify-content-center justify-content-md-start">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>

        <hr>

        <!-- LIGNE 2 : CONTACTEZ NOUS (PLEINE LARGEUR) -->
        <div class="row">
            <div class="col-12">
                <div class="single-widget">
                    <h1 class="text-center mb-4">CONTACTEZ-NOUS</h1>

                    <form class="contact-form">
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

                        <textarea placeholder="Votre message..."></textarea>
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<style>

.footer-widgets {
        background: #222;
        color: #fff;
        padding: 60px 0;
    }

    .single-widget h3 {
        margin-bottom: 15px;
        font-size: 18px;
        font-weight: bold;
    }

    .single-widget p {
        margin: 5px 0;
    }

    .social-nav {
        display: flex;
        gap: 15px;
        padding: 0;
        list-style: none;
    }

    .social-nav li a {
        width: 40px;
        height: 40px;
        background: #444;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: 0.3s;
    }

    .social-nav li a:hover {
        background: #0d6efd;
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
    }

    .contact-form button {
        width: 100%;
        padding: 12px;
        border: none;
        background: #0f8c1e;
        color: #fff;
        font-size: 16px;
    }

    .contact-form button:hover {
        background: #df7117;
    }
</style>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
     <!-- TEXTE À DROITE -->
            <div class="col-md-7">
                <div class="title">
                    <h1 class="title-blue">Mot du Directeur Général</h1>
                </div>

                <p>
                    La nécessité pour notre administration de posséder un site internet fonctionnel et régulièrement actualisé,
                     qui s’est imposée à nous depuis plusieurs années vient de trouver satisfaction avec la création de ce site.
                    En effet, important outil de communication, ce site permet à la Direction Générale des Affaires Maritimes
                    et portuaire (DGAMP) de mieux se faire connaitre par ses partenaires et usagers...  
                    Longtemps nous avons œuvré presque dans l’anonymat.
                     Notre ardeur au travail pour le développement de l’Administration maritime est restée sous l’éteignoir.
                    Notre notoriété en souffre depuis la création de notre direction générale. Trop souvent, 
                    la confusion est faite entre les principaux acteurs de l’Etat en mer. 
                    Or, nous sommes, comme le prévoit la loi n° 2017-442 du 30 juin 2017 portant Code maritime, 
                    l’Administration en charge de la gestion administrative de tout ce qui concerne la mer, 
                    les lagunes, les lacs et les fleuves en Côte d’Ivoire. 
                    En d’autres termes nous avons la conduite de la politique des transports maritimes, 
                    fluvio-lagunaires, du domaine public maritime et lagunaire, de la sécurité et la sûreté maritimes et portuaires,
                    de la coopération maritime, ainsi que de l’administration des gens de mer et des œuvres sociales des marins. 
                    Le présent site nous sert de vitrine pour présenter nos activités, nos missions et notre organisation. 
                    Par ailleurs, il vous permet, à vous, acteurs étatiques du secteur maritime et portuaires, Partenaires et Opérateurs économiques,
                     membres de la Communauté portuaire, usagers des services maritimes et autres, de vous informer sur le quotidien de la DGAMP.
                    Ce site lève ainsi le voile sur nous et notre visibilité en sera agrandie à travers la possibilité qu’il offre à échanger avec vous.
                    Notre crédibilité s’exprimera à travers ce site via l’internet.
                    En effet, un site internet a l’avantage de nous faire connaitre puisqu’il donne une accessibilité tout le temps à tous ceux qui cherchent à en savoir sur nous.
                     Et cela en toute liberté, en tout lieu. Aussi, le site est-il développé pour permettre aux usagers de soumettre désormais leurs demandes de visa,
                    de visites techniques, d’immatriculation ou d’agrément en ligne. En effet, une fois que le dossier est constitué,
                    vous pouvez nous envoyer la version électronique via une plateforme dédiée. Le souci est de gagner en temps et en efficacité.
                     Le site contient enfin des publications de la documentation sur les affaires maritimes (textes, vidéos, photos).
                    Aujourd’hui, le site présente un atout pour nous faire connaitre en tout lieu à travers le monde.

                    </p>
                    <p class="font-italic">
                        Nous vous souhaitons un bon vent et une excellente navigation.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Mot du Directeur Général End -->


<style>

        /* SECTION */
        .featured {
            padding: 60px 0;
        }

        /* IMAGE FIXE */
        .featured-img {
            position: sticky;
            top:60px; /* ajuste si tu as un header */
            text-align: center;
        }

        /* TEXTE CACHÉ */
        .dg-more-text {
            display: none;
            margin-top: 15px;
        }

       
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mot du Directeur Général</title>

<style>

/* IMAGE ARRIÈRE-PLAN PAGE */
body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background: url("assets/images/image7.jpeg") no-repeat center center fixed;
    background-size: cover;
}

/* BARRE FIXE TITRE */
.title {
    position: fixed;          /* reste toujours en haut */
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px;
    background: orange;
    color: white;
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    z-index: 1000;            /* pour rester au-dessus */
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

/* MARGE POUR LE BLOC SOUS TITRE FIXE */
body {
    padding-top: 80px;        /* laisse de l’espace sous la barre fixe */
}

/* BLOC BLANC EN FLEX */
.card {
    background: white;
    max-width: 900px;
    margin: 30px auto 60px;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);

    display: flex;            /* flex pour mettre photo à gauche et texte à droite */
    flex-direction: row;
    align-items: flex-start;  /* aligne en haut */
    gap: 30px;                /* espace entre photo et texte */
    flex-wrap: wrap;           /* pour mobile */
}

/* PHOTO DG */
.dg-img {
    width: 220px;
    border-radius: 8px;
    flex-shrink: 0;           /* empêche la photo de rétrécir */
}

/* TEXTE */
.text {
    font-size: 15px;
    line-height: 1.8;
    color: #2e2b2b;
    text-align: justify;
    flex: 1;                  /* prend tout l’espace restant */
}

/* TEXTE SIGNATURE EN BAS */
.signature {
    text-align: right;
    margin-top: 20px;
    font-size: 15px;
    line-height: 1.5;
}

/* RESPONSIVE */
@media(max-width:768px){
    .card {
        flex-direction: column;
        padding: 25px;
    }
    .dg-img {
        width: 180px;
        margin: auto;
        margin-bottom: 20px;
    }
    .text {
        text-align: justify;
    }
}

</style>
</head>

<body>

<h1 class="title">Mot du Directeur Général</h1>

<div class="card">

    <img src="assets/images/image8.jpeg" alt="DG" class="dg-img">

    <div>
        <h4 style="text-align:left;">Colonel KOUASSI Yao Julien</h4>
        <p class="text">
             <p>
                    La nécessité pour notre administration de posséder un site internet fonctionnel et régulièrement actualisé,
                     qui s’est imposée à nous depuis plusieurs années vient de trouver satisfaction avec la création de ce site.
                    En effet, important outil de communication, ce site permet à la Direction Générale des Affaires Maritimes
                    et portuaire (DGAMP) de mieux se faire connaitre par ses partenaires et usagers...  
                    Longtemps nous avons œuvré presque dans l’anonymat.
                     Notre ardeur au travail pour le développement de l’Administration maritime est restée sous l’éteignoir.
                    Notre notoriété en souffre depuis la création de notre direction générale. Trop souvent, 
                    la confusion est faite entre les principaux acteurs de l’Etat en mer. 
                    Or, nous sommes, comme le prévoit la loi n° 2017-442 du 30 juin 2017 portant Code maritime, 
                    l’Administration en charge de la gestion administrative de tout ce qui concerne la mer, 
                    les lagunes, les lacs et les fleuves en Côte d’Ivoire. 
                    En d’autres termes nous avons la conduite de la politique des transports maritimes, 
                    fluvio-lagunaires, du domaine public maritime et lagunaire, de la sécurité et la sûreté maritimes et portuaires,
                    de la coopération maritime, ainsi que de l’administration des gens de mer et des œuvres sociales des marins. 
                    Le présent site nous sert de vitrine pour présenter nos activités, nos missions et notre organisation. 
                    Par ailleurs, il vous permet, à vous, acteurs étatiques du secteur maritime et portuaires, Partenaires et Opérateurs économiques,
                     membres de la Communauté portuaire, usagers des services maritimes et autres, de vous informer sur le quotidien de la DGAMP.
                    Ce site lève ainsi le voile sur nous et notre visibilité en sera agrandie à travers la possibilité qu’il offre à échanger avec vous.
                    Notre crédibilité s’exprimera à travers ce site via l’internet.
                    En effet, un site internet a l’avantage de nous faire connaitre puisqu’il donne une accessibilité tout le temps à tous ceux qui cherchent à en savoir sur nous.
                     Et cela en toute liberté, en tout lieu. Aussi, le site est-il développé pour permettre aux usagers de soumettre désormais leurs demandes de visa,
                    de visites techniques, d’immatriculation ou d’agrément en ligne. En effet, une fois que le dossier est constitué,
                    vous pouvez nous envoyer la version électronique via une plateforme dédiée. Le souci est de gagner en temps et en efficacité.
                     Le site contient enfin des publications de la documentation sur les affaires maritimes (textes, vidéos, photos).
                    Aujourd’hui, le site présente un atout pour nous faire connaitre en tout lieu à travers le monde.

                    </p>
            <!-- ton texte complet ici -->
        </p>

        <p class="signature">

            Colonel Kouassi Yao Julien <br>
            Administrateur en chef des Affaires Maritimes <br>
            Directeur Général par Intérim
        </p>
    </div>

</div>

</body>
</html>


 .copyright-bar {
        bottom: 0;
        left: 0;
        width: 100%;
        background: #4f85d6;
        color: #fff;
        text-align: center;
        padding: 12px 10px;
        font-size: 14px;
        z-index: 999;
    }
    


                            <div class="map-footer">
                                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.227642840733!2d-4.000955126503041!3d5.38222743537576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1954b63b533a7%3A0x4df51f6b1a72359e!2sDgamp!5e0!3m2!1sen!2sci!4v1772038225999!5m2!1sen!2sci" 
                                   width="100%" 
                                   height="200" 
                                   style="border:0;" 
                                   allowfullscreen="" 
                                   loading="lazy"> 
                                   </iframe>
                            </div>



                            <tbody id="docBody">
                    <tr class="doc-row" data-title="uemoa reglement">
                        <td><strong>Règlement n° 003/2019/COM/UEMOA</strong></td>
                        <td>Conditions d'accès aux professions maritimes...</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right"><a href="assets/images/PDF11.pdf" class="btn-download"  target="_blank">📥 Télécharger</a></td>
                    </tr>
                    <tr class="doc-row" data-title="marpol pollution">
                        <td><strong>MARPOL 78 (Convention internationale de 1973 pour la prévention de la pollution par les navires)</strong></td>
                        <td>Conclu à Londres le 17 févri....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right"><a href="assets/images/PDF12.pdf" class="btn-download">📥 Télécharger</a></td>
                    </tr>

                    <tr class="doc-row" data-title="marpol pollution">
                        <td><strong>convention STCW</strong></td>
                        <td>convention STCW...</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right"><a href="assets/images/PDF13.pdf" class="btn-download">📥 Télécharger</a></td>
                    </tr>

                    <tr class="doc-row" data-title="marpol pollution">
                        <td><strong>CONVENTION DU TRAVAIL MARITIME</strong></td>
                        <td>Un instrument unique et cohér....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right"><a href="assets/images/PDF14.pdf" class="btn-download">📥 Télécharger</a></td>
                    </tr>

                    <tr class="doc-row" data-title="marpol pollution">
                        <td><strong>Convention des Nations Unies sur le Droit de la Mer</strong></td>
                        <td>Conclue à New York le 10 déc.....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right"><a href="assets/images/PDF15.pdf#" class="btn-download">📥 Télécharger</a></td>
                    </tr>

                    <tr class="doc-row" data-title="marpol pollution">
                        <td><strong>Convention 1</strong></td>
                        <td>Convention 1.</td>
                        <td><span class="">PDF</span></td>
                        <td class="text-right"><a href="assets/images/PDF16.pdf" class="btn-download">📥 Télécharger</a></td>
                    </tr>



                    


                    <!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Affaires Maritimes Ivoiriennes</title>
    <link rel="icon" href="assets/images/logo_Dgamp.jpeg" type="image/jp">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i%7CRajdhani:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">
    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

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
                                                        <li><a href="{{ route('arrêtédedecision') }}">Arrêtés et Décisions</a></li>
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
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Nos Activités</a>
                            <ul class="dropdown-menu-custom">
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
                                <li><a href="{{ route('agrémentvisa') }}">Agrément et Visa</a></li>
                                <li><a href="{{ route('immatriculationnavire') }}">Immatriculation des navires</a></li>
                                <li><a href="{{ route('visitetechnique') }}">Visite technique</a></li>
                                <li><a href="{{ route('permisconduire') }}">Permis de conduire</a></li>
                                <li><a href="{{ route('titresmaritimes') }}">Titres Maritimes</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Régions et Arrondissements</a>
                            <ul class="dropdown-menu-custom">
                                <li><a href="{{ route('arrondissementadiaké') }}">Arrondissement d'adiaké</a></li>
                                <li><a href="{{ route('arrondissementsanpedro') }}">Arrondissement de San-Pedro</a></li>
                                <li><a href="{{ route('arrondissementgrandbassam') }}">Arrondissement de Grand-Bassam</a></li>
                                <li><a href="{{ route('arrondissementtabou') }}">Arrondissement de Tabou</a></li>
                                <li><a href="{{ route('arrondissementabidjan') }}">Arrondissement d'Abidjan</a></li>
                                <li><a href="{{ route('arrondissementjacqueville') }}">Arrondissement de Jacqueville</a></li>
                                <li><a href="{{ route('arrondissementsassandra') }}">Arrondissement de Sassandra</a></li>
                                <li><a href="{{ route('arrondissementgrandlahou') }}">Arrondissement de Grand Lahou</a></li>
                                <li><a href="{{ route('arrondissementbingerville') }}">Arrondissement de Bingerville</a></li>
                                <li><a href="{{ route('arrondissementfresco') }}">Arrondissement de Fresco</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Personnel</a>
                            <ul class="dropdown-menu-custom">
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Type de personnel</a>
                                    <ul class="submenu-custom">
                                        <li><a href="#">Personnel Militaire</a></li>
                                        <li><a href="#">Personnel Interministériel</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-container">
                                    <a href="#" class="has-arrow">Vie Associative</a>
                                    <ul class="submenu-custom">
                                        <li><a href="#">Fonds de Prévoyance</a></li>
                                        <li><a href="#">Vie Sociale</a></li>
                                        <li><a href="#">Autres Associations</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item"><a href="#" class="nav-link">Opérateurs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Partenaires</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="flash-info-container">
        <span class="flash-label"><i class="fa fa-bolt"></i> FLASH INFOS</span>
        <div class="flash-marquee">
            <div class="flash-track">
                <div class="flash-content">| Les concours DGAMP/DGAM sont gérés par la Fonction Publique. Aucun concours de Police Maritime en 2024.</div>
                <div class="flash-content">| La DGAMP devient la DGAM (Décret 2024-274 du 08 mai 2024). Visitez notre nouveau portail pour plus d'infos.</div>
                <div class="flash-content">| Les concours DGAMP/DGAM sont gérés par la Fonction Publique. Aucun concours de Police Maritime en 2024.</div>
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
        /* CORRECTIF : permet aux dropdowns de déborder hors du header sticky */
        overflow: visible !important;
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
        flex-wrap: wrap;
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

    .social-links a {
        font-size: 16px;
    }

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

    @media (max-width: 400px) {
        .contact-links a { font-size: 12px; }
        .social-links a { font-size: 14px; }
    }

    /* Navbar Section */
    /* CORRECTIF : overflow visible pour que les dropdowns ne soient pas coupés */
    .navbar-section {
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        overflow: visible !important;
    }

    .navbar {
        padding: 0;
        overflow: visible !important;
    }

    .navbar-brand img { height: 65px; padding: 5px 0; }

    /* CORRECTIF : overflow visible sur navbar-nav et navbar-collapse */
    .navbar-nav,
    .navbar-collapse {
        overflow: visible !important;
    }

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
        min-width: 230px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: all 0.3s ease;
        list-style: none;
        padding: 5px 0;
        border-top: 4px solid #1b7015;
        /* CORRECTIF : z-index élevé pour passer au-dessus du contenu de la page */
        z-index: 9999 !important;
        /* CORRECTIF : scroll interne si le menu dépasse la hauteur de l'écran */
        max-height: 80vh;
        overflow-y: auto;
        overflow-x: visible;
        /* Scrollbar discrète */
        scrollbar-width: thin;
        scrollbar-color: #1b7015 #f1f1f1;
    }

    /* Scrollbar Webkit (Chrome, Safari) */
    .dropdown-menu-custom::-webkit-scrollbar {
        width: 4px;
    }
    .dropdown-menu-custom::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .dropdown-menu-custom::-webkit-scrollbar-thumb {
        background: #1b7015;
        border-radius: 4px;
    }

    /* CORRECTIF : les derniers items de la navbar ouvrent leur dropdown vers la gauche */
    .navbar-nav .nav-item:last-child .dropdown-menu-custom,
    .navbar-nav .nav-item:nth-last-child(2) .dropdown-menu-custom,
    .navbar-nav .nav-item:nth-last-child(3) .dropdown-menu-custom {
        left: auto;
        right: 0;
    }

    /* Sous-menus (Niveaux 2 et 3) */
    .submenu-custom {
        position: absolute;
        top: 0;
        left: 100%;
        background: #fff;
        min-width: 200px;
        box-shadow: 5px 5px 20px rgba(0,0,0,0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateX(15px);
        transition: all 0.3s ease;
        list-style: none;
        padding: 10px 0;
        border-left: 2px solid #156916;
        /* CORRECTIF : z-index encore plus élevé pour les sous-menus */
        z-index: 10000 !important;
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
        .navbar-collapse {
            background: #fff;
            max-height: 80vh;
            overflow-y: auto !important;
        }
        .submenu-custom {
            position: static;
            visibility: visible;
            opacity: 1;
            transform: none;
            display: none;
            box-shadow: none;
            padding-left: 20px;
            max-height: none;
            overflow-y: visible;
        }
        .dropdown-item-container:hover .submenu-custom,
        .dropdown-item-container.active .submenu-custom { display: block; }

        /* Sur mobile le dropdown s'affiche inline (pas de position absolute) */
        .dropdown-menu-custom {
            position: static;
            visibility: visible;
            opacity: 1;
            transform: none;
            display: none;
            box-shadow: none;
            max-height: none;
            overflow-y: visible;
            border-top: none;
            border-left: 3px solid #1b7015;
            padding-left: 10px;
        }
        .nav-item.active .dropdown-menu-custom { display: block; }
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
    <div class="footer-widgets">
        <div class="container">
            <div class="row dernière_partie">
                <!-- LOCALISATION -->
                <div class="col-md-4 mb-4">
                    <div class="footer-item">
                        <div class="icon-title">
                            <i class="fa fa-map-marker"></i>
                            <h4>LOCALISATION</h4>
                        </div>
                        <p>Vous pouvez nous retrouver ici :</p>
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

            <!-- CONTACTEZ NOUS -->
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center mb-4">CONTACTEZ-NOUS</h3>
                    <form class="contact-form">
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
                        <textarea placeholder="Votre message..."></textarea>
                        <div class="text-center">
                            <button type="submit" class="btn-send">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    body {
        overflow-x: hidden;
    }

    .footer-widgets .container {
        max-width: 1140px !important;
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

    .social-nav li a:hover { background: #f38f0c; }

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

    .contact-form textarea { min-height: 120px; }

    .btn-send {
        background: #118106;
        color: #fff;
        padding: 10px 35px;
        border: none;
        border-radius: 4px;
        font-size: 15px;
    }
    .btn-send:hover { background: #118106; }

    .social-nav li a:focus,
    .social-nav li a:active { outline: none; box-shadow: none; }

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

    .dernière_partie {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .actualite-bar {
        position: relative;
        left: 50%;
        right: 50%;
        width: 100vw;
        margin-left: -50vw;
        margin-right: -50vw;
    }

    footer {
        position: relative;
        left: 50%;
        right: 50%;
        width: 100vw;
        margin-left: -50vw;
        margin-right: -50vw;
    }

    footer .container { max-width: none !important; }

    @media (max-width: 768px) {
        .dernière_partie {
            flex-direction: column;
            text-align: center;
        }
        .icon-title { justify-content: center; }
        .social-nav { justify-content: center; margin-bottom: 20px; }
        .contact-line { justify-content: center; }
        footer, .copyright-bar, .actualite-bar {
            width: 100%;
            left: 0;
            right: 0;
            margin-left: 0;
            margin-right: 0;
            padding: 3px;
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
        padding: 10px 0;
    }

    .copyright-bar span { color: #222236; }
</style>

<script src="assets/js/jquery-3.3.1.js"></script>
<script src="assets/js/bootstrap.bundle.js"></script>
<script src="assets/js/loaders.css.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/swiper.min.js"></script>
<script src="assets/js/lightgallery-all.min.js"></script>
<script src="assets/js/main.js"></script>