@extends('template')
@section('layout')

<div class="prevoyance-site-container">
    <div class="global-overlay"></div>

    <div class="container content-z">
        <div class="prevoyance-header-v2 text-center">
            <span class="badge-top">{{ $page->badge ?? 'Protection & Solidarité' }}</span>
            <h1>{{ $page->titre ?? 'Fonds de Prévoyance DGAM' }}</h1>
            <p class="lead">{{ $page->lead ?? "Garantir l'avenir de ceux qui veillent sur nos côtes." }}</p>
        </div>

        <section class="vision-section">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="vision-text-box">
                        <h2 class="section-title">{{ $page->intro_titre ?? 'Pourquoi ce fonds ?' }}</h2>
                        <p>{{ $page->intro_texte ?? "Le Fonds de Prévoyance de la DGAM est un levier de solidarité agissant pour l'amélioration du bien-être social des agents." }}</p>
                    </div>
                </div>
                <div class="col-md-5 text-center">
                    <div class="vision-img-container">
                        <img src="{{ $page && $page->intro_image ? asset('storage/'.$page->intro_image) : asset('assets/images/image104.jpeg') }}" alt="Solidarité" class="img-fluid rounded-20 shadow-lg img-75-centered">
                    </div>
                </div>
            </div>
        </section>

        @if($page && $page->cards->count())
            <section class="intervention-section">
                <h2 class="text-center mb-5 text-white fw-bold">Nos Domaines d'Intervention</h2>
                <div class="intervention-grid">
                    @foreach($page->cards as $item)
                        <div class="i-card-glass">
                            <h3>{{ $item->titre }}</h3>
                            @if($item->description)
                                <p>{{ $item->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

<style>
    .prevoyance-site-container {
        position: relative; width: 100%; min-height: 100vh;
        background-image: url('{{ asset('assets/images/image33.jpeg') }}');
        background-size: cover; background-position: center; background-attachment: fixed;
        padding-bottom: 100px;
    }
    .global-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.7) 0%, rgba(6, 6, 6, 0.8) 50%, rgba(0, 0, 0, 0.6) 100%);
        z-index: 1;
    }
    .content-z { position: relative; z-index: 2; }
    .img-75-centered { max-width: 75% !important; height: auto; margin: 0 auto; display: block; }
    .prevoyance-header-v2 { padding: 100px 0 50px; color: white; }
    .prevoyance-header-v2 h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }
    .badge-top { background: #ea810a; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }
    .vision-section { padding: 50px 0; color: white; }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #ea810a; margin-top: 10px; }
    .rounded-20 { border-radius: 20px; }
    .intervention-section { padding: 20px 0; }
    .intervention-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; }
    .i-card-glass {
        background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15); padding: 30px 25px; border-radius: 20px; text-align: center;
        color: white; transition: 0.3s;
    }
    .i-card-glass:hover { transform: translateY(-8px); border-color: #ea810a; }
    .i-card-glass h3 { font-size: 1.15rem; margin-bottom: 10px; }
    .i-card-glass p { font-size: 0.92rem; opacity: 0.85; line-height: 1.6; margin: 0; }
    @media (max-width: 768px) {
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
    }
</style>

@endsection