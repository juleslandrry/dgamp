@extends('template')
@section('layout')

<div class="gallery-header-section">
    <div class="overlay"></div>
    <div class="container content-z">
        <h1 id="galleryTitle">ALBUMS DGAMP</h1>
        <p id="gallerySubtitle">Sélectionnez un album pour visualiser les clichés</p>
        <button id="backToAlbums" class="btn-back" style="display: none;">
             Retour aux albums
        </button>
    </div>
</div>

<div class="container gallery-wrapper">
    <div id="albumsGrid" class="album-grid">
        @foreach($albums as $album)
            <div class="album-card" onclick="openAlbum('{{ $album->album_id }}', '{{ addslashes($album->popup_titre) }}', '{{ addslashes($album->popup_sous) }}')">
                <div class="album-cover">
                    <img src="{{ asset($album->cover) }}" alt="Couverture">
                    <div class="album-badge">{{ count($album->photos ?? []) }} Photos</div>
                </div>
                <div class="album-info">
                    <h3>{{ $album->titre }}</h3>
                    <p>{{ $album->date ? $album->date->translatedFormat('F Y') : '' }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div id="photosView" class="photos-grid" style="display: none;"></div>

    <div id="pagination" class="pagination-container" style="display: none;">
        <div class="page-item disabled">&laquo;</div>
        <div class="page-item active">1</div>
        <div class="page-item">&raquo;</div>
    </div>
</div>

<div id="lightbox" class="lightbox">
    <span class="close-lightbox">&times;</span>
    <img src="" class="lightbox-img" id="fullImg">
</div>

<style>
    /* 1. Header avec Background et Overlay */
    .gallery-header-section {
        position: relative;
        padding: 120px 0;
        background-image: url('assets/images/image33.jpeg'); /* Image par défaut */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        text-align: center;
        color: white;
    }

    .gallery-header-section .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Effet sombre */
        z-index: 1;
    }

    .content-z {
        position: relative;
        z-index: 2;
    }

    .gallery-header-section h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 10px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
    }

    .gallery-header-section p {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    /* 2. Wrapper et Grilles */
    .gallery-wrapper { padding: 50px 0; min-height: 60vh; }
    
    .album-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); 
        gap: 25px; 
    }
    
    .album-card {
        background: white; border-radius: 15px; overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06); cursor: pointer; transition: 0.4s;
    }
    .album-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }

    .album-cover { position: relative; height: 220px; }
    .album-cover img { width: 100%; height: 100%; object-fit: cover; }
    
    .album-badge {
        position: absolute; bottom: 12px; right: 12px;
        background: rgba(234, 129, 10, 0.9); /* Orange DGAMP */
        color: white; padding: 4px 12px; border-radius: 5px; font-size: 11px; font-weight: bold;
    }

    .album-info { padding: 18px; text-align: center; }
    .album-info h3 { font-size: 16px; color: #0b1c39; margin-bottom: 8px; line-height: 1.4; font-weight: 700; }
    .album-info p { font-size: 13px; color: #ea810a; font-weight: 600; margin: 0; }

    /* Bouton Retour */
    .btn-back {
        background: #ea810a; color: white; border: none; padding: 12px 25px;
        border-radius: 50px; cursor: pointer; margin-top: 20px; transition: 0.3s;
        font-weight: bold; text-transform: uppercase; font-size: 13px;
        box-shadow: 0 4px 15px rgba(234, 129, 10, 0.3);
    }
    .btn-back:hover { background: #fff; color: #ea810a; transform: scale(1.05); }

    /* Photos Internes */
    .photos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 15px; animation: fadeIn 0.5s; }
    .photo-item { height: 200px; border-radius: 10px; overflow: hidden; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .photo-item img { width: 100%; height: 100%; object-fit: cover; transition: 0.4s; }
    .photo-item:hover img { transform: scale(1.1); }

    /* Lightbox */
    .lightbox {
        display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.9); align-items: center; justify-content: center;
    }
    .lightbox-img { max-width: 90%; max-height: 80%; border: 4px solid white; border-radius: 5px; }
    .close-lightbox { position: absolute; top: 30px; right: 40px; color: white; font-size: 50px; cursor: pointer; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
// Données des albums injectées depuis la base de données
const albumData = @json($albums->pluck('photos', 'album_id'));

function openAlbum(albumId, title, subtitle) {
    document.getElementById('galleryTitle').innerText = title;
    document.getElementById('gallerySubtitle').innerText = subtitle;
    document.getElementById('albumsGrid').style.display = 'none';
    document.getElementById('photosView').style.display = 'grid';
    document.getElementById('backToAlbums').style.display = 'inline-block';

    const photosView = document.getElementById('photosView');
    photosView.innerHTML = ""; 
    const photos = albumData[albumId] || [];
    
    photos.forEach(src => {
        const div = document.createElement('div');
        div.className = 'photo-item';
        div.innerHTML = `<img src="${src}" onclick="zoomImage('${src}')">`;
        photosView.appendChild(div);
    });
    window.scrollTo({top: 0, behavior: 'smooth'});
}

document.getElementById('backToAlbums').addEventListener('click', function() {
    document.getElementById('albumsGrid').style.display = 'grid';
    document.getElementById('photosView').style.display = 'none';
    this.style.display = 'none';
    document.getElementById('galleryTitle').innerText = "ALBUMS DGAMP";
    document.getElementById('gallerySubtitle').innerText = "Sélectionnez un album pour visualiser les clichés";
});

function zoomImage(src) {
    const lb = document.getElementById('lightbox');
    document.getElementById('fullImg').src = src;
    lb.style.display = 'flex';
}

document.querySelector('.close-lightbox').onclick = () => {
    document.getElementById('lightbox').style.display = 'none';
};
</script>

@endsection