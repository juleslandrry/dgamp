@extends('template')

@section('layout')

<div class="partners-site-container">
    <div class="global-overlay-partners"></div>

    <div class="container content-z">
        <div class="partners-header text-center">
            <h1 class="text-white">Nos Partenaires</h1>
            <p class="lead text-white">Ils nous font confiance et nous accompagnent dans le développement du secteur maritime.</p>
        </div>

        <section class="partners-grid-section">
            <div class="partners-grid" id="partnersGrid">
                @forelse($partenaires as $partenaire)
                    <div class="partner-card-glass partner-item">
                        <div class="partner-logo-box">
                            <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="{{ $partenaire->nom }}" class="img-fluid">
                        </div>
                        <div class="partner-info">
                            <h3 class="text-white">{{ $partenaire->nom }}</h3>
                            @if($partenaire->type)
                                <p class="text-white-50">{{ $partenaire->type }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-white py-5 w-100">
                        <p class="lead">Aucun partenaire enregistré pour le moment.</p>
                    </div>
                @endforelse
            </div>

            @if($partenaires->count() > 6)
                <div class="pagination-container" id="paginationWrapper">
                    <div class="page-item" id="prevBtn">&laquo;</div>
                    <div id="pageNumbers" style="display: flex; gap: 8px;"></div>
                    <div class="page-item" id="nextBtn">&raquo;</div>
                </div>
            @endif
        </section>

        <div class="cta-glass-box text-center">
            <h3 class="text-white">Devenir Partenaire de la DGAMP</h3>
            <p class="text-white">Vous souhaitez collaborer avec nous pour le rayonnement de l'économie bleue ?</p>
            <a href="#" class="btn-partner-action mt-3">
                <i class="fas fa-handshake"></i> Proposer un Partenariat
            </a>
        </div>
    </div>
</div>

<style>
    .partners-site-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-image: url("{{ asset('assets/images/image33.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding-bottom: 80px;
    }
    .global-overlay-partners {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.85) 0%, rgba(17, 16, 16, 0.9) 100%);
        z-index: 1;
    }
    .content-z { position: relative; z-index: 2; }
    .partners-header { padding: 100px 0 50px; }
    .partners-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }
    .partners-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }
    .partner-card-glass {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        padding: 40px 20px;
        border-radius: 25px;
        text-align: center;
        transition: 0.4s ease;
    }
    .partner-card-glass:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.12);
        border-color: #e37419;
    }
    .partner-logo-box {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 15px;
    }
    .partner-logo-box img { max-height: 100%; object-fit: contain; }
    .partner-info h3 { font-size: 1.25rem; margin-bottom: 5px; font-weight: 700; }
    .cta-glass-box { background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.1); padding: 40px; border-radius: 30px; margin-top: 60px; }
    .btn-partner-action {
        background: #1d976c;
        color: white !important;
        padding: 12px 35px;
        border-radius: 8px;
        text-decoration: none !important;
        font-weight: 700;
        display: inline-block;
        transition: 0.3s;
    }
    .btn-partner-action:hover { background: #e37419; }

    .pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
    .page-item {
        width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
        border-radius: 10px; background: white; color: #333; font-weight: 700; cursor: pointer; transition: 0.3s;
    }
    .page-item.active { background: #e37419; color: white; }
    .page-item.disabled { opacity: 0.5; cursor: not-allowed; }

    @media (max-width: 768px) { .partners-header h1 { font-size: 2.2rem; } }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const items = Array.from(document.querySelectorAll(".partner-item"));
    const pageNumbers = document.getElementById("pageNumbers");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (items.length === 0 || !pageNumbers) return;

    let itemsPerPage = 6;
    let currentPage = 1;

    function displayPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        items.forEach((item, index) => {
            item.style.display = (index >= start && index < end) ? "block" : "none";
        });

        renderPagination();
    }

    function renderPagination() {
        const pageCount = Math.ceil(items.length / itemsPerPage);
        pageNumbers.innerHTML = "";

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("div");
            btn.className = `page-item ${i === currentPage ? 'active' : ''}`;
            btn.innerText = i;
            btn.onclick = () => {
                currentPage = i;
                displayPage(currentPage);
                window.scrollTo({ top: 200, behavior: 'smooth' });
            };
            pageNumbers.appendChild(btn);
        }

        prevBtn.classList.toggle("disabled", currentPage === 1);
        nextBtn.classList.toggle("disabled", currentPage === pageCount || pageCount === 0);
    }

    prevBtn.onclick = () => { if(currentPage > 1) { currentPage--; displayPage(currentPage); } };
    nextBtn.onclick = () => { 
        const pageCount = Math.ceil(items.length / itemsPerPage);
        if(currentPage < pageCount) { currentPage++; displayPage(currentPage); } 
    };

    displayPage(currentPage);
});
</script>

@endsection