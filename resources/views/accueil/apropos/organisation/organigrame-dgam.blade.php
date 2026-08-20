@extends('template')
@section('layout')

<section class="organigramme-section">
    <div class="container-fluid">
        <h1 class="title" style="color:white">Structure De Gourvernance DGAMP</h1>

        <div class="org-chart">

            @if($organigramme)

                <ul>
                    <li>

                        {{-- Directeur général --}}
                        <div class="box directeur">
                            {{ $organigramme->directeur_titre }}
                        </div>

                        {{-- Directions --}}
                        @if($organigramme->nodes->count())

                            <ul>

                                @foreach($organigramme->nodes as $direction)

                                    <li>

                                        <div class="box dpt">
                                            {{ $direction->nom }}
                                        </div>

                                        {{-- Services de la direction --}}
                                        @if($direction->enfants->count())

                                            <ul>

                                                @foreach($direction->enfants as $service)

                                                    <li>
                                                        <div class="box service">
                                                            {{ $service->nom }}
                                                        </div>
                                                    </li>

                                                @endforeach

                                            </ul>

                                        @endif

                                    </li>

                                @endforeach

                            </ul>

                        @endif

                    </li>
                </ul>

            @else

                <p style="color:white;">
                    L'organigramme n'est pas encore disponible.
                </p>

            @endif

        </div>
    </div>
</section>

<section class="pdf-section">
    <div class="container">
        <h2 class="title">Portail des Ressources Réglementaires</h2>
        <div class="pdf-list">

            {{-- Décret --}}
            @if($organigramme && $organigramme->decret_pdf)

                <div class="pdf-item">

                    <p>
                        Décret organisation DGAMP
                    </p>

                    <a
                        href="{{ asset('storage/' . $organigramme->decret_pdf) }}"
                        class="btn-pdf"
                        target="_blank"
                    >
                        Voir le PDF
                    </a>

                </div>

            @endif


            {{-- Organigramme --}}
            @if($organigramme && $organigramme->organigramme_pdf)

                <div class="pdf-item">

                    <p>
                        Organigramme complet
                    </p>

                    <a
                        href="{{ asset('storage/' . $organigramme->organigramme_pdf) }}"
                        class="btn-pdf"
                        target="_blank"
                    >
                        Télécharger
                    </a>

                </div>

            @endif


            {{-- Aucun document --}}
            @if(
                !$organigramme ||
                (
                    !$organigramme->decret_pdf &&
                    !$organigramme->organigramme_pdf
                )
            )

                <p>
                    Aucun document disponible pour le moment.
                </p>

            @endif

        </div>
    </div>
</section>

<style>
/* --- FOND ET TITRES --- */
.organigramme-section {
    padding: 80px 20px;
    text-align: center;
    background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.5)), 
                      url("assets/images/image33.jpeg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.title {
    font-size: 32px;
    margin-bottom: 50px;
    color: #003366; /* Couleur plus pro pour les titres */
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* --- STRUCTURE DE L'ORGANIGRAMME --- */
.org-chart ul {
    padding-top: 20px; 
    position: relative;
    display: flex;
    justify-content: center;
}

.org-chart li {
    float: left; 
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
}

/* Lignes de connexion */
.org-chart li::before, .org-chart li::after {
    content: '';
    position: absolute; top: 0; right: 50%;
    border-top: 2px solid #ccc;
    width: 50%; height: 20px;
}
.org-chart li::after {
    right: auto; left: 50%;
    border-left: 2px solid #ccc;
}
.org-chart li:only-child::after, .org-chart li:only-child::before { display: none; }
.org-chart li:only-child { padding-top: 0; }
.org-chart li:first-child::before, .org-chart li:last-child::after { border: 0 none; }
.org-chart li:last-child::before { border-right: 2px solid #ccc; border-radius: 0 5px 0 0; }
.org-chart li:first-child::after { border-radius: 5px 0 0 0; }
.org-chart ul ul::before {
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 2px solid #ccc;
    width: 0; height: 20px;
}

/* Style des boites */
.box {
    padding: 15px 20px;
    color: white;
    background: #4f85d6;
    border-radius: 8px;
    font-weight: bold;
    min-width: 150px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.directeur { background: #003366 !important; font-size: 18px; }

/* --- SECTION PDF --- */
.pdf-section {
    padding: 80px;
    background: #f8f9fa;
    text-align: center;
}

.pdf-list {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 40px;
    flex-wrap: wrap;
}

.pdf-item {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    width: 260px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}

.btn-pdf {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 25px;
    background: #4f85d6;
    color: white;
    text-decoration: none !important;
    border: none;
    border-bottom: none !important;
    box-shadow: none;
    border-radius: 30px;
    font-weight: bold;
}

.btn-pdf:hover,
.btn-pdf:focus,
.btn-pdf:active {
    text-decoration: none !important;
    border-bottom: none !important;
}

</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Animation d'apparition des boîtes une par une
    const boxes = document.querySelectorAll('.box');
    
    boxes.forEach((box, index) => {
        box.style.opacity = "0";
        box.style.transform = "translateY(20px)";
        box.style.transition = "all 0.6s ease-out";
        
        setTimeout(() => {
            box.style.opacity = "1";
            box.style.transform = "translateY(0)";
        }, 150 * index);
    });

    // Effet de parallaxe sur l'image de fond au défilement
    window.addEventListener('scroll', () => {
        const section = document.querySelector('.organigramme-section');
        let offset = window.pageYOffset;
        section.style.backgroundPositionY = (offset * 0.4) + "px";
    });
});
</script>

@endsection