@extends('template')
@section('layout')

<section class="news-section">
    <div class="overlay-dark"></div>
    
    <div class="container relative-content">
        <h1 class="title-news">Actualités DGAMP </h1>
        
        <div class="search-wrapper">
            <div class="search-box">
                <input type="text" id="newsSearch" placeholder="Rechercher un article, un événement, une date...">
            </div>
        </div>

        <div class="news-grid" id="newsContainer">
            <article class="news-card">
                <div class="news-image">
                    <img src="assets/images/image14.jpeg" alt="Actualité 1">
                    <span class="news-date">Publié le : 11 Décembre 2025</span>
                </div>
                <div class="news-body">
                    <span class="news-category">RENCONTRE</span>
                    <h3 class="news-card-title"> Abidjan abrite un atelier sous-régional...</h3>
                    <p class="news-excerpt">Le Directeur de Cabinet du ministre délégué auprès du ministre des Transports, chargé des Affaires Maritimes,..</p>
                    <a href="#" class="btn-read-more">Lire la suite <span>→</span></a>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <img src="assets/images/image12.jpeg" alt="Actualité 2">
                    <span class="news-date">01 December 2025</span>
                </div>
                <div class="news-body">
                    <span class="news-category">FORMATION</span>
                    <h3 class="news-card-title">Abidjan accueille un atelier régional de...</h3>
                    <p class="news-excerpt">Un atelier régional de formation sur la mise en œuvre de la Convention internationale sur les normes...</p>
                    <a href="#" class="btn-read-more">Lire la suite <span>→</span></a>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <img src="assets/images/image38.jpeg"  alt="Actualité 3">
                    <span class="news-date">22 October 2025</span>
                </div>
                <div class="news-body">
                    <span class="news-category">SECURITE</span>
                    <h3 class="news-card-title">Sécurisation des plans d’eau en période...</h3>
                    <p class="news-excerpt">Cette mission s'inscrit dans le cadre de l'opération "DAUPHIN 1" dédiée à la sécurisation des plans...</p>
                    <a href="#" class="btn-read-more">Lire la suite <span>→</span></a>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <img src="assets/images/image101.jpeg" alt="Actualité 4">
                    <span class="news-date">04 June 2025</span>
                </div>
                <div class="news-body">
                    <span class="news-category">FORMATION</span>
                    <h3 class="news-card-title">Comité de la Coopération Technique...</h3>
                    <p class="news-excerpt">La Côte d'Ivoire participe à la soixante-quinzième (75ième) session du Comité de la Coopération...</p>
                    <a href="#" class="btn-read-more">Lire la suite <span>→</span></a>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <img src="assets/images/image102.jpeg" alt="Actualité 5">
                    <span class="news-date">30 April 2024</span>
                </div>
                <div class="news-body">
                    <span class="news-category">RENCONTRE</span>
                    <h3 class="news-card-title">Arrondissement Maritime d’Adiaké: Le Ministre...</h3>
                    <p class="news-excerpt">Le Ministre Délégué auprès du Ministre des Transports chargé des Affaires Maritimes, le Dr Serey Doh...</p>
                    <a href="#" class="btn-read-more">Lire la suite <span>→</span></a>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <img src="assets/images/image103.jpeg" alt="Actualité 6">
                    <span class="news-date"> 23 April 2025</span>
                </div>
                <div class="news-body">
                    <span class="news-category">COMMUNICATION</span>
                    <h3 class="news-card-title">COMMUNIQUE DE PRESSE RELATIF AU CHAVIREMENT...</h3>
                    <p class="news-excerpt">Une pirogue de pêche à moteur, utilisée comme engin de transport, à l'occasion d'un rassemblement religieux chrétien,...</p>
                    <a href="#" class="btn-read-more">Lire la suite <span>→</span></a>
                </div>
            </article>


        </div>

        <div id="noResults" style="display: none; padding: 50px; text-align: center; color: #fff; background: rgba(255,255,255,0.1); border-radius: 15px; backdrop-filter: blur(10px);">
            Aucune actualité ne correspond à votre recherche.
        </div>

        <div class="pagination-container">
            <div class="page-item" id="prevBtn">&laquo;</div>
            <div id="pageNumbers" style="display: flex; gap: 8px;"></div>
            <div class="page-item" id="nextBtn">&raquo;</div>
        </div>
    </div>
</section>

<style>
/* Base et Arrière-plan identique au modèle Documents */
.news-section {
    position: relative;
    padding: 100px 20px;
    min-height: 100vh;
    background: url("assets/images/image33.jpeg") no-repeat center center fixed;
    background-size: cover;
}

.overlay-dark {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.7) 100%);
    z-index: 1;
}

.relative-content { position: relative; z-index: 2; width: 100%; max-width: 1200px; margin: 0 auto; }

.title-news { 
    color: #ffffff; text-align: center; font-size: 3rem; margin-bottom: 40px; 
    font-weight: 800; text-transform: uppercase; letter-spacing: 3px;
}
.title-news span { color: #3b82c4; }

/* Barre de recherche (Modèle identique) */
.search-wrapper { width: 100%; max-width: 750px; margin: 0 auto 50px; }
.search-box {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    padding: 15px 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}
#newsSearch {
    width: 100%; background: transparent; border: none; outline: none;
    color: white; font-size: 1.1rem; text-align: center;
}
#newsSearch::placeholder { color: rgba(255, 255, 255, 0.5); }

/* Grille de cartes */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

.news-card {
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
}
.news-card:hover { transform: translateY(-10px); }

.news-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}
.news-image img { width: 100%; height: 100%; object-fit: cover; }

.news-date {
    position: absolute;
    bottom: 15px; left: 15px;
    background: #3b82c4;
    color: white;
    padding: 5px 12px;
    border-radius: 5px;
    font-size: 0.8rem;
    font-weight: 600;
}

.news-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }

.news-category {
    color: #3b82c4;
    text-transform: uppercase;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.news-card-title {
    color: #0b3c6d;
    font-size: 1.25rem;
    margin-bottom: 15px;
    line-height: 1.4;
    font-weight: 700;
}

.news-excerpt {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* ==========================================================================
   BOUTON "LIRE LA SUITE" - TRAIT SUPPRIMÉ DE FORCE (survol inclus)
   ========================================================================== */
a.btn-read-more,
a.btn-read-more:link,
a.btn-read-more:visited {
    margin-top: auto;
    color: #0b3c6d;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: color 0.3s, gap 0.3s;
    text-decoration: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
    outline: none !important;
    -webkit-tap-highlight-color: transparent !important;
}

a.btn-read-more:hover,
a.btn-read-more:focus,
a.btn-read-more:active {
    color: #3b82c4;
    gap: 12px;
    text-decoration: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Pagination (Modèle identique) */
.pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 50px; }
.page-item {
    width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
    border-radius: 10px; background: white; color: #333; font-weight: 700; 
    cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.page-item.active { background: #3b82c4; color: white; }
.page-item.disabled { opacity: 0.5; cursor: not-allowed; pointer-events: none; }
.page-item:hover:not(.active):not(.disabled) { background: #f0f0f0; }

/* Responsive */
@media (max-width: 768px) {
    .news-grid { grid-template-columns: 1fr; }
    .title-news { font-size: 2.2rem; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("newsContainer");
    const allArticles = Array.from(container.querySelectorAll(".news-card"));
    const searchInput = document.getElementById("newsSearch");
    const pageNumbers = document.getElementById("pageNumbers");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const noResults = document.getElementById("noResults");

    let itemsPerPage = 3; // On affiche 3 articles par page
    let currentPage = 1;
    let filteredArticles = allArticles;

    function displayNews() {
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        allArticles.forEach(art => art.style.display = "none");

        const articlesToDisplay = filteredArticles.slice(start, end);
        articlesToDisplay.forEach(art => art.style.display = "flex");

        noResults.style.display = filteredArticles.length === 0 ? "block" : "none";
        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredArticles.length / itemsPerPage);
        pageNumbers.innerHTML = "";

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("div");
            btn.className = `page-item ${i === currentPage ? 'active' : ''}`;
            btn.innerText = i;
            btn.onclick = () => {
                currentPage = i;
                displayNews();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };
            pageNumbers.appendChild(btn);
        }

        prevBtn.classList.toggle("disabled", currentPage === 1 || pageCount === 0);
        nextBtn.classList.toggle("disabled", currentPage === pageCount || pageCount === 0);
    }

    searchInput.addEventListener("input", function() {
        const val = this.value.toLowerCase();
        
        filteredArticles = allArticles.filter(art => 
            art.innerText.toLowerCase().includes(val)
        );

        currentPage = 1;
        displayNews();
    });

    prevBtn.onclick = () => { if(currentPage > 1) { currentPage--; displayNews(); } };
    nextBtn.onclick = () => { 
        const pageCount = Math.ceil(filteredArticles.length / itemsPerPage);
        if(currentPage < pageCount) { currentPage++; displayNews(); } 
    };

    displayNews();
});
</script>

@endsection