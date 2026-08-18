@extends('template')
@section('layout')

<section class="events-section">
    <div class="overlay-dark"></div>
    
    <div class="container relative-content">
        <h1 class="title-events">ÉVÉNEMENTS À VENIR</h1>

        <div class="filter-controls">
            <button class="filter-btn active" data-filter="all">Tous</button>
            <button class="filter-btn" data-filter="conference">Conférences</button>
            <button class="filter-btn" data-filter="formation">Formations</button>
            <button class="filter-btn" data-filter="ceremonie">Cérémonies</button>
        </div>

        <div class="events-grid" id="eventsGrid">
            <div class="event-card" data-category="conference">
                <div class="event-date">
                    <span class="day">15</span>
                    <span class="month">Avril</span>
                </div>
                <div class="event-body">
                    <span class="category-tag">Conférence</span>
                    <h3>Sécurité Maritime 2026</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Port Autonome d'Abidjan</p>
                    <p><i class="far fa-clock"></i> 09h00 - 17h00</p>
                    <a href="#" class="btn-more">Détails</a>
                </div>
            </div>

            <div class="event-card" data-category="formation">
                <div class="event-date">
                    <span class="day">22</span>
                    <span class="month">Avril</span>
                </div>
                <div class="event-body">
                    <span class="category-tag">Formation</span>
                    <h3>Séminaire Code ISPS</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Salle de conférence DGAM</p>
                    <p><i class="far fa-clock"></i> 08h30 - 13h00</p>
                    <a href="#" class="btn-more">Détails</a>
                </div>
            </div>

            <div class="event-card" data-category="ceremonie">
                <div class="event-date">
                    <span class="day">05</span>
                    <span class="month">Mai</span>
                </div>
                <div class="event-body">
                    <span class="category-tag">Cérémonie</span>
                    <h3>Remise de Galons</h3>
                    <p><i class="fas fa-map-marker-alt"></i> École Maritime</p>
                    <p><i class="far fa-clock"></i> 10h00</p>
                    <a href="#" class="btn-more">Détails</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ==========================================================================
   CORRECTION POUR LE BOUTON TÉLÉCHARGER (PROVENANT DU TEMPLATE)
   ========================================================================== */
[class*="download"], [class*="telecharg"], a[href*="download"], .btn-download {
    text-decoration: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
    outline: none !important;
}

[class*="download"]:hover, [class*="telecharg"]:hover, a[href*="download"]:hover, .btn-download:hover {
    text-decoration: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
}

[class*="download"]:focus, [class*="telecharg"]:focus, [class*="download"]:active, [class*="telecharg"]:active {
    outline: none !important;
    box-shadow: none !important;
    background-image: none !important;
}

/* ==========================================================================
   RESTE DE TES STYLES DE LA VUE
   ========================================================================== */
.events-section {
    position: relative;
    padding: 100px 0;
    min-height: 100vh;
    background: url("assets/images/image33.jpeg") no-repeat center center fixed;
    background-size: cover;
}

.overlay-dark {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.65);
    z-index: 1;
}

.relative-content { position: relative; z-index: 2; }

.title-events {
    color: white;
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 50px;
    font-weight: 800;
}

/* Filtres */
.filter-controls {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 40px;
}

.filter-btn {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    padding: 10px 25px;
    border-radius: 30px;
    cursor: pointer;
    transition: 0.3s;
}

.filter-btn.active, .filter-btn:hover {
    background: #3b82c4;
    border-color: #3b82c4;
}

/* Grille et Cartes */
.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.event-card {
    background: white;
    display: flex;
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}

.event-date {
    background: #0b3c6d;
    color: white;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 90px;
}

.event-date .day { font-size: 1.8rem; font-weight: bold; }
.event-date .month { font-size: 0.9rem; text-transform: uppercase; }

.event-body { padding: 25px; flex-grow: 1; }
.category-tag {
    background: #eef3fa;
    color: #3b82c4;
    font-size: 0.75rem;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 10px;
}

.event-body h3 { color: #0a1f44; margin-bottom: 15px; font-size: 1.25rem; }
.event-body p { margin-bottom: 8px; color: #666; font-size: 0.9rem; }
.event-body i { color: #3b82c4; margin-right: 8px; }

/* ==========================================================================
   BOUTON "DÉTAILS" - TRAIT SUPPRIMÉ DE FORCE (survol inclus)
   ========================================================================== */
.btn-more,
.btn-more:link,
.btn-more:visited {
    display: inline-block;
    margin-top: 15px;
    color: #0b3c6d;
    font-weight: bold;
    text-decoration: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
    outline: none !important;
    transition: color 0.3s;
}

.btn-more:hover,
.btn-more:focus,
.btn-more:active {
    color: #3b82c4;
    text-decoration: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
    outline: none !important;
    -webkit-tap-highlight-color: transparent;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const filterBtns = document.querySelectorAll(".filter-btn");
    const eventCards = document.querySelectorAll(".event-card");

    filterBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelector(".filter-btn.active").classList.remove("active");
            btn.classList.add("active");

            const filter = btn.dataset.filter;

            eventCards.forEach(card => {
                if (filter === "all" || card.dataset.category === filter) {
                    card.style.display = "flex";
                    card.style.animation = "fadeIn 0.5s ease forwards";
                } else {
                    card.style.display = "none";
                }
            });
        });
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
</style>

@endsection