@extends('template')
@section('layout')

<div class="operators-site-container">
    <div class="global-overlay-op"></div>

    <div class="container content-z">
        <div class="op-header text-center">
            <h1 class="text-white">Liste des Opérateurs</h1>
            <p class="lead text-white">Consultez la liste des entreprises et acteurs agréés par la DGAM.</p>

            <div class="search-wrapper-center mt-4">
                <div class="search-container-op">
                    <input type="text" id="opSearch" placeholder="Rechercher une entreprise ou une activité...">
                </div>
            </div>
        </div>

        <section class="table-section">
            <div class="table-responsive-op shadow-lg">
                <table class="op-table">
                    <thead>
                        <tr>
                            <th>Raison Sociale</th>
                            <th>Activités</th>
                        </tr>
                    </thead>
                    <tbody id="opBody">
                        <tr class="op-row">
                            <td><strong>STARMARINE</strong></td>
                            <td>Offshore (plongée SM)</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>GENERAL MARITIME SERVICES CI (GEMS-CI)</strong></td>
                            <td>Offshore</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>STA</strong></td>
                            <td>Offshore</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>RMO Côte d'Ivoire ABIDJAN</strong></td>
                            <td>Offshore</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>BOCCARD COTE D'IVOIRE</strong></td>
                            <td>Offshore</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>TEFON OILFIELD SERVICES CI</strong></td>
                            <td>Offshore</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>CMNP</strong></td>
                            <td>Pêche</td>
                        </tr>
                        <tr class="op-row">
                            <td><strong>APREMAR</strong></td>
                            <td>Navires</td>
                        </tr>
                        </tbody>
                </table>
                <div id="noResults" style="display: none; padding: 30px; text-align: center; background: white; color: #666;">
                    Aucun opérateur trouvé pour cette recherche.
                </div>
            </div>

            <div class="pagination-container" id="paginationWrapper">
                <div class="page-item" id="prevBtn">&laquo;</div>
                <div id="pageNumbers" style="display: flex; gap: 8px;"></div>
                <div class="page-item" id="nextBtn">&raquo;</div>
            </div>
        </section>
    </div>
</div>

<style>
    /* BACKGROUND & OVERLAY UNIFORMES */
    .operators-site-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-image: url("{{ asset('assets/images/image33.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding-bottom: 100px;
    }

    .global-overlay-op {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.8) 0%, rgba(10, 10, 10, 0.85) 100%);
        z-index: 1;
    }

    .content-z { position: relative; z-index: 2; }

    /* HEADER ALIGNÉ */
    .op-header { padding: 100px 0 40px; }
    .op-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }
    .badge-op { background: #e37419; color: white; padding: 5px 15px; border-radius: 50px; font-weight: 600; margin-bottom: 15px; display: inline-block; }

    /* RECHERCHE STYLE GLASS */
    .search-wrapper-center { display: flex; justify-content: center; width: 100%; }
    .search-container-op { width: 100%; max-width: 500px; }
    #opSearch {
        width: 100%;
        padding: 12px 25px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        outline: none;
        transition: 0.3s;
        text-align: center;
    }
    #opSearch:focus { background: rgba(255, 255, 255, 0.2); border-color: #e37419; }

    /* TABLEAU */
    .table-responsive-op { border-radius: 15px; overflow: hidden; }
    .op-table { width: 100%; border-collapse: collapse; background: white; }
    .op-table thead { background: #3b82c4; color: white; }
    .op-table th, .op-table td { padding: 18px 25px; text-align: left; }
    .op-table td { border-bottom: 1px solid #eee; color: #333; }
    .op-row:hover { background: #f8f9fa; }

    /* PAGINATION */
    .pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
    .page-item {
        width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;
        border-radius: 8px; background: white; color: #333; font-weight: 700; cursor: pointer; transition: 0.3s;
    }
    .page-item.active { background: #e37419; color: white; }
    .page-item.disabled { opacity: 0.5; cursor: not-allowed; }

    @media (max-width: 768px) {
        .op-header h1 { font-size: 2.2rem; }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.getElementById("opBody");
    const allRows = Array.from(tableBody.querySelectorAll(".op-row"));
    const searchInput = document.getElementById("opSearch");
    const pageNumbers = document.getElementById("pageNumbers");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const noResults = document.getElementById("noResults");

    let rowsPerPage = 10; // Réglé sur 10 comme demandé
    let currentPage = 1;
    let filteredRows = allRows;

    function displayRows() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        allRows.forEach(row => row.style.display = "none");
        const rowsToDisplay = filteredRows.slice(start, end);
        
        rowsToDisplay.forEach((row) => {
            row.style.display = "table-row";
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
            btn.onclick = () => { currentPage = i; displayRows(); };
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