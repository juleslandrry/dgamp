@extends('template')
@section('layout')

<!DOCTYPE html>
<html lang="fr">
        <head>
                <meta charset="UTF-8">

                <style>

                    /* HEADER IMAGE */
                    .hero{
                        height:300px;
                        background:url("assets/images/image34.jpeg") center/cover no-repeat;
                        position:relative;
                        overflow:hidden;
                    }


                    /* OVERLAY */
                    .hero::before{
                    content:"";    
                    position:absolute;
                    inset:0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.45);
                    z-index:1;
                    }
            
                    .hero h3{
                        position:relative;
                        color:#fff;
                        font-size:36px;
                        font-weight:bold;
                        letter-spacing:2px;
                        z-index:2;
                        text-align:center;
                        margin-top:100px;
                    }

                    /* SECTION */
                    .section{
                        background:#f5f5f5;
                        padding:50px 15px;
                    }

                    /* CARD */
                    .card{
                        max-width:1000px;
                        margin:auto;
                        background:#fff;
                        padding:40px;
                        border-radius:12px;
                        box-shadow:0 8px 25px rgba(0,0,0,0.15);
                    }

                    /* IMAGE DG */
                    .dg-img{
                        float:left;
                        width:230px;
                        margin-right:25px;
                        border-radius:10px;
                    }

                    /* TEXTE */
                    .text{
                        text-align:justify;
                        line-height:1.8;
                        font-size:16px;
                    }

                    /* SIGNATURE */
                    .signature{
                        clear:both;
                        text-align:right;
                        margin-top:30px;
                        font-weight:bold;
                    }

                    /* RESPONSIVE */
                    @media(max-width:768px){
                        .dg-img{
                            float:none;
                            display:block;
                            margin:0 auto 20px;
                        }
                    }

                    .gallery-modern .gallery-item.large {
                        grid-row: auto !important;
                    }

                </style>
        </head>

        <body>

            <!-- HEADER -->
                <div class="overlay"></div>
                <div class="hero">
                    <div class="hero-content">
                       <h3>Mot du Directeur Général</h3>
                    </div>   
                </div>
            <!-- CONTENU -->
            <section class="section">
                <div class="card">
                    <div class="dg-container">

                            <div classe="dg-text">
                                    <img src="assets/images/image37.jpeg" class="dg-img">

                                    <h3 style="font-weight:bold;">Colonel-Major KOUASSI Yao Julien</h3>

                                        <p class="text">
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
                                            Nous vous souhaitons un bon vent et une excellente navigation.
                                        </p>

                                    <p class="signature">
                                        Colonel Major Kouassi Yao Julien<br>
                                        Administrateur en Chef des Affaires Maritimes
                                    </p>
                                </div>
                    </div>           

                </div>
            </section>

        </body>
</html>


@endsection

