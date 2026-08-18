@extends('template')
@section('layout')

<section class="events-section">
    <div class="container">
        <h1 class="section-title">ARCHIVES DES ÉVENEMENTS PASSÉS</h1>
        <p class="section-subtitle">Retrouvez les moments forts et les activités marquantes de la DGAMP.</p>

        <div class="events-grid" id="eventsGrid">
            <div class="event-card" data-category="ceremonie">
                <div class="event-image">
                    <img src="assets/images/image46.jpeg" alt="Séminaire Maritime">
                    <div class="event-date">06 MARS 2026</div>
                </div>
                <div class="event-content">
                    <h3>Célébration de la journéé des femmes
                    </h3>
                    <p>Une rencontre stratégique réunissant les femmes du dommaine pour célébrer la journée marquante.</p>
                    <span class="event-tag">Ceremonie</span>
                </div>
            </div>

            <div class="event-card" data-category="visite">
                <div class="event-image">
                    <img src="assets/images/image42.jpeg" alt="Visite Officielle">
                    <div class="event-date">02 Sept 2025</div>
                </div>
                <div class="event-content">
                    <h3>Visite à la mairie de bassam</h3>
                    <p>Inspection des nouvelles infrastructures et échanges sur l'expansion du terminal à conteneurs.</p>
                    <span class="event-tag">Visite</span>
                </div>
            </div>

            <div class="event-card" data-category="formation">
                <div class="event-image">
                    <img src="assets/images/image45.jpeg" alt="Formation">
                    <div class="event-date">12 Juil 2025</div>
                </div>
                <div class="event-content">
                    <h3>Formation des Agents de Sûreté</h3>
                    <p>Clôture de la session de formation intensive sur la lutte contre la pollution maritime.</p>
                    <span class="event-tag">Formation</span>
                </div>
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
@endsection