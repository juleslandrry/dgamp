@extends('template')
@section('layout')

<section class="events-section">
    <div class="container">
        <h1 class="section-title">ARCHIVES DES ÉVENEMENTS PASSÉS</h1>
        <p class="section-subtitle">Retrouvez les moments forts et les activités marquantes de la DGAMP.</p>

                        <div class="events-grid" id="eventsGrid">
            @foreach($evenements as $ev)
                <div class="event-card" data-category="{{ $ev->categorie }}">
                    <div class="event-image">
                        <img src="{{ asset($ev->image) }}" alt="{{ $ev->titre }}">
                        <div class="event-date">{{ $ev->date_affichee }}</div>
                    </div>
                    <div class="event-content">
                        <h3>{{ $ev->titre }}</h3>
                        <p>{{ $ev->description }}</p>
                        <span class="event-tag">{{ $ev->tag }}</span>
                        @if($ev->details)
                            <br>
                            <a href="#" class="btn-more-passe btn-details-trigger" data-titre="{{ $ev->titre }}" data-details="{{ $ev->details }}">Voir plus</a>
                        @endif
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
.events-section {
    padding: 80px 0;
    background-color: #f8fafc;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
}

.section-title {
    text-align: center;
    font-size: 32px;
    color: #0b1c39;
    font-weight: 800;
    margin-bottom: 10px;
}

.section-subtitle {
    text-align: center;
    color: #64748b;
    margin-bottom: 50px;
}

/* Grille Responsive */
.events-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

/* Style des Cartes */
.event-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    cursor: pointer;
    border: 1px solid #f1f5f9;
}

.event-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

/* Image et Date Overlay */
.event-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s;
}

.event-card:hover .event-image img {
    transform: scale(1.1);
}

.event-date {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: #0b1c39;
    color: white;
    padding: 5px 15px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
}

/* Contenu texte */
.event-content {
    padding: 25px;
}

.event-content h3 {
    font-size: 20px;
    color: #0b1c39;
    margin-bottom: 12px;
    line-height: 1.4;
}

.event-content p {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 20px;
}

.event-tag {
    display: inline-block;
    padding: 4px 12px;
    background: #e2e8f0;
    color: #475569;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

@media (max-width: 768px) {
    .events-grid { grid-template-columns: 1fr; }
}
.btn-more-passe {
    display: inline-block;
    margin-top: 10px;
    color: #0b1c39;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
}
.btn-more-passe:hover { color: #64748b; }

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
    color: #0b1c39;
}
.event-details-close:hover { background: #dce6f3; }
#eventDetailsTitle { color: #0b1c39; margin-bottom: 15px; }
#eventDetailsBody { color: #444; line-height: 1.7; white-space: pre-line; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".event-card");

    // Options pour l'observateur (se déclenche quand 10% de la carte est visible)
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const eventObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Petit délai entre chaque carte pour un effet "cascade"
                setTimeout(() => {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }, index * 100); 
                
                observer.unobserve(entry.target); // On arrête d'observer une fois animé
            }
        });
    }, observerOptions);

    // Initialisation de l'état des cartes avant animation
    cards.forEach(card => {
        card.style.opacity = "0";
        card.style.transform = "translateY(40px)";
        card.style.transition = "all 0.8s cubic-bezier(0.2, 1, 0.2, 1)";
        eventObserver.observe(card);
    });
});
</script>
<script>
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
@endsection