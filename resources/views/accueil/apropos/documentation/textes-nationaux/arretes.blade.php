@extends('template')
@section('layout')

<section class="documents-section">
    {{-- Couche d'opacité --}}
    <div class="overlay"></div>

    <div class="container">
        <h1 class="title-doc"> Arrêté De Decision DGAM</h1>

        <div class="search-wrapper-center">
            <div class="search-container-doc">
                <input type="text" id="arrestSearch" placeholder="Rechercher un arrêté, une date ou une référence...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="doc-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Téléchargement</th>
                    </tr>
                </thead>

                <tbody id="arrestBody">
                    @forelse($arretes as $arrete)
                        <tr class="doc-row" data-search="{{ strtolower($arrete->titre . ' ' . $arrete->mots_cles . ' ' . $arrete->description) }}">
                            <td><strong>{{ $arrete->titre }}</strong></td>
                            <td>{{ $arrete->description }}</td>
                            <td>
                                @if($arrete->fichier_path)
                                    <a href="{{ asset('storage/' . $arrete->fichier_path) }}" download class="btn-download" target="_blank">
                                        📥 Télécharger
                                    </a>
                                @else
                                    <span style="color: #888; font-size: 13px;">Aucun fichier</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 20px; color: #666;">
                                Aucun arrêté disponible pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="noResults" style="display: none; padding: 30px; text-align: center; background: white; color: #666;">
                Aucun arrêté trouvé.
            </div>
        </div>

        <div class="pagination-container" id="paginationWrapper">
            <div class="page-item" id="prevBtn">&laquo;</div>
            <div id="pageNumbers" style="display: flex; gap: 8px;"></div>
            <div class="page-item" id="nextBtn">&raquo;</div>
        </div>
    </div>
</section>

<style>
/* --- STYLES DE BASE --- */
.documents-section {
    position: relative;
    padding: 90px 0;
    background: url("assets/images/image33.jpeg") center/cover no-repeat fixed;
    min-height: 80vh;
}
.overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.65); z-index: 1; }
.container { position: relative; width: 90%; max-width: 1100px; margin: auto; z-index: 2; }
.title-doc { text-align: center; font-size: 36px; font-weight: bold; margin-bottom: 35px; color: white; }

/* --- CENTRAGE BARRE DE RECHERCHE --- */
.search-wrapper-center {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 40px;
}

.search-container-doc {
    width: 100%;
    max-width: 550px;
}

#arrestSearch {
    width: 100%;
    padding: 15px 25px;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: white;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
    text-align: center;
}

#arrestSearch:focus { background: rgba(255, 255, 255, 0.25); border-color: #3b82c4; }
#arrestSearch::placeholder { color: rgba(255, 255, 255, 0.7); }

/* --- RESTE DU DESIGN --- */
.table-responsive { border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.3); }
.doc-table { width: 100%; border-collapse: collapse; background: rgba(255, 255, 255, 0.98); }
.doc-table thead { background: #3b82c4; color: white; }
.doc-table th, .doc-table td { padding: 20px; text-align: left; }
.doc-table td { border-bottom: 1px solid #eee; color: #333; }
.doc-row:hover { background: #f3f7fd; transform: scale(1.005); transition: 0.3s ease; }

.btn-download {
    background: #0b3c6d;
    color: white;
    padding: 10px 22px;
    border-radius: 6px;
    text-decoration: none !important;
    border-bottom: none !important;
    font-weight: 600;
    display: inline-block;
}
.btn-download:hover,
.btn-download:focus,
.btn-download:active {
    background: #0b3c6d;
    text-decoration: none !important;
    border-bottom: none !important;
    transform: none;
}

/* PAGINATION */
.pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
.page-item { width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 10px; background: white; color: #333; font-weight: 700; cursor: pointer; transition: 0.3s; }
.page-item.active { background: #007bff; color: white; }
.page-item.disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("arrestBody");
    const allRows = Array.from(tableBody.querySelectorAll(".doc-row"));
    const searchInput = document.getElementById("arrestSearch");
    const pageNumbers = document.getElementById("pageNumbers");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const noResults = document.getElementById("noResults");

    let rowsPerPage = 5;
    let currentPage = 1;
    let filteredRows = allRows;

    function displayRows() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        allRows.forEach(row => row.style.display = "none");
        const rowsToDisplay = filteredRows.slice(start, end);
        
        rowsToDisplay.forEach((row, i) => {
            row.style.display = "table-row";
            row.style.opacity = "0";
            row.style.transform = "translateY(20px)";
            setTimeout(() => {
                row.style.transition = "0.5s ease-out";
                row.style.opacity = "1";
                row.style.transform = "translateY(0)";
            }, 50 * i);
        });
        noResults.style.display = (filteredRows.length === 0 && allRows.length > 0) ? "block" : "none";
        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        pageNumbers.innerHTML = "";
        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("div");
            btn.className = `page-item ${i === currentPage ? 'active' : ''}`;
            btn.innerText = i;
            btn.onclick = () => { currentPage = i; displayRows(); };
            pageNumbers.appendChild(btn);
        }
        prevBtn.classList.toggle("disabled", currentPage === 1 || pageCount === 0);
        nextBtn.classList.toggle("disabled", currentPage === pageCount || pageCount === 0);
    }

    searchInput.addEventListener("input", function() {
        const query = this.value.toLowerCase();
        filteredRows = allRows.filter(row => {
            const searchData = (row.getAttribute("data-search") || "").toLowerCase();
            const visibleText = row.innerText.toLowerCase();
            return searchData.includes(query) || visibleText.includes(query);
        });
        currentPage = 1;
        displayRows();
    });

    prevBtn.onclick = () => { if(currentPage > 1) { currentPage--; displayRows(); } };
    nextBtn.onclick = () => { 
        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        if(currentPage < pageCount) { currentPage++; displayRows(); } 
    };

    displayRows();
});
</script>

@endsection