@extends('template')
@section('layout')
<section class="laws-section">
    {{-- Couche d'opacité ajoutée pour la lisibilité --}}
    <div class="background-overlay-law"></div>
    
    <div class="container main-content-law">
        <h1 class="title-law">Lois Et Règlement DGAM</h1>

        <div class="search-wrapper-center">
            <div class="search-container-law">
                <input type="text" id="lawSearch" placeholder="Rechercher une loi ou un code...">
            </div>
        </div>

        <div class="table-responsive-law">
            <table class="law-table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Intitulé de la Loi</th>
                        <th>Téléchargement</th>
                    </tr>
                </thead>

                <tbody id="lawBody">
                    @forelse($lois as $loi)
                        <tr class="law-row" data-search="{{ strtolower($loi->reference . ' ' . $loi->intitule) }}">
                            <td><strong>{{ $loi->reference }}</strong></td>
                            <td>{{ $loi->intitule }}</td>
                            <td>
                                @if($loi->fichier_path)
                                    <a href="{{ Storage::url($loi->fichier_path) }}" class="btn-download-law" target="_blank">
                                        📥 Télécharger
                                    </a>
                                @else
                                    <span style="color: #999; font-size: 13px;">Non disponible</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="noDataRow">
                            <td colspan="3" style="text-align: center; padding: 20px; color: #666;">
                                Aucune loi enregistrée pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Message si recherche vide --}}
            <div id="noResults" style="display: none; padding: 30px; text-align: center; background: white; color: #666; border-radius: 0 0 10px 10px;">
                Aucun résultat trouvé.
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
.laws-section {
    padding: 80px 0;
    background-image: url("{{ asset('assets/images/image33.jpeg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
    min-height: 80vh;
}

.laws-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.65);
}

.main-content-law { position: relative; z-index: 2; width: 90%; max-width: 1100px; margin: auto; }

.title-law {
    text-align: center;
    font-size: 35px;
    font-weight: bold;
    margin-bottom: 30px;
    color: #ffffff;
}

/* Centrage Barre de recherche */
.search-wrapper-center {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 40px;
}

.search-container-law {
    width: 100%;
    max-width: 500px;
}

#lawSearch {
    width: 100%;
    padding: 12px 25px;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: white;
    outline: none;
    transition: 0.3s;
    text-align: center;
}

#lawSearch:focus { background: rgba(255, 255, 255, 0.25); border-color: #3b82c4; }
#lawSearch::placeholder { color: rgba(255, 255, 255, 0.7); }

/* Table Style */
.table-responsive-law { border-radius: 10px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
.law-table { width: 100%; border-collapse: collapse; background: white; }
.law-table thead { background: #3b82c4; color: white; }
.law-table th, .law-table td { padding: 20px; text-align: left; }
.law-table td { border-bottom: 1px solid #eee; color: #333; }
.law-row:hover { background: #f1f6fc; transform: scale(1.005); transition: 0.3s; }

.btn-download-law {
    background: #0b3c6d;
    color: white;
    padding: 8px 18px;
    border-radius: 6px;
    text-decoration: none !important;
    border-bottom: none !important;
    font-weight: 600;
    display: inline-block;
}
.btn-download-law:hover,
.btn-download-law:focus,
.btn-download-law:active {
    background: #0b3c6d;
    text-decoration: none !important;
    border-bottom: none !important;
    transform: none;
}

/* STYLE DE LA PAGINATION */
.pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
.page-item {
    width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
    border-radius: 10px; background: white; color: #333; font-weight: 700; cursor: pointer; transition: 0.3s;
}
.page-item.active { background: #007bff; color: white; }
.page-item.disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("lawBody");
    const allRows = Array.from(tableBody.querySelectorAll(".law-row"));
    const searchInput = document.getElementById("lawSearch");
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
            // Animation d'entrée préservée
            row.style.opacity = "0";
            row.style.transform = "translateY(20px)";
            setTimeout(() => {
                row.style.transition = "0.6s ease-out";
                row.style.opacity = "1";
                row.style.transform = "translateY(0)";
            }, 100 * i);
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
            const searchableText = row.getAttribute("data-search").toLowerCase();
            const visibleText = row.innerText.toLowerCase();
            return searchableText.includes(query) || visibleText.includes(query);
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