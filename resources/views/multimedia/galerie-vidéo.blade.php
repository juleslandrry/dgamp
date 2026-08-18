@extends('template')
@section('layout')

<div class="video-header-section">
    <div class="overlay"></div>
    <div class="container content-z">
        <h1 id="galleryTitle">VIDÉOS DGAMP</h1>
        <p id="gallerySubtitle">Découvrez nos reportages et interventions en vidéo</p>
    </div>
</div>

<section class="gallery-section">
    <div class="container">
        <div class="gallery-grid" id="videoGrid">
            <div class="video-card-v2">
                <div class="video-preview">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/y3kUE7Ew3rA?si=5M_Oaw0oAADmyKQv"  allowfullscreen ></iframe> 
                </div>
                <div class="video-details">
                    <h3>Reportage de la Cérémonie de clôture pilotée par le cabinet GR CONSULTING</h3>
                </div>
            </div>

            <div class="video-card-v2">
                <div class="video-preview">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/TbEBUxR8Fyg?si=P6OxUc0wuSrcplCt"  allowfullscreen ></iframe> 
                </div>
                <div class="video-details">
                    <h3>Sécurité maritime et portuaire : des équipements d'une valeur...</h3>
                </div>
            </div>

            <div class="video-card-v2">
                <div class="video-preview">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/824gwdL2Zd8?si=t8limTDHrWTotP87" allowfullscreen></iframe>
                <div class="video-details">
                    <h3>Transport : Remise d'équipements à la direction des affaires maritimes</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="pagination-container">
        <div class="page-item" id="vidPrev">&laquo;</div>
        <div id="vidPageNumbers" style="display: flex; gap: 8px;"></div>
        <div class="page-item" id="vidNext">&raquo;</div>
    </div>
</section>

<div id="videoModal" class="video-modal">
    <span class="close-video">&times;</span>
    <div class="video-container">
        <iframe id="videoPlayer" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>

<style>
    /* --- NOUVEAU HEADER (Cohérent avec les Albums) --- */
    .video-header-section {
        position: relative;
        padding: 120px 0;
        background-image: url('assets/images/image33.jpeg'); /* Image de fond maritime */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        text-align: center;
        color: white;
    }

    .video-header-section .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75); /* Bleu nuit très sombre */
        z-index: 1;
    }

    .content-z { position: relative; z-index: 2; }

    .video-header-section h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    .video-header-section p {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* --- GRILLE & CARTES --- */
    .gallery-section { padding: 60px 0; background-color: #f4f7f9; }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .video-card-v2 {
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: 0.4s;
        cursor: pointer;
    }

    .video-card-v2:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.15);
    }

    .video-preview { position: relative; aspect-ratio: 16/9 }
    .video-preview img { width: 100%; height: 100%; object-fit: cover; opacity: 0.85; transition: 0.5s; }
    .video-card-v2:hover .video-preview img { opacity: 1; transform: scale(1.05); }

    .play-circle {
        width: 60px; height: 60px; background: #ea810a; /* Orange DGAMP */
        color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 20px; padding-left: 5px; box-shadow: 0 4px 20px rgba(234, 129, 10, 0.4);
        transition: 0.3s;
    }

    .video-card-v2:hover .play-circle { background: #ffffff; color: #ea810a; transform: scale(1.2); }

    .video-details { padding: 10px 5px; min-height: 40px; display: flex; align-items: center; justify-content: center; }
    .video-details h3 { font-size: 17px; color: #0b1c39; font-weight: 700; line-height: 1.4; margin: 0; }

    /* --- MODAL & PAGINATION --- */
    .video-modal {
        display: none; position: fixed; z-index: 9999; top: 0; left: 0;
        width: 100%; height: 100%; background: rgba(0,0,0,0.95);
        align-items: center; justify-content: center;
    }
    .video-container { width: 90%; max-width: 1000px; aspect-ratio: 16/9; }
    #videoPlayer { width: 100%; height: 100%; border-radius: 15px; border: 3px solid rgba(255,255,255,0.1); }
    .close-video { position: absolute; top: 30px; right: 40px; color: #fff; font-size: 50px; cursor: pointer; }

    .pagination-container { display: flex; justify-content: center; gap: 8px; margin-top: 50px; }
    .page-item {
        width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;
        border: 1px solid #dee2e6; border-radius: 10px; background: #fff; cursor: pointer; transition: 0.3s;
    }
    .page-item.active { background: #ea810a; color: white; border-color: #ea810a; }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const vidsPerPage = 6;
    const vCards = Array.from(document.querySelectorAll(".video-card-v2"));
    const vidNums = document.getElementById("vidPageNumbers");
    const vPrev = document.getElementById("vidPrev");
    const vNext = document.getElementById("vidNext");
    let currentVPage = 1;

    const totalVPages = Math.ceil(vCards.length / vidsPerPage);

    function updateVideoGallery(page) {
        currentVPage = page;
        const start = (page - 1) * vidsPerPage;
        vCards.forEach((c, i) => {
            c.style.display = (i >= start && i < start + vidsPerPage) ? "block" : "none";
        });
        renderVidPagination();
    }

    function renderVidPagination() {
        vidNums.innerHTML = "";
        for (let i = 1; i <= totalVPages; i++) {
            const b = document.createElement("div");
            b.className = `page-item ${i === currentVPage ? 'active' : ''}`;
            b.innerText = i;
            b.onclick = () => updateVideoGallery(i);
            vidNums.appendChild(b);
        }
        vPrev.classList.toggle("disabled", currentVPage === 1);
        vNext.classList.toggle("disabled", currentVPage === totalVPages || totalVPages === 0);
    }

    const vModal = document.getElementById("videoModal");
    const vPlayer = document.getElementById("videoPlayer");
    
    vCards.forEach(c => {
        c.onclick = () => {
            vPlayer.src = c.dataset.videoUrl + "?autoplay=1";
            vModal.style.display = "flex";
        };
    });

    document.querySelector(".close-video").onclick = () => {
        vModal.style.display = "none";
        vPlayer.src = "";
    };

    vPrev.onclick = () => { if(currentVPage > 1) updateVideoGallery(currentVPage - 1); };
    vNext.onclick = () => { if(currentVPage < totalVPages) updateVideoGallery(currentVPage + 1); };

    updateVideoGallery(1);
});
</script>

@endsection