@extends('template')
@section('layout')

<section class="documents-section">
    {{-- Couche d'opacité ajoutée pour la lisibilité --}}
    <div class="overlay-dark"></div>
    
    <div class="container relative-content">
        <h1 class="title-doc"><strong> Convention DGAM </strong></h1>
        
        <div class="search-wrapper-center">
            <div class="search-container">
                <input type="text" id="docSearch" placeholder="Rechercher une convention (ex: MARPOL, SOLAS)...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="doc-table">
                <thead>
                    <tr>
                        <th>Titre du Document</th>
                        <th>Description</th>
                        <th>Format</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="decreeBody">
                    @forelse($conventions as $conv)
                        <tr class="doc-row" data-search="{{ strtolower($conv->titre . ' ' . $conv->description . ' ' . $conv->mots_cles) }}">
                            <td><strong>{{ $conv->titre }}</strong></td>
                            <td>{{ $conv->description }}</td>
                            <td>
                                @if($conv->fichier_path)
                                    <a href="{{ asset('storage/' . $conv->fichier_path) }}" download class="btn-download" target="_blank">
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
                                Aucune convention disponible pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Message si recherche vide --}}
            <div id="noResults" style="display: none; padding: 30px; text-align: center; background: white; color: #666;">
                Aucune convention trouvée.
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
/* Tes styles existants préservés */
.documents-section {
    position: relative;
    padding: 100px 20px;
    min-height: 100vh;
    background: url("assets/images/image33.jpeg") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    align-items: center;
}
.overlay-dark {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0.65) 100%);
    z-index: 1;
}
.relative-content { position: relative; z-index: 2; width: 100%; max-width: 1100px; margin: 0 auto; }
.title-doc { color: #ffffff; text-align: center; font-size: 2.5rem; margin-bottom: 40px; }

/* Centrage de la recherche */
.search-wrapper-center { display: flex; justify-content: center; width: 100%; margin-bottom: 30px; }
.search-container { width: 100%; max-width: 600px; }

#docSearch {
    width: 100%; padding: 15px 25px;
    border-radius: 50px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
    color: white; border: 1px solid rgba(255,255,255,0.2); outline: none; text-align: center;
}
#docSearch::placeholder { color: rgba(255, 255, 255, 0.7); }

.table-responsive { background: rgba(255, 255, 255, 0.95); border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
.doc-table { width: 100%; border-collapse: collapse; }
.doc-table thead { background: #3b82c4; color: white; }
.doc-table th, .doc-table td { padding: 20px; text-align: left; }
.doc-row:hover { background: #f8fafc; transform: scale(1.002); transition: 0.3s; }

.btn-download {
    background: #0b3c6d;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none !important;
    border-bottom: none !important;
    cursor: pointer;
    display: inline-block;
    font-weight: 600;
}
.btn-download:hover,
.btn-download:focus,
.btn-download:active {
    background: #0b3c6d;
    text-decoration: none !important;
    border-bottom: none !important;
    transform: none;
}

.badge-pdf { background: #ffeded; color: #e11d48; padding: 4px 8px; border-radius: 4px; font-weight: bold; }
.text-right { text-align: right; }

/* STYLE DE LA NOUVELLE PAGINATION */
.pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
.page-item {
    width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
    border-radius: 10px; background: white; color: #333; font-weight: 700; cursor: pointer; transition: 0.3s;
}
.page-item.active { background: #3b82c4; color: white; }
.page-item.disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("docBody");
    const allRows = Array.from(tableBody.querySelectorAll(".doc-row"));
    const searchInput = document.getElementById("docSearch");
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
            row.style.transform = "translateY(15px)";
            setTimeout(() => {
                row.style.transition = "0.4s ease-out";
                row.style.opacity = "1";
                row.style.transform = "translateY(0)";
            }, 50 * i);
        });

        noResults.style.display = filteredRows.length === 0 ? "block" : "none";
        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
        pageNumbers.innerHTML = "";

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("div");
            btn.className = `page-item ${i === currentPage ? 'active' : ''}`;
            btn.innerText = i;
            btn.onclick = () => {
                currentPage = i;
                displayRows();
            };
            pageNumbers.appendChild(btn);
        }

        prevBtn.classList.toggle("disabled", currentPage === 1 || pageCount === 0);
        nextBtn.classList.toggle("disabled", currentPage === pageCount || pageCount === 0);
    }

    searchInput.addEventListener("input", function() {
        const query = this.value.toLowerCase();
        
        filteredRows = allRows.filter(row => {
            return row.innerText.toLowerCase().includes(query);
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