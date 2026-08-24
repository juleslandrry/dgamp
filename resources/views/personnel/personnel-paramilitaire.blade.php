@extends('template')
@section('layout')

<section class="paramil-hero">
    <div class="paramil-hero-bg" style="background-image: url('{{ $data && $data->hero_image ? asset('storage/'.$data->hero_image) : asset('assets/images/image33.jpeg') }}');"></div>

    <div class="paramil-hero-content">
        <span class="staff-badge">{{ $data->badge ?? 'Marine Nationale' }}</span>
        <h2 class="staff-title">{{ $data->titre ?? 'Personnel Paramilitaire' }}</h2>
        <p class="staff-description">
            {{ $data->hero_description ?? "Le personnel paramilitaire assure des missions d'encadrement, de sécurité et de soutien opérationnel au sein de la DGAM." }}
        </p>
    </div>
</section>

<section class="paramil-split">
    <div class="paramil-split-container">
        <div class="paramil-split-text">
            <span class="paramil-split-eyebrow">{{ $data->section_titre ?? 'Découvrir' }}</span>
            <h3 class="paramil-split-title">{{ $data->section_titre ?? 'Le Personnel Paramilitaire' }}</h3>

            <div class="paramil-split-body">
                {!! $data->section_texte ?? "<p>Le contenu détaillé du personnel paramilitaire sera bientôt disponible.</p>" !!}
            </div>

            @if($data && !empty($data->section_points))
                <ul class="paramil-split-points">
                    @foreach($data->section_points as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="paramil-split-image">
            <img src="{{ $data && $data->section_image ? asset('storage/'.$data->section_image) : asset('assets/images/image33.jpeg') }}" alt="{{ $data->section_titre ?? 'Personnel Paramilitaire' }}">
        </div>
    </div>
</section>

<style>
    /* ===== HERO (identique en esprit aux autres pages Personnel) ===== */
    .paramil-hero {
        position: relative;
        height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
    }
    .paramil-hero-bg {
        position: absolute;
        top: -5%; left: -5%; width: 110%; height: 110%;
        background-size: cover;
        background-position: center;
        z-index: 1;
    }
    .paramil-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.4) 100%);
        z-index: 2;
    }
    .paramil-hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        max-width: 800px;
        width: 90%;
        padding: 40px;
        backdrop-filter: blur(8px);
        background: rgba(255,255,255,0.05);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .staff-badge {
        display: inline-block;
        background: #007bff;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }
    .staff-title { font-size: 2.6rem; margin-bottom: 15px; font-weight: 800; text-transform: uppercase; }
    .staff-description { font-size: 1rem; line-height: 1.6; color: rgba(255,255,255,0.85); }

    /* ===== SECTION TEXTE + IMAGE ===== */
    .paramil-split {
        background: #ffffff;
        padding: 80px 24px;
        font-family: 'Inter', sans-serif;
    }
    .paramil-split-container {
        max-width: 1140px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 60px;
        align-items: center;
    }
    .paramil-split-eyebrow {
        display: inline-block;
        color: #E8720C;
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        margin-bottom: 12px;
        position: relative;
        padding-left: 20px;
    }
    .paramil-split-eyebrow::before {
        content: "";
        position: absolute;
        left: 0; top: 50%;
        width: 14px; height: 2px;
        background: #E8720C;
        border-radius: 2px;
    }
    .paramil-split-title {
        font-size: 2rem;
        font-weight: 800;
        color: #0B2340;
        margin: 0 0 20px;
        line-height: 1.25;
    }
    .paramil-split-body {
        font-size: 15.5px;
        line-height: 1.85;
        color: #3C4655;
    }
    .paramil-split-body p { margin: 0 0 14px; }
    .paramil-split-points {
        margin: 22px 0 0;
        padding: 0;
        list-style: none;
    }
    .paramil-split-points li {
        position: relative;
        padding: 10px 0 10px 30px;
        font-size: 14.5px;
        color: #1C2733;
        border-bottom: 1px solid #EFEFEF;
    }
    .paramil-split-points li::before {
        content: "";
        position: absolute;
        left: 0; top: 18px;
        width: 8px; height: 8px;
        background: #1E7FB8;
        border-radius: 50%;
    }
    .paramil-split-image {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(11,35,64,0.18);
    }
    .paramil-split-image::after {
        content: "";
        position: absolute;
        inset: 0;
        border: 6px solid #fff;
        border-radius: 20px;
        box-sizing: border-box;
        pointer-events: none;
    }
    .paramil-split-image img {
        width: 100%;
        height: 100%;
        min-height: 380px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }
    .paramil-split-image:hover img { transform: scale(1.04); }

    @media (max-width: 860px) {
        .paramil-split-container { grid-template-columns: 1fr; }
        .paramil-split-image { order: -1; }
        .paramil-split-image img { min-height: 260px; }
        .staff-title { font-size: 2rem; }
    }
</style>

@endsection