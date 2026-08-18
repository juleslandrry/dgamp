@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340;
        --navy-2:#123A63;
        --blue:#1E7FB8;
        --orange:#E8720C;
        --green:#1F7A4D;
        --gold:#C9A227;
        --gold-soft:#FBF3DD;
        --ink:#1C2733;
        --ink-soft:#66707B;
        --line:#E7E2D6;
    }

    .mdg-wrap{max-width:980px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);
        margin:0 0 8px;letter-spacing:-.01em;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 26px;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    .card-block{background:#fff;border:1.5px solid var(--line);border-radius:14px;
        margin-bottom:20px;overflow:hidden;box-shadow:0 3px 12px rgba(11,35,64,.05);}

    .card-block-top{display:flex;align-items:center;gap:14px;background:var(--navy);padding:14px 20px;}
    .card-num{width:28px;height:28px;border-radius:50%;background:var(--gold);color:var(--navy);
        display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;}
    .card-block-top-title{color:#fff;font-weight:700;font-size:14px;flex:1;}
    .btn-remove-album{background:none;border:1.5px solid rgba(255,255,255,.4);color:#fff;
        border-radius:7px;padding:6px 13px;font-size:11.5px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .btn-remove-album:hover{background:rgba(255,255,255,.15);}

    .card-block-body{padding:22px 24px;}

    .mdg-field{margin-bottom:16px;min-width:0;}
    .mdg-field:last-child{margin-bottom:0;}
    .mdg-label{display:flex;align-items:center;gap:9px;font-size:11.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;}
    .mdg-icon{width:22px;height:22px;border-radius:7px;flex-shrink:0;display:flex;align-items:center;
        justify-content:center;color:#fff;}
    .mdg-icon svg{width:12px;height:12px;}
    .mdg-icon.i-blue{background:var(--blue);}
    .mdg-icon.i-orange{background:var(--orange);}
    .mdg-icon.i-green{background:var(--green);}
    .mdg-icon.i-gold{background:var(--gold);}

    .mdg-field input[type=text]{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);
        transition:.15s ease;box-sizing:border-box;
    }
    .mdg-field input[type=text]:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

    .cover-zone{background:#FAF9F5;border:1.5px dashed var(--line);border-radius:10px;
        padding:14px 16px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:18px;}
    .cover-zone img{width:60px;height:60px;object-fit:cover;border-radius:8px;border:2px solid var(--gold);}

    .photos-title{display:flex;align-items:center;gap:9px;font-size:12.5px;font-weight:700;color:var(--navy);
        margin:20px 0 10px;padding-top:18px;border-top:1px solid var(--line);
        text-transform:uppercase;letter-spacing:.05em;}
    .photo-row{display:flex;align-items:center;gap:12px;background:#FAF9F5;
        padding:10px 14px;border-radius:9px;margin-bottom:8px;border:1px solid var(--line);}
    .photo-row img{width:44px;height:44px;object-fit:cover;border-radius:7px;flex-shrink:0;}
    .photo-row span{flex:1;font-size:11.5px;color:var(--ink-soft);word-break:break-all;}
    .photo-remove{background:#FBEAEA;color:#C0392B;border:none;border-radius:6px;
        padding:6px 11px;font-size:11px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .photo-remove:hover{background:#F5D5D5;}

    .new-photo-zone{background:var(--gold-soft);border:1.5px dashed var(--gold);border-radius:9px;
        padding:12px 14px;margin-top:10px;}

    .btn-add-card{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:8px;
        padding:11px 20px;cursor:pointer;font-size:13px;font-weight:700;margin-bottom:10px;transition:.15s ease;}
    .btn-add-card:hover{background:var(--gold-soft);}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:30px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;
        font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}

    @media (max-width: 640px){
        .mdg-row2{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Multimédia</div>
    <h1 class="mdg-title">Galerie Photos</h1>
    <p class="mdg-sub">Gère les albums et leurs photos affichés sur le site public.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    @if(!$detection_ok)
        <div class="mdg-alert warn">⚠️ Les albums n'ont pas pu être détectés automatiquement. Vérifie le contenu avant d'enregistrer.</div>
    @endif

    <form method="POST" action="{{ route('galerie.update') }}" enctype="multipart/form-data">
        @csrf

        <div id="albums-list">
            @foreach($albums as $i => $album)
                <div class="card-block">
                    <div class="card-block-top">
                        <div class="card-num">{{ $i + 1 }}</div>
                        <div class="card-block-top-title">{{ $album['titre'] ?: 'Nouvel album' }}</div>
                        @if($i > 0)
                            <button type="button" class="btn-remove-album" onclick="this.closest('.card-block').remove()">Retirer l'album</button>
                        @endif
                    </div>
                    <div class="card-block-body">
                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>
                                    Identifiant de l'album (sans espace)
                                </div>
                                <input type="text" name="album_id[]" value="{{ $album['id'] }}" placeholder="Ex: visite-port">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg></span>
                                    Nombre de photos affiché (badge)
                                </div>
                                <input type="text" name="badge[]" value="{{ preg_replace('/\D/', '', $album['badge']) }}" placeholder="Ex: 12">
                            </div>
                        </div>

                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                                    Titre affiché sur la carte
                                </div>
                                <input type="text" name="titre[]" value="{{ $album['titre'] }}" placeholder="Titre complet de l'événement">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>
                                    Date affichée
                                </div>
                                <input type="text" name="date[]" value="{{ $album['date'] }}" placeholder="Ex: Février 2026">
                            </div>
                        </div>

                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>
                                    Titre dans la fenêtre ouverte
                                </div>
                                <input type="text" name="popup_titre[]" value="{{ $album['popup_titre'] }}" placeholder="Titre court">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 14.5S3 10 3 6.3a5 5 0 0110 0C13 10 8 14.5 8 14.5z"/><circle cx="8" cy="6.3" r="1.8"/></svg></span>
                                    Sous-titre dans la fenêtre ouverte
                                </div>
                                <input type="text" name="popup_sous[]" value="{{ $album['popup_sous'] }}" placeholder="Lieu - Date">
                            </div>
                        </div>

                        <div class="cover-zone">
                            @if($album['cover'])
                                <img src="{{ asset($album['cover']) }}">
                            @endif
                            <div style="flex:1;min-width:160px;">
                                <div class="mdg-label" style="margin-bottom:6px;">
                                    <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg></span>
                                    Image de couverture
                                </div>
                                <input type="file" name="cover[]" accept="image/*">
                            </div>
                            <input type="hidden" name="cover_actuelle[]" value="{{ $album['cover'] }}">
                        </div>

                        <div class="photos-title">
                            <span class="mdg-icon i-green" style="width:20px;height:20px;"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg></span>
                            Photos de l'album ({{ count($album['photos']) }})
                        </div>
                        <div class="photos-existantes" data-index="{{ $i }}">
                            @foreach($album['photos'] as $photo)
                                <div class="photo-row">
                                    <img src="{{ asset($photo) }}">
                                    <span>{{ $photo }}</span>
                                    <button type="button" class="photo-remove" onclick="this.closest('.photo-row').remove()">Retirer</button>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="photos_actuelles[]" class="photos-actuelles-input" value='{{ json_encode($album['photos']) }}'>

                        <div class="new-photo-zone">
                            <div class="mdg-label" style="margin-bottom:6px;">Ajouter de nouvelles photos</div>
                            <input type="file" name="nouvelles_photos[{{ $i }}][]" accept="image/*" multiple>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn-add-card" onclick="addAlbum()">+ Ajouter un album</button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
document.querySelector('form').addEventListener('submit', function () {
    document.querySelectorAll('.photos-existantes').forEach(container => {
        const remainingPaths = Array.from(container.querySelectorAll('.photo-row span')).map(s => s.textContent);
        const hiddenInput = container.nextElementSibling;
        hiddenInput.value = JSON.stringify(remainingPaths);
    });
});

let albumCount = document.querySelectorAll('#albums-list .card-block').length;

function addAlbum() {
    const list = document.getElementById('albums-list');
    const index = albumCount;
    albumCount++;
    const num = list.querySelectorAll('.card-block').length + 1;

    const wrap = document.createElement('div');
    wrap.className = 'card-block';
    wrap.innerHTML = `
        <div class="card-block-top">
            <div class="card-num">${num}</div>
            <div class="card-block-top-title">Nouvel album</div>
            <button type="button" class="btn-remove-album" onclick="this.closest('.card-block').remove()">Annuler</button>
        </div>
        <div class="card-block-body">
            <div class="mdg-row2">
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>Identifiant de l'album (sans espace)</div>
                    <input type="text" name="album_id[]" placeholder="Ex: nouvel-evenement">
                </div>
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg></span>Nombre de photos affiché (badge)</div>
                    <input type="text" name="badge[]" placeholder="Ex: 5">
                </div>
            </div>
            <div class="mdg-row2">
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>Titre affiché sur la carte</div>
                    <input type="text" name="titre[]" placeholder="Titre complet de l'événement">
                </div>
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>Date affichée</div>
                    <input type="text" name="date[]" placeholder="Ex: Juillet 2026">
                </div>
            </div>
            <div class="mdg-row2">
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>Titre dans la fenêtre ouverte</div>
                    <input type="text" name="popup_titre[]" placeholder="Titre court">
                </div>
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 14.5S3 10 3 6.3a5 5 0 0110 0C13 10 8 14.5 8 14.5z"/><circle cx="8" cy="6.3" r="1.8"/></svg></span>Sous-titre dans la fenêtre ouverte</div>
                    <input type="text" name="popup_sous[]" placeholder="Lieu - Date">
                </div>
            </div>
            <div class="cover-zone">
                <div style="flex:1;min-width:160px;">
                    <div class="mdg-label" style="margin-bottom:6px;"><span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg></span>Image de couverture</div>
                    <input type="file" name="cover[]" accept="image/*">
                </div>
                <input type="hidden" name="cover_actuelle[]" value="">
            </div>
            <div class="photos-title">Photos de l'album (0)</div>
            <div class="photos-existantes" data-index="${index}"></div>
            <input type="hidden" name="photos_actuelles[]" class="photos-actuelles-input" value="[]">
            <div class="new-photo-zone">
                <div class="mdg-label" style="margin-bottom:6px;">Ajouter des photos</div>
                <input type="file" name="nouvelles_photos[${index}][]" accept="image/*" multiple>
            </div>
        </div>
    `;
    list.appendChild(wrap);
}
</script>

@endsection