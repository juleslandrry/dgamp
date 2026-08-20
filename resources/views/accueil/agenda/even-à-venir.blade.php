@extends('template')
@section('layout')

<section class="events-section">
    <div class="overlay-dark"></div>
    
    <div class="container relative-content">
        <h1 class="title-events">ÉVÉNEMENTS À VENIR</h1>
        <div class="filter-controls">
            <button class="filter-btn active" data-filter="all">Tous</button>
            @foreach($categories as $cat)
                <button class="filter-btn" data-filter="{{ $cat['categorie'] }}">{{ $cat['tag'] }}</button>
            @endforeach
        </div>

                <div class="events-grid" id="eventsGrid">
            @foreach($evenements as $ev)
                <div class="event-card" data-category="{{ $ev->categorie }}">
                    <div class="event-date">
                        <span class="day">{{ $ev->jour_affiche }}</span>
                        <span class="month">{{ $ev->mois_affiche }}</span>
                    </div>
                    <div class="event-body">
                        <span class="category-tag">{{ $ev->tag }}</span>
                        <h3>{{ $ev->titre }}</h3>
                        <p><i class="fas fa-map-marker-alt"></i> {{ $ev->lieu }}</p>
                        <p><i class="far fa-clock"></i> {{ $ev->horaire_affiche }}</p>
                        <a href="#" class="btn-more btn-details-trigger" data-titre="{{ $ev->titre }}" data-details="{{ $ev->details }}">Détails</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="eventDetailsModal" class="event-details-modal">
            <div class="event-details-box">
                <button class="event-details-close" onclick="fermerDetailsEvenement()">&times;</button>
                <h3 id="eventDetailsTitle"></h3>
                <div id="eventDetailsBody"></div>
            </div>
        </div>
        
    </div>
</section>

<style>
    .event-details-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.7);
    z-index: 999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.event-details-modal.is-open { display: flex; }
.event-details-box {
    background: #fff;
    border-radius: 14px;
    padding: 30px;
    max-width: 600px;
    width: 100%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
}
.event-details-close {
    position: absolute;
    top: 14px; right: 14px;
    background: #eef3fa;
    border: none;
    width: 32px; height: 32px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    color: #0b3c6d;
}
.event-details-close:hover { background: #dce6f3; }
#eventDetailsTitle { color: #0a1f44; margin-bottom: 15px; }
#eventDetailsBody { color: #444; line-height: 1.7; white-space: pre-line; }
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
document.addEventListener('click', function(e) {
    const trigger = e.target.closest('.btn-details-trigger');
    if (trigger) {
        e.preventDefault();
        document.getElementById('eventDetailsTitle').textContent = trigger.dataset.titre;
        document.getElementById('eventDetailsBody').textContent = trigger.dataset.details || "Aucun détail supplémentaire pour cet événement.";
        document.getElementById('eventDetailsModal').classList.add('is-open');
    }
    if (e.target.id === 'eventDetailsModal') {
        fermerDetailsEvenement();
    }
});
function fermerDetailsEvenement() {
    document.getElementById('eventDetailsModal').classList.remove('is-open');
}
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}
</style>

@endsection