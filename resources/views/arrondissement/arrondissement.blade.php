@extends('template')

@section('layout')

<section class="adiake-section">
    <div class="adiake-bg-fixed"></div>

    <div class="adiake-container">
        
        <!-- Titre dynamique -->
        <div class="adiake-header-main">
            <h3 class="adiake-main-title">{{ $arrondissement->titre }}</h3>
        </div>

        <div class="adiake-grid">
            <!-- Image dynamique avec effet 3D -->
            <div class="adiake-visual">
                <div class="frame-3d">
                    @if($arrondissement->image)
                        <img src="{{ asset('storage/' . $arrondissement->image) }}" alt="{{ $arrondissement->titre }}">
                    @else
                        <img src="{{ asset('assets/images/image95.jpeg') }}" alt="{{ $arrondissement->titre }}">
                    @endif
                    <div class="frame-overlay"></div>
                </div>
            </div>

            <!-- Contenu dynamique généré depuis Summernote -->
            <div class="adiake-text-box">
                <div class="text-scroll-area">
                    <div class="content-visible dynamic-content">
                        {!! $arrondissement->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    :root {
        --adiake-accent: #1361b5;
        --glass-bg: rgba(255, 255, 255, 0.03);
    }

    .adiake-section {
        position: relative;
        min-height: 850px;
        padding: 80px 0;
        display: flex;
        align-items: center;
        overflow: hidden;
        color: #fff;
        font-family: 'Inter', sans-serif;
    }

    .adiake-bg-fixed {
        position: absolute;
        inset: 0;
        background: url('{{ asset("assets/images/image33.jpeg") }}') center/cover no-repeat fixed;
        filter: brightness(0.15);
        z-index: 1;
    }

    .adiake-container {
        position: relative;
        z-index: 3;
        width: 90%;
        max-width: 1250px;
        margin: 0 auto;
    }

    .adiake-header-main {
        text-align: center;
        margin-bottom: 50px;
        opacity: 0;
        transform: translateY(-30px);
        transition: 1s ease-out;
    }

    .adiake-main-title {
        font-size: 3rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .adiake-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 50px;
        align-items: flex-start;
    }

    /* Visuel 3D */
    .adiake-visual { perspective: 1200px; position: sticky; top: 100px; }
    .frame-3d {
        position: relative;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,255,255,0.1);
        transition: transform 0.2s ease-out;
    }
    .frame-3d img { width: 100%; height: 550px; object-fit: cover; display: block; }

    /* Zone de Texte Dynamique */
    .adiake-text-box {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        padding: 40px;
        border-radius: 30px;
        border: 1px solid rgba(255,255,255,0.08);
        max-height: 75vh;
        overflow-y: auto;
    }

    /* Style du contenu HTML injecté via Summernote */
    .dynamic-content h4, .dynamic-content h1, .dynamic-content h2, .dynamic-content h3 { 
        color: var(--adiake-accent); 
        font-size: 1.25rem; 
        margin-top: 20px;
        margin-bottom: 15px; 
        text-transform: uppercase; 
        font-weight: 700; 
    }
    .dynamic-content h5, .dynamic-content h6 { 
        color: #fff; 
        font-size: 1rem; 
        margin: 15px 0 10px; 
        font-weight: 600; 
    }
    .dynamic-content p { 
        font-size: 0.95rem; 
        line-height: 1.6; 
        opacity: 0.85; 
        margin-bottom: 15px; 
    }

    .dynamic-content ul, .dynamic-content ol { 
        padding-left: 20px; 
        margin-bottom: 15px; 
    }
    .dynamic-content li {
        margin-bottom: 8px;
        font-size: 0.9rem;
        opacity: 0.85;
    }

    /* Style automatique pour les tableaux insérés par Summernote */
    .dynamic-content table { 
        width: 100%; 
        border-collapse: collapse; 
        background: rgba(255,255,255,0.02); 
        font-size: 0.85rem; 
        margin: 20px 0;
        border-radius: 8px;
        overflow: hidden;
    }
    .dynamic-content th, .dynamic-content td { 
        padding: 12px; 
        border: 1px solid rgba(255,255,255,0.1); 
        text-align: left; 
    }
    .dynamic-content th { 
        background: rgba(255,255,255,0.08); 
        text-transform: uppercase; 
        font-size: 0.75rem; 
        color: #fff;
    }
    .dynamic-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 15px 0;
    }

    .adiake-section.is-visible .adiake-header-main { opacity: 1; transform: translateY(0); }

    @media (max-width: 992px) {
        .adiake-grid { grid-template-columns: 1fr; }
        .adiake-visual { display: none; }
        .adiake-main-title { font-size: 2.2rem; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('.adiake-section');
    const frame = document.querySelector('.frame-3d');

    setTimeout(() => section.classList.add('is-visible'), 150);

    if (frame) {
        section.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const xMove = (clientX / window.innerWidth - 0.5) * 15;
            const yMove = (clientY / window.innerHeight - 0.5) * 15;
            frame.style.transform = `rotateY(${xMove}deg) rotateX(${-yMove}deg)`;
        });

        section.addEventListener('mouseleave', () => {
            frame.style.transform = `rotateY(0) rotateX(0)`;
        });
    }
});
</script>

@endsection