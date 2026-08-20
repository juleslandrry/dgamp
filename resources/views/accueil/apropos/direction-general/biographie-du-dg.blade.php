@extends('template')
@section('layout')

<section class="bio-section">
    <div class="container">
        <h1 class="bio-main-title">BIOGRAPHIE DU DIRECTEUR GÉNÉRAL</h1>

        <div class="profile-card shadow-lg">
            <div class="profile-content">
                                <div class="info-details">
                    <p><span>Nom :</span> {{ $nom }}</p>
                    <p><span>Prénoms :</span> {{ $prenoms }}</p>
                    <p><span>Naissance :</span> {{ \Carbon\Carbon::parse($date_naissance)->format('d/m/Y') }} à {{ $lieu_naissance }}</p>
                    <p><span>Corps :</span> {{ $corps }}</p>
                    <p><span>Grade / Classe :</span> {{ $grade }}</p>
                    <div class="current-role">
                        <strong>Fonction actuelle :</strong><br>
                        {{ $fonction }}
                    </div>
                </div>
            </div>
            <div class="profile-image-container">
                <img src="{{ asset($photo) }}" alt="Portrait DG" class="img-fluid rounded shadow">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-7">
                <h2 class="sub-title"><i class=""></i><strong>Parcours Professionnel</strong></h2>
                    <div class="custom-timeline">
                    @foreach($timeline as $item)
                        <div class="timeline-box">
                            <span class="date-badge">{{ $item->date }}</span>
                            <p>{{ $item->texte }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-5">
                <h2 class="sub-title"><i class=""></i><strong> Formation </strong></h2>
                                    <div class="edu-card">
                    @foreach($formation as $item)
                        <div class="edu-item">
                            <h5>{{ $item->annee }}</h5>
                            <p>{{ $item->texte }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Section Fond avec Image */
    .bio-section {
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)), 
                    url('assets/images/image34.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 100px 0;
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .bio-main-title {
        text-align: center;
        font-weight: 800;
        letter-spacing: 2px;
        margin-bottom: 60px;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    /* Carte de Profil Style Glassmorphism */
    .profile-card {
        display: flex;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        overflow: hidden;
        color: #333;
        margin-bottom: 40px;
        transition: transform 0.3s ease;
    }

    .profile-content { flex: 1.5; padding: 50px; }
    .profile-image-container { flex: 1; display: flex; align-items: center; justify-content: center; background: #f8f9fa; padding: 20px; }
    
    .info-details p { margin-bottom: 12px; font-size: 1.1rem; border-bottom: 1px dashed #ddd; padding-bottom: 5px; }
    .info-details span { font-weight: bold; color: #0a1f44; min-width: 120px; display: inline-block; }
    
    .current-role { background: #eef3fa; padding: 15px; border-left: 5px solid #0a1f44; margin-top: 20px; border-radius: 4px; }

    /* Timeline */
    .sub-title { color: #fff; border-bottom: 2px solid #ea9307; display: inline-block; padding-bottom: 10px; margin-bottom: 30px; }
    
    .custom-timeline { border-left: 3px solid #ea9307; padding-left: 20px; }
    .timeline-box { position: relative; margin-bottom: 30px; background: rgba(255,255,255,0.1); padding: 15px; border-radius: 8px; }
    .timeline-box::before { content: ''; position: absolute; left: -29px; top: 20px; width: 15px; height: 15px; background: #ea9307; border-radius: 50%; }
    
    .date-badge { font-weight: bold; color: #ea9307; display: block; margin-bottom: 5px; }

    /* Formation */
    .edu-item { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 12px; margin-bottom: 15px; border: 1px solid rgba(255,255,255,0.2); }
    .edu-item h5 { color: #ea9307; margin: 0; }

    /* Responsive */
    @media (max-width: 992px) {
        .profile-card { flex-direction: column-reverse; }
        .profile-content { padding: 30px; }
    }
</style>

<script>
    // Animation d'entrée simple au défilement
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.timeline-box, .edu-item').forEach(el => {
        el.style.opacity = "0";
        el.style.transform = "translateY(20px)";
        el.style.transition = "all 0.6s ease-out";
        observer.observe(el);
    });
</script>
@endsection