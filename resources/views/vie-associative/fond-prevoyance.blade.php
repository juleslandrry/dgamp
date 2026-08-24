@extends('template')
@section('layout')

<div class="prevoyance-site-container">
    <div class="global-overlay"></div>

    <div class="container content-z">
        <div class="prevoyance-header-v2 text-center">
            <span class="badge-top">{{ $page->badge ?? 'Protection & Solidarité' }}</span>
            <h1>{{ $page->titre ?? 'Fonds de Prévoyance DGAM' }}</h1>
            <p class="lead">{{ $page->lead ?? "Garantir l'avenir de ceux qui veillent sur nos côtes." }}</p>

            @if(($page->stat1_val ?? null) || ($page->stat2_val ?? null))
                <div class="header-stats">
                    @if($page->stat1_val ?? null)
                        <div class="stat-item text-center">
                            <span class="stat-val">{{ $page->stat1_val }}</span>
                            <span class="stat-lab">{{ $page->stat1_lab }}</span>
                        </div>
                    @endif
                    @if(($page->stat1_val ?? null) && ($page->stat2_val ?? null))
                        <div class="stat-divider"></div>
                    @endif
                    @if($page->stat2_val ?? null)
                        <div class="stat-item text-center">
                            <span class="stat-val">{{ $page->stat2_val }}</span>
                            <span class="stat-lab">{{ $page->stat2_lab }}</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <section class="vision-section">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="vision-text-box">
                        <h2 class="section-title">{{ $page->intro_titre ?? 'Pourquoi ce fonds ?' }}</h2>
                        <p>{{ $page->intro_texte ?? "Le Fonds de Prévoyance de la DGAM est un levier de solidarité agissant pour l'amélioration du bien-être social des agents." }}</p>
                        @if($page && !empty($page->checklist))
                            <ul class="check-list">
                                @foreach($page->checklist as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif
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
                    @foreach($page->cards as $card)
                        <div class="i-card-glass">
                            <div class="i-icon color-{{ $card->couleur }}"></div>
                            <h3>{{ $card->titre }}</h3>
                            @if($card->description)
                                <p>{{ $card->description }}</p>
                            @endif
                            @if(!empty($card->points))
                                <ul class="key-points">
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
            <div class="cta-glass-box">
                <div class="row align-items-center">
                    <div class="col-md-8 text-center text-md-start text-white">
                        <h3>{{ $page->cta_titre }}</h3>
                        <p class="mb-md-0">{{ $page->cta_texte }}</p>
                    </div>
                    <div class="col-md-4 text-center text-md-end">
                        <a href="{{ $page->cta_bouton_lien ?: '#' }}" class="btn-orange-action">
                            {{ $page->cta_bouton_texte ?? 'En savoir plus' }}
                        </a>
                    </div>
                </div>
            </div>
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
    .header-stats { display: flex; justify-content: center; gap: 30px; margin-top: 25px; color: white; }
    .stat-val { font-size: 2.2rem; font-weight: 800; color: #ea810a; display: block; }
    .stat-divider { width: 1px; height: 50px; background: rgba(255,255,255,0.3); }
    .vision-section { padding: 50px 0; color: white; }
    .section-title::after { content: ''; display: block; width: 50px; height: 4px; background: #ea810a; margin-top: 10px; }
    .check-list { list-style: none; padding: 0; margin-top: 20px; }
    .check-list li { margin-bottom: 12px; padding-left: 18px; position: relative; }
    .check-list li::before { content: "•"; position: absolute; left: 0; color: #ea810a; }
    .rounded-20 { border-radius: 20px; }
    .intervention-section { padding: 20px 0; }
    .intervention-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; }
    .i-card-glass {
        background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.15); padding: 35px 25px; border-radius: 20px; text-align: center;
        color: white; transition: 0.3s;
    }
    .i-card-glass:hover { transform: translateY(-8px); border-color: #ea810a; }
    .i-icon { width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 15px; }
    .i-icon.color-orange { background: #ea810a; }
    .i-icon.color-vert { background: #1d976c; }
    .i-icon.color-violet { background: #6C4AB6; }
    .key-points { list-style: none; padding: 0; margin-top: 15px; text-align: left; }
    .key-points li { position: relative; padding-left: 20px; margin-bottom: 8px; font-size: 0.95rem; opacity: 0.9; }
    .key-points li::before { content: "•"; color: #ea810a; font-weight: bold; position: absolute; left: 0; font-size: 1.2rem; }
    .cta-glass-box { background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 35px; border-radius: 20px; margin-top: 40px; }
    .btn-orange-action { background: #ea810a; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 700; transition: 0.3s; display: inline-block; }
    .btn-orange-action:hover { background: white; color: #ea810a; text-decoration: none; }
    @media (max-width: 768px) {
        .img-75-centered { max-width: 100% !important; margin-top: 20px; }
        .stat-divider { display: none; }
        .header-stats { flex-direction: column; gap: 15px; }
    }
</style>

@endsection