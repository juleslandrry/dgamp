@extends('template')
@section('layout')

<section class="news-section">
    <div class="overlay-dark"></div>
    
    <div class="container relative-content">
        <h1 class="title-news">Actualités DGAMP</h1>
        
        <div class="search-wrapper">
            <div class="search-box">
                <input type="text" id="newsSearch" placeholder="Rechercher un article, un événement, une date...">
            </div>
        </div>

        {{-- Grille Dynamique des Actualités --}}
        <div class="news-grid" id="newsContainer">
            @forelse($actualites as $art)
                <article class="news-card">
                    <div class="news-image">
                        <img src="{{ $art->image_path ? asset('storage/' . $art->image_path) : 'assets/images/default-news.jpeg' }}" alt="{{ $art->titre }}">
                        <span class="news-date">
                            Publié le : {{ $art->date_publication ? \Carbon\Carbon::parse($art->date_publication)->format('d/m/Y') : 'Récemment' }}
                        </span>
                    </div>
                    <div class="news-body">
                        <span class="news-category">{{ $art->categorie ?? 'ACTUALITÉ' }}</span>
                        <h3 class="news-card-title">{{ $art->titre }}</h3>
                        
                        {{-- Extrait généré automatiquement depuis la description nettoyée du HTML --}}
                        <p class="news-excerpt">
                            {{ Str::limit(strip_tags($art->description), 120, '...') }}
                        </p>
                        
                        {{-- Bouton ouvrant la modale --}}
                        <button type="button" class="btn-read-more" onclick='openNewsModal(@json($art))'>
                            Lire la suite <span>→</span>
                        </button>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: #fff; padding: 50px; background: rgba(255,255,255,0.1); border-radius: 15px;">
                    Aucune actualité disponible pour le moment.
                </div>
            @endforelse
        </div>

        <div id="noResults" style="display: none; padding: 50px; text-align: center; color: #fff; background: rgba(255,255,255,0.1); border-radius: 15px; backdrop-filter: blur(10px); margin-top: 20px;">
            Aucune actualité ne correspond à votre recherche.
        </div>

        <div class="pagination-container">
            <div class="page-item" id="prevBtn">&laquo;</div>
            <div id="pageNumbers" style="display: flex; gap: 8px;"></div>
            <div class="page-item" id="nextBtn">&raquo;</div>
        </div>
    </div>
</section>

{{-- MODALE LECTURE ACTUALITÉ --}}
<div class="news-modal-overlay" id="newsModal" onclick="closeNewsModalOnOverlay(event)">
    <div class="news-modal-card">
        <button class="news-modal-close" onclick="closeNewsModal()">&times;</button>
        
        <div class="news-modal-header-img" id="modalImageContainer">
            <img id="modalImg" src="" alt="Actualité">
            <span class="news-modal-date" id="modalDate"></span>
        </div>

        <div class="news-modal-body">
            <span class="news-category" id="modalCategory"></span>
            <h2 class="news-modal-title" id="modalTitle"></h2>
            <hr class="news-modal-divider">
            
            {{-- Le contenu rich-text HTML issu de CKEditor sera injecté ici --}}
            <div class="news-modal-description ck-content" id="modalDescription"></div>
        </div>
    </div>
</div>

<style>
/* Base et Arrière-plan */
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

/* Recherche */
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

/* Grille */
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

/* Bouton "Lire la suite" */
button.btn-read-more {
    margin-top: auto;
    color: #0b3c6d;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: color 0.3s, gap 0.3s;
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    font-size: 0.95rem;
}
button.btn-read-more:hover { color: #3b82c4; gap: 12px; }

/* Pagination */
.pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 50px; }
.page-item {
    width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
    border-radius: 10px; background: white; color: #333; font-weight: 700; 
    cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.page-item.active { background: #3b82c4; color: white; }
.page-item.disabled { opacity: 0.5; cursor: not-allowed; pointer-events: none; }
.page-item:hover:not(.active):not(.disabled) { background: #f0f0f0; }

/* ==========================================================================
   STYLES DE LA MODALE PUBLIC
   ========================================================================== */
.news-modal-overlay {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(11, 35, 64, 0.75);
    backdrop-filter: blur(6px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.news-modal-overlay.active {
    display: flex;
    opacity: 1;
}

.news-modal-card {
    background: #ffffff;
    border-radius: 20px;
    width: 100%;
    max-width: 750px;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
    animation: modalSlideUp 0.3s ease-out;
}

@keyframes modalSlideUp {
    from { transform: translateY(30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.news-modal-close {
    position: absolute;
    top: 15px; right: 20px;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    width: 36px; height: 36px;
    border-radius: 50%;
    font-size: 22px;
    cursor: pointer;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.news-modal-close:hover { background: rgba(0, 0, 0, 0.8); }

.news-modal-header-img {
    position: relative;
    width: 100%;
    height: 320px;
    background: #f0f0f0;
}
.news-modal-header-img img {
    width: 100%; height: 100%; object-fit: cover;
}

.news-modal-date {
    position: absolute;
    bottom: 15px; left: 20px;
    background: #3b82c4;
    color: #fff;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
}

.news-modal-body {
    padding: 30px;
}

.news-modal-title {
    color: #0b3c6d;
    font-size: 1.6rem;
    font-weight: 800;
    margin: 8px 0 16px;
    line-height: 1.3;
}

.news-modal-divider {
    border: none;
    border-top: 2px solid #e7e2d6;
    margin: 16px 0 20px;
}

.news-modal-description {
    color: #333;
    font-size: 1.05rem;
    line-height: 1.7;
}

.news-modal-description p { margin-bottom: 14px; }
.news-modal-description ul, .news-modal-description ol { margin-left: 20px; margin-bottom: 14px; }

/* Responsive */
@media (max-width: 768px) {
    .news-grid { grid-template-columns: 1fr; }
    .title-news { font-size: 2.2rem; }
    .news-modal-header-img { height: 220px; }
    .news-modal-body { padding: 20px; }
    .news-modal-title { font-size: 1.3rem; }
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

    let itemsPerPage = 6;
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

        if (pageCount <= 1) {
            prevBtn.style.display = "none";
            nextBtn.style.display = "none";
            return;
        } else {
            prevBtn.style.display = "flex";
            nextBtn.style.display = "flex";
        }

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

        prevBtn.classList.toggle("disabled", currentPage === 1);
        nextBtn.classList.toggle("disabled", currentPage === pageCount);
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

/* Fonctions pour la Modale */
function openNewsModal(art) {
    const modal = document.getElementById('newsModal');
    const imgContainer = document.getElementById('modalImageContainer');
    const img = document.getElementById('modalImg');
    const category = document.getElementById('modalCategory');
    const date = document.getElementById('modalDate');
    const title = document.getElementById('modalTitle');
    const description = document.getElementById('modalDescription');

    if (art.image_path) {
        img.src = '/storage/' + art.image_path;
        imgContainer.style.display = 'block';
    } else {
        imgContainer.style.display = 'none';
    }

    category.innerText = art.categorie ? art.categorie.toUpperCase() : 'ACTUALITÉ';
    date.innerText = art.date_publication ? 'Publié le : ' + formatDate(art.date_publication) : '';
    title.innerText = art.titre;
    
    // Inscription du HTML de CKEditor
    description.innerHTML = art.description || '';

    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; // Bloque le scroll arrière-plan
}

function closeNewsModal() {
    const modal = document.getElementById('newsModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

function closeNewsModalOnOverlay(event) {
    if (event.target.id === 'newsModal') {
        closeNewsModal();
    }
}

function formatDate(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    if (isNaN(date.getTime())) return dateStr;
    return date.toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit', year: 'numeric' });
}
</script>

@endsection