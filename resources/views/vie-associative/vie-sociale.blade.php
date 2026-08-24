@extends('template')
@section('layout')

<div class="vie-sociale-container">
    <div class="global-overlay-social"></div>

    <div class="container content-z">
        <div class="social-header text-center">
            <span class="badge-social">{{ $page->badge ?? 'Épanouissement & Cohésion' }}</span>
            <h1 class="text-white">{{ $page->titre ?? 'Vie Sociale à la DGAM' }}</h1>
            <p class="lead text-white">{{ $page->lead ?? "Plus qu'une administration, une communauté soudée au service de la mer." }}</p>

            @if($page && !empty($page->tags))
                <div class="social-tags mt-4">
                    @foreach($page->tags as $tag)
                        <span class="tag text-white">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <section class="activities-section">
            <div class="row align-items-center">
                <div class="col-md-5 text-center order-md-2">
                    <div class="img-wrapper">
                        <img src="{{ $page && $page->intro_image ? asset('storage/'.$page->intro_image) : asset('assets/images/image68.jpeg') }}" alt="Vie de groupe" class="img-fluid rounded-20 shadow-lg img-75-centered">
                    </div>
                </div>
                <div class="col-md-7 order-md-1">
                    <div class="social-text-box">
                        <h2 class="section-title text-white">{{ $page->intro_titre ?? 'Le Bien-être au Travail' }}</h2>
                        <p class="text-white">{{ $page->intro_texte ?? "La Direction Générale des Affaires Maritimes et Portuaires s'engage à offrir un cadre de vie stimulant." }}</p>
                        @if($page && !empty($page->checklist))
                            <ul class="social-list mt-3">
                                @foreach($page->checklist as $item)
                                    <li class="text-white">{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if($page && $page->cards->count())
            <section class="pillars-section">
                <div class="intervention-grid">
                    @foreach($page->cards as $card)
                        <div class="i-card-glass text-center">
                            <div class="i-icon-circle color-{{ $card->couleur }}"></div>
                            <h3 class="text-white">{{ $card->titre }}</h3>
                            @if($card->description)
                                <p class="text-white">{{ $card->description }}</p>
                            @endif
                            @if(!empty($card->points))
                                <ul class="key-points text-white">
                                    @foreach($card->points as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if($page && ($page->cta_titre || $page->cta_texte))
            <div class="cta-glass-box text-center">
                <h3 class="text-white">{{ $page->cta_titre }}</h3>
                <p class="text-white">{{ $page->cta_texte }}</p>
                <a href="{{ $page->cta_bouton_lien ?: route('galerie_img') }}" class="btn-social-action mt-3">
                    {{ $page->cta_bouton_texte ?? 'Voir la Galerie Photo' }}
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .vie-sociale-container {
        position: relative; width: 100%; min-height: 100vh;
        background-image: url('{{ asset('assets/images/image33.jpeg') }}');
        background-size: cover; background-position: center; background-attachment: fixed;
        padding-bottom: 80px;
    }
    .global-overlay-social {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(20, 20, 20, 0.85) 100%);
        z-index: 1;
    }
    .content-z { position: relative; z-index: 2; }
    .social-header { padding: 100px 0 50px; color: white; }
    .social-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }
    .img-75-centered { max-width: 75% !important; height: auto; margin: 0 auto; display: block; border: 2px solid rgba(255, 255, 255, 0.2); }
    .badge-social { background: #e37419; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }
    .tag { background: rgba(255, 255, 255, 0.15); padding: 8px 15px; border-radius: 10px; margin: 0 5px; font-size: 0.9rem; border: 1px solid rgba(255,255,255,0.1); display: inline-block; }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #e37419; margin-top: 10px; }
    .social-list { list-style: none; padding: 0; }
    .social-list li { margin-bottom: 12px; padding-left: 18px; position: relative; }
    .social-list li::before { content: "•"; position: absolute; left: 0; color: #e37419; }
    .key-points { list-style: none; padding: 0; margin-top: 15px; text-align: left; display: inline-block; }
    .key-points li { position: relative; padding-left: 20px; margin-bottom: 8px; font-size: 0.95rem; opacity: 0.9; }
    .key-points li::before { content: "•"; color: #e37419; font-weight: bold; position: absolute; left: 0; font-size: 1.2rem; }
    .intervention-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-top: 50px; }
    .i-card-glass {
        background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.15); padding: 35px 25px; border-radius: 20px; transition: 0.3s;
    }
    .i-card-glass:hover { transform: translateY(-8px); border-color: #e37419; }
    .i-icon-circle { width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 15px; }
    .i-icon-circle.color-orange, .i-icon-circle.color-violet { background: #e37419; }
    .i-icon-circle.color-vert { background: #1d976c; }
    .cta-glass-box { background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); padding: 35px; border-radius: 20px; margin-top: 40px; }
    .btn-social-action {
        background: #1d976c; color: white !important; padding: 12px 25px; border-radius: 8px;
        text-decoration: none !important; font-weight: 700; display: inline-block; border: none;
    }
    .btn-social-action:hover { background: #e37419; color: white !important; }
    @media (max-width: 768px) {
        .social-header h1 { font-size: 2.2rem; }
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
    }
</style>

@endsection