@extends('template')
@section('layout')

<div class="associations-container">
    <div class="global-overlay-assoc"></div>

    <div class="container content-z">
        <div class="assoc-header text-center">
            <span class="badge-assoc">{{ $page->badge ?? 'Réseau & Partenariats' }}</span>
            <h1 class="text-white">{{ $page->titre ?? 'Autres Associations' }}</h1>
            <p class="lead text-white">{{ $page->lead ?? "Découvrez les structures partenaires qui gravitent autour de la DGAM." }}</p>
        </div>

        <section class="intro-assoc-section">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="assoc-text-box">
                        <h2 class="section-title text-white">{{ $page->intro_titre ?? 'Synergie et Collaboration' }}</h2>
                        <p class="text-white">{{ $page->intro_texte ?? "Au-delà de nos missions régaliennes, la DGAMP collabore avec diverses associations professionnelles et culturelles." }}</p>
                        @if($page && !empty($page->checklist))
                            <ul class="check-list mt-3">
                                @foreach($page->checklist as $item)
                                    <li class="text-white">{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-5 text-center">
                    <div class="img-wrapper">
                        <img src="{{ $page && $page->intro_image ? asset('storage/'.$page->intro_image) : asset('assets/images/image105.jpeg') }}" alt="Associations" class="img-fluid rounded-20 shadow-lg img-75-centered">
                    </div>
                </div>
            </div>
        </section>

        @if($page && $page->cards->count())
            <section class="assoc-list-section">
                <div class="intervention-grid">
                    @foreach($page->cards as $card)
                        <div class="i-card-glass text-center">
                            <div class="i-icon-circle bg-assoc"></div>
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
    </div>
</div>

<style>
    .associations-container {
        position: relative; width: 100%; min-height: 100vh;
        background-image: url('{{ asset('assets/images/image33.jpeg') }}');
        background-size: cover; background-position: center; background-attachment: fixed;
        padding-bottom: 80px;
    }
    .global-overlay-assoc {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(24, 23, 23, 0.9) 100%);
        z-index: 1;
    }
    .content-z { position: relative; z-index: 2; }
    .assoc-header { padding: 100px 0 50px; color: white; }
    .assoc-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }
    .img-75-centered { max-width: 75% !important; height: auto; margin: 0 auto; display: block; border: 2px solid rgba(255, 255, 255, 0.2); }
    .badge-assoc { background: #e37419; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #e37419; margin-top: 10px; }
    .check-list { list-style: none; padding: 0; margin-top: 20px; }
    .check-list li { margin-bottom: 12px; padding-left: 18px; position: relative; }
    .check-list li::before { content: "•"; position: absolute; left: 0; color: #e37419; }
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
    .bg-assoc { background: #e37419; }
    @media (max-width: 768px) {
        .assoc-header h1 { font-size: 2.2rem; }
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
    }
</style>

@endsection