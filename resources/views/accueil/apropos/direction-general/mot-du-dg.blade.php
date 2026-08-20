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
                                    <img src="{{ asset($photo) }}" class="dg-img">
                                    <h3 style="font-weight:bold;">{{ $grade_dg }} {{ $nom_dg }} {{ $prenom_dg }}</h3>

                                        <p class="text">
                                            {!! $texte_dg !!}
                                        </p>

                                    <p class="signature">
                                        {{ $grade_dg }} {{ $nom_dg }} {{ $prenom_dg }}<br>
                                        {{ $titre_dg }}
                                    </p>
                                </div>
                    </div>           

                </div>
            </section>

        </body>
</html>


@endsection

