@extends('template')
@section('layout')
    <!-- Hero Start
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-1 col-md-11">
                    <div class="swiper-container hero-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200">Bienvenue<br> sur le site de la direction generale des affaires maritimes et portuaires
                                    </h1>


                                </div>
                            </div>
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200">Bienvenue<br> sur le site de la direction generale des affaires maritimes et portuaires
                                    </h1>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <span class="arr-left"><i class="fa fa-angle-left"></i></span>
            <span class="arr-right"><i class="fa fa-angle-right"></i></span>
        </div>
        <div class="texture"></div>
        <div class="diag-bg"></div>
    </section>
    Hero End -->


<!-- ======= SECTION SLIDER ======= -->
<section class="hero-slider">
    <div class="slides">
        @forelse($banniere as $index => $banner)
            <div class="slide {{ $index === 0 ? 'active' : '' }}"
                 style="background-image: url('{{ asset('storage/' . $banner->image) }}')">
                <div class="overlay"></div>
                <div class="content">
                    <h2>{!! $banner->titre !!}</h2>
                </div>
            </div>
        @empty
            <!-- Slider statique par défaut (si aucune bannière en BDD) -->
            <div class="slide active" style="background-image: url('{{ asset('assets/images/image29.jpeg') }}')" alt="Image29">
                <div class="overlay"></div>
                <div class="content">
                    <h2>Surveillance des plans <br> d'eau fluvio lagunaire</h2>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('assets/images/image1.jpeg') }}')" alt="Image1">
                <div class="overlay"></div>
                <div class="content">
                    <h2>Prix d'excellence 2024 du colonel <br> Nessemon Kida Rose honorée par le chef de l'etat</h2>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('assets/images/image33.jpeg') }}')" alt="Image33">
                <div class="overlay"></div>
                <div class="content">
                    <h2>DGAM/FORMATION 50 élèves-officiers <br> presentés au drapeau national</h2>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('assets/images/image32.jpeg') }}')" alt="Image3">
                <div class="overlay"></div>
                <div class="content">
                    <h2>Sortie officielle de la 11ème promotion<br> de la DGAM baptisé &lt;&lt; promotion Gonkano Ouan Philbert &gt;&gt;</h2>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('assets/images/image26.jpeg') }}')" alt="Image26">
                <div class="overlay"></div>
                <div class="content">
                    <h2>Securité maritime la Cote d'Ivoire <br> reçoit &lt;&lt; scala &gt;&gt; un bateau bateau de sauvetage maritime</h2>
                </div>
            </div>

            <div class="slide" style="background-image: url('{{ asset('assets/images/image35.jpeg') }}')" alt="Image35">
                <div class="overlay"></div>
                <div class="content">
                    <h2>Operation &lt;&lt; chalut &gt;&gt; de la <br> direction maritime en mer</h2>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Boutons de navigation -->
    <div class="nav-btn prev">&#10094;</div>
    <div class="nav-btn next">&#10095;</div>
</section>

    <style>
        .hero-slider {
        position: relative;
        width: 100%;
        height: 90vh;
        overflow: hidden;
        }

        .slides {
        position: relative;
        width: 100%;
        height: 100%;
        }

        .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
        }

        .slide.active {
        opacity: 1;
        }

        .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.45);
        }

        .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -30%);
        color: #fff;
        text-align: center;
        max-width: 700px;
        padding: 20px;
        animation: fadeUp 1s ease;
        }

        .content h2 {
        font-size: 2.8rem;
        margin-bottom: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        }

        .btn-hero {
        display: inline-block;
        padding: 12px 25px;
        background-color: #f85c01;
        color: #fff;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
        }

        .btn-hero:hover {
        background-color: #28a745;
        transform: scale(1.05);
        }

        /* Navigation boutons */
        .nav-btn {
        position: absolute;
        top: 50%;
        color: #fff;
        font-size: 2rem;
        background: rgba(0,0,0,0.4);
        padding: 3px 3px;
        border-radius: 50%;
        cursor: pointer;
        user-select: none;
        transition: background 0.3s ease;
        z-index: 10;
        }

        .nav-btn:hover {
        background: rgba(0,0,0,0.6);
        }

        .nav-btn.prev { left: 20px; }
        .nav-btn.next { right: 20px; }

        /* Animation de texte */
        @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
        }

        /* Responsive */
        @media (max-width: 768px) {
        .content h2 {
            font-size: 1.6rem;
        }

        .content p {
            font-size: 1rem;
        }

        .btn-hero {
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        .hero-slider {
            height: 75vh;
        }
        }
    </style>



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



    <!-- Trust Start -->
<section class="trust">
    <div class="container">
        <!-- Retrait de align-items-center pour aligner le contenu en haut -->
        <div class="row">
            <!-- Texte -->
            <div class="offset-xl-1 col-xl-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                <div class="title">
                    <h3 class="title-primary"><strong>PRESENTATION</strong></h3>
                    <div class="presentation-bar-long"></div>
                    <h1>Affaires Maritimes de Côte d’Ivoire</h1>
                </div>

                <!-- Texte d'introduction dynamique -->
                <div class="presentation-content">
                    <p>
                        {!! nl2br(e($historique?->intro ?? "Les Affaires Maritimes ivoiriennes, composante essentielle des Forces de Sécurité Intérieure de l’État, assurent la régulation, la sécurité et le développement des activités maritimes et portuaires nationales.")) !!}
                    </p>
                </div>

                <!-- Bouton de redirection vers la page Historique -->
                <div class="btn-wrapper mt-4">
                    <a href="{{ route('historiquedgam') }}" class="btn btn-lire-suite">
                        Lire la suite
                    </a>
                </div>
            </div>

            <!-- Galerie d'images dynamique -->
            <div class="col-xl-5 gallery-modern">
                <div class="gallery-grid">
                    <div class="gallery-item large">
                        <img src="{{ $historique?->image1 ? asset('storage/'.$historique->image1) : asset('assets/images/image9.jpeg') }}" class="img-fixe" alt="Présentation 1">
                    </div>

                    <div class="gallery-item">
                        <img src="{{ $historique?->image2 ? asset('storage/'.$historique->image2) : asset('assets/images/image37.jpeg') }}" class="img-fixe" alt="Présentation 2">
                    </div>

                    <div class="gallery-item">
                        <img src="{{ $historique?->image3 ? asset('storage/'.$historique->image3) : asset('assets/images/image34.jpeg') }}" class="img-fixe" alt="Présentation 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .navbar a:hover {
        color: #f39c12;
    }

    /* ALIGNEMENT HAUT : Remplacement de align-items: center par flex-start */
    .trust .row {
        display: flex;
        align-items: flex-start;
    }

    .trust {
        padding: 40px 0;
    }

    /* Ajustement des titres pour un alignement propre avec l'image */
    .trust .title h3 {
        margin-top: 0;
    }

    .btn-lire-suite {
        background-color: #f39c12;
        color: #fff;
        padding: 10px 25px;
        border-radius: 25px;
        text-decoration: none;
        display: inline-block;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .btn-lire-suite:hover {
        background-color: #d35400;
        color: #fff;
    }

    .btn-wrapper {
        display: inline-block;
        margin-left: 0;
    }

    /* LONGUE BARRE */
    .presentation-bar-long {
        width: 100%;
        height: 6px;
        background: linear-gradient(
            to right,
            #156b06,
            #2ab558,
            #0f771d
        );
        margin: 20px 0 25px;
        border-radius: 5px;
    }

    /* CONTENEUR GALERIE */
    .gallery-modern {
        padding: 0 10px;
    }

    /* PRESENTATION IMAGES VERTICALES */
    .gallery-modern .gallery-grid {
        display: flex !important;
        flex-direction: column !important;
        gap: 15px;
    }

    .gallery-modern .gallery-item.large {
        grid-row: auto !important;
    }

    /* BLOCS IMAGE */
    .gallery-item {
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }

    /* IMAGE */
    .gallery-item img {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    /* HOVER */
    .gallery-item:hover img {
        transform: scale(1.08);
    }

    .offset-xl-1.col-xl-6 p {
        text-align: justify;
    }

    /* MOBILE */
    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }

        .gallery-item.large {
            grid-row: auto;
        }
    }
</style>

<!-- Mot du Directeur Général Start -->
<section class="featured">
    <div class="container">
        <div class="row align-items-center">

            <!-- IMAGE -->
            <div class="col-md-5">
    <div class="featured-img">
        <img class="img-fluid"
             src="{{ $motDg && $motDg->photo ? asset($motDg->photo) : asset('assets/images/image37.jpeg') }}"
             alt="{{ trim(($motDg->nom_dg ?? '') . ' ' . ($motDg->prenom_dg ?? '')) ?: 'Directeur Général' }}">

        <h5 class="mb-0">
            {{ trim(($motDg->grade_dg ?? '') . ' ' . ($motDg->nom_dg ?? '') . ' ' . ($motDg->prenom_dg ?? '')) ?: 'Colonel-Major Kouassi Yao Julien' }}
        </h5>
        <small class="titre">
            {{ $motDg->titre_dg ?? 'Administrateur en Chef des Affaires Maritimes' }}
        </small>
    </div>
</div>

<!-- TEXTE -->
<div class="col-md-7">
    <div class="title">
        <h1 class="title-blue">Mot du Directeur Général</h1>
    </div>

    <p>
         {{ Str::limit(strip_tags(html_entity_decode($motDg->texte_dg ?? '')), 420, '...') ?: "La nécessité pour notre administration de posséder un site internet fonctionnel et régulièrement actualisé..." }}
    </p>
                <!-- BOUTON JUSTE EN BAS DU TEXTE -->
                <a href="{{ route ('motdudg') }}">
                    <button id="btnLire" class="btn-lire-suite" onclick="toggleMot()">
                        Lire la suite
                    </button>
                </a>


            </div>
        </div>
    </div>
</section>
<!-- Mot du Directeur Général End -->


<style>
        .featured {
            padding: 60px 0;
        }

        .featured-img {
            position: sticky;
            top: 80px;
            text-align: center;
        }

        .featured-img img {
            margin: 16px 5px;
            max-width: 100%;
            height: auto;
        }

        .mb-0,
        .titre {
            color: white;
        }

        .dg-more-text {
            display: none;
            margin-top: 15px;
        }

        .offset-xl-1.col-xl-6 p {
            text-align: justify;
        }

        .btn-lire-suite {
            margin-top: 15px;
            padding: 6px 18px;
            font-size: 14px;
            background-color: #f7931e;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-lire-suite:hover {
            background-color: #e57f0f;
        }

        @media (max-width: 768px) {

            .featured {
                padding: 30px 15px;
            }

            .featured-img {
                position: static;
                margin-bottom: 20px;
            }

            .title-blue {
                font-size: 22px;
                text-align: center;
            }

            .btn-lire-suite {
                display: block;
                margin: 20px auto;
            }

            .featured p {
                font-size: 14px;
                text-align: justify;
            }
        }
</style>


<script>
        function toggleMot() {
            const moreText = document.getElementById("dg-more-text");
            const btn = document.getElementById("btnLire");

            if (moreText.style.display === "block") {
                moreText.style.display = "none";
                btn.textContent = "Lire la suite";
            } else {
                moreText.style.display = "block";
                btn.textContent = "Réduire";
            }
        }
</script>

  <!-- Recent Posts Start -->
<!-- Recent Posts Start -->
<section class="recent-posts">
    <div class="container">
        <div class="row">

            <!-- Titre -->
            <div class="col-12">
                <div class="actualite-bar">
                    <h3 class="actualite-title">ACTUALITÉS</h3>
                </div>
            </div>

            @forelse($actualites as $actu)
                <div class="col-lg-6 mb-4">
                    <div class="single-rpost d-flex align-items-center">

                        <!-- BADGE CATEGORIE -->
                        <div class="post-badge securite">
                            {{ $actu->categorie ?? 'ACTUALITÉ' }}
                        </div>

                        <div class="post-thumb">
                            <img src="{{ $actu->image_path ? asset('storage/' . $actu->image_path) : asset('assets/images/image14.jpeg') }}" alt="{{ $actu->titre }}">
                        </div>

                        <div class="post-content">
                            <time>
                                Publié le : {{ $actu->date_publication ? \Carbon\Carbon::parse($actu->date_publication)->translatedFormat('d F Y') : \Carbon\Carbon::parse($actu->created_at)->translatedFormat('d F Y') }}
                            </time>
                            <h4>
                                <a href="{{ route('actualitesdgam') }}" class="no-underline">
                                    {{ Str::limit($actu->titre, 60, '...') }}
                                </a>
                            </h4>
                            <div class="views">
                                👁 <span class="static-view">{{ $actu->vues ?? 0 }}</span> vues
                            </div>
                            <a class="post-btn" href="{{ route('actualitesdgam') }}">→</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Aucune actualité disponible pour le moment.</p>
                </div>
            @endforelse

        </div>

        <!-- Bouton voir plus -->
        <div class="text-center mt-4" id="groupebtn">
            <a href="{{ route('actualitesdgam') }}" class="btn-actualites" id="btn-voirplus">
                Voir plus
            </a>
        </div>

    </div>
</section>
<!-- Recent Posts End -->

<style>
        .recent-posts {
            padding: 30px 0;
            background: #f4f7f6;
        }

        .actualite-bar {
            position: relative;
            height: 6px;
            background: linear-gradient(to right, #0c9735, #2ab558);
            margin: 80px 0 60px;
        }

        .actualite-title {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 6px 25px;
            font-weight: bold;
            color: #ea810a;
            letter-spacing: 2px;
            font-size: 18px;
        }

        .single-rpost {
            background: #fff;
            padding: 18px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .single-rpost:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        }

        .post-thumb {
            width: 220px;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
        }

        .post-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s;
        }

        .single-rpost:hover img {
            transform: scale(1.08);
        }

        .post-content time {
            font-size: 13px;
            color: #777;
        }

        .post-content h4 {
            margin: 8px 0;
            font-size: 18px;
            font-weight: 600;
        }

        .views {
            font-size: 13px;
            color: #888;
            margin-top: 5px;
        }

        .static-view {
            color: red;
            font-weight: 600;
        }

        /* ==========================================================================
           TOUS LES LIENS TEXTE - TRAIT SUPPRIMÉ DE FORCE (survol inclus)
           ========================================================================== */
        a,
        a:link,
        a:visited {
            color: inherit;
            text-decoration: none !important;
            border-bottom: none !important;
            outline: none !important;
        }

        a:hover,
        a:focus,
        a:active {
            text-decoration: none !important;
            border-bottom: none !important;
            outline: none !important;
        }

        .no-underline,
        .no-underline:link,
        .no-underline:visited {
            text-decoration: none !important;
            border-bottom: none !important;
            color: #222;
        }

        .no-underline:hover,
        .no-underline:focus,
        .no-underline:active {
            color: #ea810a;
            text-decoration: none !important;
            border-bottom: none !important;
        }

        .post-btn,
        .post-btn:link,
        .post-btn:visited {
            color: #ea810a;
            font-size: 18px;
            text-decoration: none !important;
            border-bottom: none !important;
        }

        .post-btn:hover,
        .post-btn:focus,
        .post-btn:active {
            text-decoration: none !important;
            border-bottom: none !important;
        }

        .btn-actualites,
        .btn-actualites:link,
        .btn-actualites:visited {
            background: #ea810a;
            color: #fff;
            border-radius: 30px;
            padding: 12px 35px;
            text-decoration: none !important;
            border: none;
            border-bottom: none !important;
            transition: 0.3s;
        }

        .btn-actualites:hover,
        .btn-actualites:focus,
        .btn-actualites:active {
            background: #d87306;
            text-decoration: none !important;
            border-bottom: none !important;
            outline: none !important;
        }

        @media (max-width:768px) {
            .single-rpost {
                flex-direction: column;
                text-align: center;
            }

            .post-thumb {
                width: 100%;
                height: 200px;
            }
        }

        /* Position relative pour permettre la badge */
        .single-rpost{
            position:relative;
            overflow:hidden;
        }

        /* BADGE GENERALE */
        .post-badge{
            position:absolute;
            top:0;
            left:0;
            padding:6px 18px;
            font-size:12px;
            font-weight:600;
            color:#fff;
            border-bottom-right-radius:12px;
            letter-spacing:1px;
        }

        /* COULEUR PAR TYPE */
        .post-badge.securite{
            background:#156916; /* rouge */
        }

        .post-badge.economie{
            background:#156916; /* vert */
        }

        .post-badge.formation{
            background:#156916; /* bleu */
        }
</style>
<!-- Recent Posts End -->


<!-- Communiqués Start -->
<section class="communique-section">
    <div class="container">

        <!-- Titre -->
        <div class="col-12">
            <div class="actualite-bar">
                <h3 class="actualite-title">COMMUNIQUÉS</h3>
            </div>
        </div>

        <div class="row">
            @forelse($communiques as $communique)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="communique-card">
                        <img src="{{ asset('assets/images/service3.png') }}" alt="Icône document">
                        <h5>{{ Str::limit($communique->titre, 50, '...') }}</h5>
                        <p>{{ Str::limit(strip_tags($communique->description ?? $communique->contenu), 80, '...') }}</p>

                        @if(!empty($communique->fichier_path))
                            <a href="{{ asset('storage/' . $communique->fichier_path) }}" class="btn-download" target="_blank" download>
                                Télécharger
                            </a>
                        @else
                            <a href="{{ route('communiquesdgam') }}" class="btn-download">
                                Consulter
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Aucun communiqué disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('communiquesdgam') }}" class="btn-orange">Voir plus</a>
        </div>

    </div>
</section>
<!-- Communiqués End -->


    <style>

                    /* SECTION */
            .communique-section{
                padding:0px 0;
                background:#f4f7f6;
            }

            /* CARTE UNIQUEMENT */
            .communique-section .communique-card{
                background:#fff;
                padding:25px;
                border-radius:15px;
                text-align:center;
                box-shadow:0 8px 20px rgba(0,0,0,0.08);
                transition:.3s;
                height:100%;
                display:flex;
                flex-direction:column;
            }

            /* HOVER */
            .communique-section .communique-card:hover{
                transform:translateY(-6px);
                box-shadow:0 12px 30px rgba(0,0,0,0.12);
            }

            /* IMAGE */
            .communique-section .communique-card img{
                width:70px;
                height:70px;
                object-fit:contain;
                margin:0 auto 15px;
            }

            /* TEXTE */
            .communique-section .communique-card p{
                flex-grow:1;
                font-size:14px;
                color:#555;
                font-weight: bold;
            }

            /* BOUTON TELECHARGER */
            .communique-section .btn-download{
                padding:8px 20px;
                border-radius:25px;
                border:2px solid #ea810a;
                color:#ea810a;
                text-decoration:none;
                font-weight:500;
                transition:.3s;
            }

            .communique-section .btn-download:hover{
                background:#ea810a;
                color:#fff;
            }

            /* VOIR PLUS */
            .communique-section .btn-orange{
                background:#ea810a;
                color:#fff;
                padding:12px 35px;
                border-radius:30px;
                text-decoration:none;
            }
    </style>
        <!-- Services End -->

<section class="mega-gallery-section py-5">
    <div class="container">

        <div class="row animate-box">
            <div class="col-md-12 text-center">
                <div class="actualite-bar">
                    <h3 class="actualite-title">GALERIE MÉDIA</h3>
                </div>
                <div class="dg-separator"></div>
                <p class="section-desc"><strong>Découvrez les activités, les interventions en mer et les moments forts de la Direction Générale des Affaires Maritimes et Portuaires.</strong></p>
            </div>
        </div>

        <div class="row dg-galerie-tabs animate-box">
            <div class="col-md-12 text-center">
                <button class="galerie-tab active" data-target="photos">
                    <i class="icon-camera"></i> Photos
                </button>
                <button class="galerie-tab" data-target="videos">
                    <i class="icon-video2"></i> Vidéos
                </button>
            </div>
        </div>

        <div class="row dg-galerie-content">

            <div class="dg-galerie-box active" id="photos">
                <div class="dg-flex-container">
            @forelse($albumsApercu as $album)
                <div class="dg-item animate-box" onclick="window.location.href='{{ route('galerie_img') }}'">
                    <div class="img-wrapper">
                        <img src="{{ $album->cover ? asset($album->cover) : asset('assets/images/image31.jpeg') }}" alt="{{ $album->titre }}">
                        <div class="dg-overlay"><i class="icon-plus"></i></div>
                    </div>
                    <div class="dg-item-info">
                        <h4>{{ Str::limit($album->titre, 40, '...') }}</h4>
                        <p>{{ $album->date }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Aucun album disponible pour le moment.</p>
            @endforelse
        </div>
                <div class="dg-btn-wrapper">
                    <button onclick="window.location.href='{{ route('galerie_img') }}'" class="btn-media-action btn-green">Voir toutes les photos</button>
                </div>
            </div>

            <div class="dg-galerie-box" id="videos">
                <div class="dg-flex-container">
    @forelse($videosApercu as $video)
        <div class="dg-item animate-box">
            <div class="video-container">
                <iframe src="{{ $video->url }}" allowfullscreen></iframe>
            </div>
            <div class="dg-item-info">
                <h4>{{ Str::limit($video->titre, 40, '...') }}</h4>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">Aucune vidéo disponible pour le moment.</p>
    @endforelse
</div>
                <div class="dg-btn-wrapper">
                    <button onclick="window.location.href='{{ route('galerie_vidéo') }}'" class="btn-media-action btn-blue">Voir toutes les vidéos</button>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* 1. TEXTE ET TITRES */
    .text-center { text-align: center !important; }
    .dg-separator { width: 60px; height: 3px; background: #e87f08; margin: 0 auto 20px; }
    .section-desc { max-width: 700px; margin: 0 auto 30px; color: #666; line-height: 1.6; }

    .actualite-bar { position: relative; width: 100%; height: 2px; background: #218c44; margin: 40px 0; }
    .actualite-title { position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #fff; padding: 0 20px; font-weight: 800; color: #e87f08; margin: 0; white-space: nowrap; }

    /* 2. ALIGNEMENT FLEX ET GRILLE */
    .dg-flex-container {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        gap: 25px;
        margin-top: 30px;
    }

    .dg-item {
        flex: 0 1 350px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
        border: none; /* Enlève toute bordure par défaut */
    }

    .img-wrapper, .video-container { position: relative; height: 230px; width: 100%; background: #000; border: none; }
    .img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .video-container iframe { width: 100%; height: 100%; border: none; }

    .dg-item-info { padding: 20px; }
    .dg-item-info h4 { font-size: 18px; font-weight: 700; margin-bottom: 5px; color: #1a252f; }
    .dg-item-info p { color: #888; font-size: 14px; margin: 0; }

    /* 3. BOUTONS RONDS ET SANS COULEUR NOIRE */
    .dg-btn-wrapper { width: 100%; text-align: center; margin-top: 40px; }

    .btn-media-action, .galerie-tab {
        border: none !important; /* Force la suppression des bordures noires */
        outline: none !important;
        box-shadow: none !important; /* Enlève les ombres portées qui font "cadre" */
        cursor: pointer;
        transition: 0.3s;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        border-radius: 50px !important; /* Rend les boutons totalement ronds */
    }

    /* Styles spécifiques "Voir plus" */
    .btn-media-action {
        padding: 15px 45px;
        display: inline-block;
    }
    .btn-green { background: #e87f08; color: #fff; }
    .btn-green:hover { background: #e87f08; transform: scale(1.05); }
    .btn-blue { background: #e87f08; color: #fff; }
    .btn-blue:hover { background: #e87f08; transform: scale(1.05); }

    /* Styles Onglets */
    .galerie-tab {
        background: #f0f0f0;
        color: #555;
        padding: 10px 35px;
        margin: 5px;
    }
    .galerie-tab.active { background: #218c44; color: #fff; }

    /* Affichage sections */
    .dg-galerie-box { display: none; width: 100%; }
    .dg-galerie-box.active { display: block !important; }
</style>

<script>
    document.querySelectorAll('.galerie-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            document.querySelectorAll('.galerie-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            document.querySelectorAll('.dg-galerie-box').forEach(box => {
                box.classList.remove('active');
                if(box.id === target) box.classList.add('active');
            });
        });
    });
</script>


    <!-- Testimonial and Clients Start -->
<section class="partners">
    <div class="actualite-bar">
        <h3 class="actualite-title">PARTENAIRES</h3>
    </div>

    <div class="partners-wrapper">
        <div class="partners-mask">
            <div class="partners-track" id="track">
                @forelse($partenaires as $partenaire)
                    <div class="partner-card">
                        <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="{{ $partenaire->nom }}">
                    </div>
                @empty
                    <!-- Fallback static si aucun partenaire en base -->
                    <div class="partner-card"><img src="{{ asset('assets/images/image25.jpeg') }}" alt="Partenaire"></div>
                    <div class="partner-card"><img src="{{ asset('assets/images/image23.jpeg') }}" alt="Partenaire"></div>
                    <div class="partner-card"><img src="{{ asset('assets/images/image18.jpeg') }}" alt="Partenaire"></div>
                @endforelse

                <!-- Duplication pour le défilement infini -->
                @foreach($partenaires as $partenaire)
                    <div class="partner-card" aria-hidden="true">
                        <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>

        <button class="partners-toggle" id="partnersToggle" aria-pressed="false" aria-label="Mettre en pause le défilement">
            <span id="partnersToggleIcon">❚❚</span>
        </button>
    </div>
</section>


<style>

        .partners {
            padding: 20px 0px;
            background: #f4f7f6;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .partners-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .partners-mask {
            overflow: hidden;
            width: 100%;
            -webkit-mask-image: linear-gradient(90deg, transparent 0, #000 8%, #000 92%, transparent 100%);
            mask-image: linear-gradient(90deg, transparent 0, #000 8%, #000 92%, transparent 100%);
        }

        .partners-track {
            display: flex;
            align-items: center;
            gap: 28px;
            width: max-content;
            animation: scroll 22s linear infinite;
        }

        .partners-mask:hover .partners-track,
        .partners-track.is-paused {
            animation-play-state: paused;
        }

        .partner-card {
            flex: 0 0 auto;
            width: 160px;
            height: 100px;
            background: #fff;
            border: 1px solid #eef1f4;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.07);
            transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
        }

        .partner-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .partner-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 30px rgba(234,129,10,0.18);
            border-color: #f6c98a;
        }

        /* Animation */
        @keyframes scroll {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-50%);
            }
        }

        /* Bouton pause/lecture */
        .partners-toggle {
            position: absolute;
            right: 4%;
            bottom: -42px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid #e2e6ea;
            background: #fff;
            color: #0c9735;
            font-size: 11px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
            transition: .25s ease;
            z-index: 2;
        }

        .partners-toggle:hover {
            background: #ea810a;
            border-color: #ea810a;
            color: #fff;
        }

        @media (prefers-reduced-motion: reduce) {
            .partners-track { animation: none; flex-wrap: wrap; justify-content: center; }
            .partners-mask { -webkit-mask-image: none; mask-image: none; }
            .partners-toggle { display: none; }
        }

        @media (max-width: 768px) {
            .partner-card { width: 130px; height: 86px; }
        }

        .actualite-bar {
            position: relative;
            width: 100%;
            height: 6px;
            background: #0c9735;
            margin: 100px 0 70px;
        }

        .actualite-title {
            position: absolute;
            top: -16px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 4px 18px;
            font-weight: bold;
            color: #de6d17;
            letter-spacing: 2px;
        }


        button,
        a[class*="btn"],
        .btn,
        .btn-actualites,
        .btn-orange,
        .btn-download,
        .btn-lire-suite,
        .post-btn {
                font-weight: bold !important;
        }

</style>

<script>
    (function () {
        const track = document.getElementById('track');
        const toggle = document.getElementById('partnersToggle');
        const icon = document.getElementById('partnersToggleIcon');
        let paused = false;

        toggle.addEventListener('click', function () {
            paused = !paused;
            track.classList.toggle('is-paused', paused);
            toggle.setAttribute('aria-pressed', paused);
            icon.textContent = paused ? '▶' : '❚❚';
        });
    })();
</script>

<script>
        document.querySelectorAll('.view-count').forEach((el, i) => {
            let key = "post_view_" + i;
            let count = localStorage.getItem(key);

            if (!count) {
                count = 1;
                localStorage.setItem(key, count);
            } else {
                count++;
                localStorage.setItem(key, count);
            }

            el.textContent = count;
        });
</script>

@endsection
