@extends('template')
@section('layout')

<section class="documents-section">
    <div class="overlay-dark"></div>
    
    <div class="container relative-content">
        <h1 class="title-doc">Communiqué DGAMP</h1>
        
        <div class="search-wrapper">
            <div class="search-box">
                <input type="text" id="docSearch" placeholder="Rechercher un communiqué (ex: Arrêté, Décret, 2026)...">
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
                <tbody id="docBody">
                    <tr class="doc-row">
                        <td><strong>Arrêté n°332 du 26 février 2020 fixant les conditions de visite et de certification des navires ivoiriens</strong></td>
                        <td>fixant les conditions de visit.....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" target="_blank">
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>Décret n° 2021-804 du 8 décembre 2021 portant organisation du SEMTAM</strong></td>
                        <td>Décret refermant l'organisati.....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>Règlement d'exécution num. 003/2019/COM/UEMOA</strong></td>
                        <td>Règlement d'exécution déter.....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>Arrêté n°334 sur l'activité de recrutement.....</strong></td>
                        <td>Arrêté n°334 sur l'activité de recrutement.</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>Arrêté n°335 retrait ou suspension des brevets..</strong></td>
                        <td>Arrêté n°335 retrait ou suspension des brevets.</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>Arrêté n°336 prévention de l'abus de l'alcool..</strong></td>
                        <td>Arrêté n°336 prévention de l'abus de l'alcool.</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>Décret N° 2019-243 du 20 mars 2019 fixant les procédures de définitions et les modalités de gestion des domaines publics maritimes..</strong></td>
                        <td>le présent décret a pour obj.....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="doc-row">
                        <td><strong>CODE ISPS</strong></td>
                        <td>Code International pour la Sû.....</td>
                        <td><span class="badge-pdf">PDF</span></td>
                        <td class="text-right">
                            <a href="#" class="btn-download" download>
                                Télécharger <span class="download-icon">📥</span>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- Message si vide --}}
            <div id="noResults" style="display: none; padding: 30px; text-align: center; color: #666;">
                Aucun communiqué trouvé.
            </div>
        </div>

        <div class="pagination-container">
            <div class="page-item" id="prevBtn">&laquo;</div>
            <div id="pageNumbers" style="display: flex; gap: 8px;"></div>
            <div class="page-item" id="nextBtn">&raquo;</div>
        </div>
    </div>
</section>

<style>
/* Tes styles de base préservés */
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
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.7) 100%);
    z-index: 1;
}

.relative-content { position: relative; z-index: 2; width: 100%; max-width: 1200px; margin: 0 auto; }

.title-doc { 
    color: #ffffff; text-align: center; font-size: 2.8rem; margin-bottom: 40px; 
    font-weight: 800; text-transform: uppercase; letter-spacing: 2px;
}

.search-wrapper { width: 100%; max-width: 750px; margin: 0 auto 40px; }
.search-box {
    display: flex;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    padding: 12px 25px; /* Ajusté pour centrer le texte */
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

#docSearch {
    flex: 1; background: transparent; border: none; outline: none;
    color: white; font-size: 1rem; text-align: center;
}
#docSearch::placeholder { color: rgba(255, 255, 255, 0.6); }

.table-responsive {
    background: #ffffff; border-radius: 15px; overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

.doc-table { width: 100%; border-collapse: collapse; }
.doc-table thead { background: #3b82c4; color: white; }
.doc-table th { padding: 20px; text-align: left; font-size: 0.85rem; text-transform: uppercase; }
.doc-table td { padding: 20px; border-bottom: 1px solid #eee; color: #333; }
.doc-row:hover { background: #f8fafc; }

.btn-download {
    background: #0b3c6d; color: white !important; padding: 10px 18px;
    border-radius: 8px; text-decoration: none !important; font-weight: 600;
    display: inline-flex; align-items: center; gap: 8px; transition: 0.3s;
}
.btn-download:hover { background: #3b82c4; transform: translateY(-2px); }

.badge-pdf { background: #fff5f5; color: #e11d48; padding: 4px 10px; border-radius: 4px; font-weight: bold; border: 1px solid #fed7d7; }

/* STYLE PAGINATION HARMONISÉ */
.pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
.page-item {
    width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
    border-radius: 10px; background: white; color: #333; font-weight: 700; 
    cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.page-item.active { background: #3b82c4; color: white; }
.page-item.disabled { opacity: 0.5; cursor: not-allowed; pointer-events: none; }
.page-item:hover:not(.active):not(.disabled) { background: #f0f0f0; }

.text-right { text-align: right; }
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

        // On cache tout d'abord
        allRows.forEach(row => row.style.display = "none");

        // On affiche uniquement la tranche concernée parmis les lignes filtrées
        const rowsToDisplay = filteredRows.slice(start, end);
        rowsToDisplay.forEach(row => row.style.display = "table-row");

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

        // État des boutons Suivant / Précédent
        prevBtn.classList.toggle("disabled", currentPage === 1 || pageCount === 0);
        nextBtn.classList.toggle("disabled", currentPage === pageCount || pageCount === 0);
    }

    searchInput.addEventListener("input", function() {
        const val = this.value.toLowerCase();
        
        filteredRows = allRows.filter(row => 
            row.innerText.toLowerCase().includes(val)
        );

        currentPage = 1; // Revenir à la page 1 lors d'une recherche
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