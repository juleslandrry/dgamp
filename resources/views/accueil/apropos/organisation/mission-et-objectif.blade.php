@extends('template')
@section('layout')

<section class="mission-section">
    <div class="mission-overlay">
        <div class="container">
            <h1 class="mission-main-title">MISSIONS & OBJECTIFS</h1>

            <div class="mission-block">
                <h2 class="section-subtitle">Nos Missions</h2>
                <div class="mission-grid">
                    <div class="mission-card">
                        <div class="card-inner">
                            <div class="card-front"><h3>Politique Maritime</h3></div>
                            <div class="card-back"><p>Conduire la politique des transports maritimes et fluvio-lagunaires ;</p></div>
                        </div>
                    </div>
                    <div class="mission-card">
                        <div class="card-inner">
                            <div class="card-front"><h3>Sécurité</h3></div>
                            <div class="card-back"><p>Promouvoir la sécurité et la sureté maritime (navigation, pêche, port, domaines publics maritimes et lagunaires, plages, plateformes pétrolières off-shore) ;</p></div>
                        </div>
                    </div>
                    <div class="mission-card">
                        <div class="card-inner">
                            <div class="card-front"><h3>Gens de Mer</h3></div>
                            <div class="card-back"><p>Gestion du domaine public maritime et fluvio-lagunaire ;</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mission-block">
                <h2 class="section-subtitle">Nos Objectifs</h2>
                <div class="mission-grid">
                    <div class="mission-card">
                        <div class="card-inner">
                            <div class="card-front"><h3>Coopération</h3></div>
                            <div class="card-back"><p>Développer la coopération maritime régionale et internationale.</p></div>
                        </div>
                    </div>
                    <div class="mission-card">
                        <div class="card-inner">
                            <div class="card-front"><h3>Modernisation</h3></div>
                            <div class="card-back"><p>Moderniser les outils de surveillance et de contrôle des activités.</p></div>
                        </div>
                    </div>
                    <div class="mission-card">
                        <div class="card-inner">
                            <div class="card-front"><h3>Performance</h3></div>
                            <div class="card-back"><p>Optimiser la gestion des ports et des infrastructures fluviales.</p></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* --- FOND ET OVERLAY --- */
.mission-section {
    background: url("assets/images/image33.jpeg") no-repeat center center;
    background-size: cover;
    background-attachment: fixed;
    width: 100%;
}

.mission-overlay {
    background: rgba(0, 0, 0, 0.75);
    padding: 80px 0;
    width: 100%;
}

.mission-main-title {
    text-align: center;
    color: white;
    font-size: 38px;
    font-weight: 800;
    margin-bottom: 60px;
    text-transform: uppercase;
}

.mission-block {
    margin-bottom: 50px;
}

.section-subtitle {
    color: #ffffff;
    font-size: 24px;
    margin-bottom: 30px;
    border-left: 5px solid #ea9307;
    padding-left: 15px;
    font-weight: bold;
}

/* --- GRILLE ET CARTES --- */
.mission-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

.mission-card {
    perspective: 1000px;
    opacity: 0; /* Géré par JS */
    transform: translateY(30px); /* Géré par JS */
    transition: all 0.6s ease-out;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 200px;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    cursor: pointer;
}

.mission-card:hover .card-inner {
    transform: rotateY(180deg);
}

.card-front, .card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
}

.card-front {
    background: white;
    color: #0a1f44;
    font-size: 22px;
    font-weight: bold;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.card-back {
    background: #0a1f44;
    color: white;
    transform: rotateY(180deg);
    font-size: 16px;
    line-height: 1.5;
}

/* --- VISIBILITÉ FORCÉE PAR JS --- */
.mission-card.reveal {
    opacity: 1 !important;
    transform: translateY(0) !important;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".mission-card");

    const scrollReveal = () => {
        cards.forEach(card => {
            const cardTop = card.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (cardTop < windowHeight - 50) {
                card.classList.add("reveal");
            }
        });
    };

    // Lancer une fois au chargement
    scrollReveal();
    // Lancer au scroll
    window.addEventListener("scroll", scrollReveal);
});
</script>

@endsection