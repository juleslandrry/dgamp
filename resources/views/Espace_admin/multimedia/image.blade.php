@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C; --green:#1F7A4D;
        --gold:#C9A227; --gold-soft:#FBF3DD; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6;
        --red:#E74C3C; --red-soft:#FBEAEA;
    }
    .mdg-wrap{max-width:1100px;margin:0 auto;padding:36px 24px 60px;}
    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .mdg-title{font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;letter-spacing:-.01em;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 20px;}
    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    /* Icônes SVG génériques (remplace les emojis) */
    .svg-ico{width:15px;height:15px;flex-shrink:0;}
    .svg-ico-sm{width:12px;height:12px;flex-shrink:0;}

    /* Barre du haut */
    .top-bar{position:sticky;top:10px;z-index:6;display:flex;align-items:center;justify-content:space-between;
        background:#fff;border:1.5px solid var(--line);border-radius:12px;padding:14px 18px;
        margin-bottom:22px;box-shadow:0 4px 14px rgba(11,35,64,.05);flex-wrap:wrap;gap:10px;}
    .doc-count{font-size:13px;color:var(--ink-soft);font-weight:600;}
    .doc-count strong{color:var(--navy);}
    .btn-add-doc{background:var(--navy);color:#fff;border:none;border-radius:8px;
        padding:10px 20px;font-size:13px;font-weight:700;cursor:pointer;transition:.15s ease;
        display:inline-flex;align-items:center;gap:8px;}
    .btn-add-doc:hover{background:#123A63;transform:translateY(-1px);}
    .btn-add-doc svg{width:14px;height:14px;}

    /* Tableau récapitulatif */
    .table-card{background:#fff;border:1.5px solid var(--line);border-radius:14px;overflow:hidden;
        box-shadow:0 3px 14px rgba(11,35,64,.04);margin-bottom:26px;}
    table.album-table{width:100%;border-collapse:collapse;}
    table.album-table thead th{background:#FAF9F5;text-align:left;font-size:11px;font-weight:700;
        color:var(--ink-soft);text-transform:uppercase;letter-spacing:.05em;padding:14px 16px;
        border-bottom:1.5px solid var(--line);}
    table.album-table tbody tr{border-bottom:1px solid var(--line);transition:.1s ease;}
    table.album-table tbody tr:last-child{border-bottom:none;}
    table.album-table tbody tr.row-open{background:#FBF3DD;}
    table.album-table td{padding:10px 16px;vertical-align:middle;}
    .thumb-cell img{width:52px;height:52px;object-fit:cover;border-radius:8px;border:1.5px solid var(--line);}
    .thumb-cell .no-thumb{width:52px;height:52px;border-radius:8px;background:#F0EEE8;display:flex;
        align-items:center;justify-content:center;color:var(--ink-soft);}
    .thumb-cell .no-thumb svg{width:20px;height:20px;}
    .album-title-cell strong{color:var(--navy);font-size:13.5px;}
    .album-title-cell span{display:block;font-size:11.5px;color:var(--ink-soft);margin-top:2px;}
    .photo-badge{background:var(--blue);color:#fff;font-size:11px;font-weight:700;border-radius:20px;
        padding:3px 10px;display:inline-block;}
    .actions-cell{white-space:nowrap;}
    .icon-btn{width:34px;height:34px;border-radius:8px;border:1.5px solid var(--line);background:#fff;
        cursor:pointer;display:inline-flex;align-items:center;justify-content:center;margin-right:6px;
        transition:.15s ease;}
    .icon-btn:last-child{margin-right:0;}
    .icon-btn svg{width:15px;height:15px;}
    .icon-btn.i-edit{color:var(--gold);border-color:#EEDFAE;}
    .icon-btn.i-edit:hover{background:#FBF3DD;}
    .icon-btn.i-edit.active{background:var(--gold);color:#fff;border-color:var(--gold);}
    .icon-btn.i-delete{color:var(--red);border-color:#F2C9C2;}
    .icon-btn.i-delete:hover{background:var(--red-soft);}
    .empty-row td{text-align:center;padding:40px;color:var(--ink-soft);font-size:13.5px;}

    /* Panneau d'édition (déplié) */
    .editor-panel{background:#fff;border:2px solid var(--gold);border-radius:14px;margin-bottom:20px;
        overflow:hidden;box-shadow:0 6px 20px rgba(201,162,39,.12);}
    .editor-head{display:flex;align-items:center;gap:10px;background:var(--navy);color:#fff;
        padding:14px 20px;font-size:13px;font-weight:700;}
    .editor-head svg{width:15px;height:15px;flex-shrink:0;}
    .editor-head .head-label{flex:1;}
    .editor-head .btn-close-editor{background:rgba(255,255,255,.15);border:none;
        color:#fff;border-radius:7px;padding:6px 12px;font-size:11.5px;font-weight:700;cursor:pointer;
        display:inline-flex;align-items:center;gap:6px;}
    .editor-head .btn-close-editor:hover{background:rgba(255,255,255,.25);}
    .editor-head .btn-close-editor svg{width:11px;height:11px;}
    .editor-body{padding:24px;}

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
    .mdg-field input[type=text],.mdg-field input[type=date]{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);box-sizing:border-box;
    }
    .mdg-field input:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

    .cover-zone{background:#FAF9F5;border:1.5px dashed var(--line);border-radius:10px;
        padding:14px 16px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:22px;}
    .cover-zone img{width:60px;height:60px;object-fit:cover;border-radius:8px;border:2px solid var(--gold);}

    /* Section photos */
    .photos-section{border-top:1.5px solid var(--line);padding-top:20px;margin-top:6px;}
    .photos-section-title{display:flex;align-items:center;gap:9px;font-size:12.5px;font-weight:700;
        color:var(--navy);margin-bottom:14px;text-transform:uppercase;letter-spacing:.05em;}

    /* Dropzone — display:flex explicite pour éviter le bug de fragmentation d'un <label> en inline */
    .dropzone{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        width:100%;
        box-sizing:border-box;
        background:var(--gold-soft);
        border:2px dashed var(--gold);
        border-radius:12px;
        padding:26px 20px;
        text-align:center;
        margin-bottom:20px;
        cursor:pointer;
        transition:.15s ease;
    }
    .dropzone:hover{background:#F7EAC4;}
    .dropzone .dz-icon{width:30px;height:30px;color:var(--gold);margin-bottom:8px;}
    .dropzone .dz-text{font-size:13px;font-weight:700;color:var(--navy);}
    .dropzone .dz-hint{font-size:11.5px;color:var(--ink-soft);margin-top:3px;}
    .dropzone input[type=file]{
        position:absolute;
        width:1px;height:1px;
        opacity:0;
        overflow:hidden;
    }
    .dz-filenames{font-size:11.5px;color:var(--green);margin-top:8px;font-weight:600;}

    .photo-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(90px,1fr));gap:12px;}
    .photo-thumb{position:relative;border-radius:9px;overflow:hidden;border:1.5px solid var(--line);
        aspect-ratio:1/1;background:#F0EEE8;}
    .photo-thumb img{width:100%;height:100%;object-fit:cover;display:block;}
    .photo-thumb .photo-remove-x{position:absolute;top:4px;right:4px;width:22px;height:22px;
        border-radius:50%;background:rgba(192,57,43,.9);color:#fff;border:none;
        cursor:pointer;display:flex;align-items:center;justify-content:center;}
    .photo-thumb .photo-remove-x svg{width:10px;height:10px;}
    .photo-thumb .photo-remove-x:hover{background:#C0392B;}
    .photo-thumb.hidden-page{display:none;}

    .photo-pagination{display:flex;justify-content:center;align-items:center;gap:8px;margin-top:16px;}
    .pg-btn{min-width:30px;height:30px;padding:0 8px;border-radius:7px;border:1.5px solid var(--line);background:#fff;
        cursor:pointer;font-size:12px;font-weight:700;color:var(--navy);display:inline-flex;align-items:center;justify-content:center;}
    .pg-btn svg{width:11px;height:11px;}
    .pg-btn:hover{border-color:var(--navy);}
    .pg-btn.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .pg-btn:disabled{opacity:.35;cursor:not-allowed;}

    .no-photos{display:flex;align-items:center;justify-content:center;gap:8px;text-align:center;
        color:var(--ink-soft);font-size:12.5px;padding:20px;
        border:1.5px dashed var(--line);border-radius:10px;box-sizing:border-box;width:100%;}
    .no-photos svg{width:16px;height:16px;flex-shrink:0;}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:30px;}
    .mdg-btn{border:none;border-radius:8px;padding:13px 28px;font-weight:700;cursor:pointer;
        font-size:13.5px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);}

    @media (max-width:820px){
        .mdg-row2{grid-template-columns:1fr;}
        .table-card{overflow-x:auto;}
        table.album-table{min-width:600px;}
    }
</style>

{{-- Bibliothèque d'icônes SVG réutilisées partout (remplace les emojis) --}}
@php
$ico = [
    'plus'    => '<path d="M8 3v10M3 8h10"/>',
    'pencil'  => '<path d="M11.5 2.5l2 2L5 13l-2.6.6.6-2.6z"/>',
    'trash'   => '<path d="M3 4.5h10M6.2 4.5V3a1 1 0 011-1h1.6a1 1 0 011 1v1.5M4.3 4.5l.6 8a1 1 0 001 .9h4.2a1 1 0 001-.9l.6-8"/>',
    'close'   => '<path d="M4 4l8 8M12 4l-8 8"/>',
    'image'   => '<rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/>',
    'upload'  => '<path d="M12 21V5M12 5l4 4M12 5L8 9M4 21h16" stroke-linecap="round" stroke-linejoin="round"/>',
    'chevron-left'  => '<path d="M10 4L6 8l4 4"/>',
    'chevron-right' => '<path d="M6 4l4 4-4 4"/>',
];
@endphp

<div class="mdg-wrap">
    <div class="mdg-crumb">Multimédia</div>
    <h1 class="mdg-title">Galerie Photos</h1>
    <p class="mdg-sub">Gère les albums et leurs photos affichés sur le site public.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mdg-alert warn">
            <strong>Des erreurs empêchent l'enregistrement :</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="top-bar">
        <span class="doc-count"><strong id="album-count-num">{{ count($albums) }}</strong> album(s)</span>
        <button type="button" class="btn-add-doc" onclick="addAlbum()">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">{!! $ico['plus'] !!}</svg>
            Ajouter un album
        </button>
    </div>

    <form method="POST" action="{{ route('galerie.update') }}" enctype="multipart/form-data" id="galerie-form">
        @csrf

        {{-- ===== TABLEAU RÉCAPITULATIF ===== --}}
        <div class="table-card">
            <table class="album-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Album</th>
                        <th>Photos</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="albums-overview">
                    @foreach($albums as $i => $album)
                        <tr data-overview-row="{{ $i }}">
                            <td class="thumb-cell">
                                @if($album['cover'])
                                    <img src="{{ asset($album['cover']) }}" alt="">
                                @else
                                    <div class="no-thumb"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">{!! $ico['image'] !!}</svg></div>
                                @endif
                            </td>
                            <td class="album-title-cell">
                                <strong>{{ $album['titre'] ?: 'Nouvel album' }}</strong>
                                <span>{{ $album['date'] }}</span>
                            </td>
                            <td><span class="photo-badge" id="badge-count-{{ $i }}">{{ count($album['photos']) }} photos</span></td>
                            <td class="actions-cell">
                                <button type="button" class="icon-btn i-edit" onclick="toggleEditor({{ $i }}, this)" title="Modifier">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">{!! $ico['pencil'] !!}</svg>
                                </button>
                                <button type="button" class="icon-btn i-delete" onclick="removeAlbum({{ $i }})" title="Supprimer">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">{!! $ico['trash'] !!}</svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="empty-albums" class="empty-row" style="{{ count($albums) > 0 ? 'display:none;' : '' }}">
                Aucun album pour l'instant. Cliquez sur "Ajouter un album" ci-dessus.
            </div>
        </div>

        {{-- ===== PANNEAUX D'ÉDITION (repliés par défaut) ===== --}}
        <div id="editors-container">
            @foreach($albums as $i => $album)
                <div class="editor-panel" id="editor-panel-{{ $i }}" style="display:none;">
                    <div class="editor-head">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">{!! $ico['pencil'] !!}</svg>
                        <span class="head-label" id="editor-title-{{ $i }}">Modification — {{ $album['titre'] ?: 'Nouvel album' }}</span>
                        <button type="button" class="btn-close-editor" onclick="closeEditor({{ $i }})">
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">{!! $ico['close'] !!}</svg>
                            Fermer
                        </button>
                    </div>
                    <div class="editor-body">
                        <input type="hidden" name="db_id[]" value="{{ $album['db_id'] ?? '' }}">
                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>
                                    Identifiant de l'album
                                </div>
                                <input type="text" name="album_id[]" value="{{ $album['id'] }}" placeholder="Ex: visite-port" oninput="syncOverviewTitle({{ $i }}, this.value, 'id')">

                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>
                                    Date affichée
                                </div>
                                <input type="date" name="date[]" value="{{ $album['date'] }}" oninput="syncOverviewTitle({{ $i }}, this.value, 'date')">
                            </div>
                        </div>

                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                                Titre affiché sur la carte
                            </div>
                            <input type="text" name="titre[]" value="{{ $album['titre'] }}" placeholder="Titre complet de l'événement" oninput="syncOverviewTitle({{ $i }}, this.value, 'titre')">
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
                            <img id="cover-preview-{{ $i }}" src="{{ $album['cover'] ? asset($album['cover']) : '' }}" style="{{ $album['cover'] ? '' : 'display:none;' }}">
                            <div style="flex:1;min-width:160px;">
                                <div class="mdg-label" style="margin-bottom:6px;">
                                    <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg></span>
                                    Image de couverture
                                </div>
                                <input type="file" name="cover[]" accept="image/*" onchange="previewCover({{ $i }}, this)">
                            </div>
                            <input type="hidden" name="cover_actuelle[]" value="{{ $album['cover'] }}">
                        </div>

                        {{-- ===== SECTION PHOTOS ===== --}}
                        <div class="photos-section">
                            <div class="photos-section-title">
                                <span class="mdg-icon i-green" style="width:20px;height:20px;"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $ico['image'] !!}</svg></span>
                                Photos de l'album (<span id="photo-count-label-{{ $i }}">{{ count($album['photos']) }}</span>)
                            </div>

                            {{-- Dropzone en haut, bien visible --}}
                            <label class="dropzone">
                                <svg class="dz-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">{!! $ico['upload'] !!}</svg>
                                <div class="dz-text">Cliquez ici pour ajouter de nouvelles photos</div>
                                <div class="dz-hint">Vous pouvez en sélectionner plusieurs à la fois (maintenez Ctrl ou Shift dans la fenêtre de sélection)</div>
                                <input type="file" name="nouvelles_photos[{{ $i }}][]" accept="image/*" multiple
                                       onchange="showSelectedFiles(this, {{ $i }})">
                                <div class="dz-filenames" id="dz-filenames-{{ $i }}"></div>
                            </label>

                            {{-- Grille des photos existantes --}}
                            <div class="photos-existantes" data-index="{{ $i }}">
                                <div class="photo-grid" id="photo-grid-{{ $i }}">
                                    @foreach($album['photos'] as $p => $photo)
                                        <div class="photo-thumb" data-page="{{ intdiv($p, 12) + 1 }}">
                                            <img src="{{ asset($photo) }}">
                                            <button type="button" class="photo-remove-x" onclick="removePhoto(this, {{ $i }})" title="Retirer">
                                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">{!! $ico['close'] !!}</svg>
                                            </button>
                                            <span style="display:none;" class="photo-path">{{ $photo }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($album['photos']) === 0)
                                    <div class="no-photos" id="no-photos-{{ $i }}">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">{!! $ico['image'] !!}</svg>
                                        Aucune photo pour l'instant — ajoutez-en avec la zone ci-dessus.
                                    </div>
                                @endif
                            </div>
                            <div class="photo-pagination" id="pagination-{{ $i }}"></div>
                        </div>

                        <input type="hidden" name="photos_actuelles[]" class="photos-actuelles-input" value='{{ json_encode($album['photos']) }}'>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
const PHOTOS_PAR_PAGE = 12;

const ICO_PENCIL = '<path d="M11.5 2.5l2 2L5 13l-2.6.6.6-2.6z"/>';
const ICO_TRASH  = '<path d="M3 4.5h10M6.2 4.5V3a1 1 0 011-1h1.6a1 1 0 011 1v1.5M4.3 4.5l.6 8a1 1 0 001 .9h4.2a1 1 0 001-.9l.6-8"/>';
const ICO_CLOSE  = '<path d="M4 4l8 8M12 4l-8 8"/>';
const ICO_UPLOAD = '<path d="M12 21V5M12 5l4 4M12 5L8 9M4 21h16" stroke-linecap="round" stroke-linejoin="round"/>';
const ICO_IMAGE  = '<rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/>';
const ICO_CHEVL  = '<path d="M10 4L6 8l4 4"/>';
const ICO_CHEVR  = '<path d="M6 4l4 4-4 4"/>';

document.getElementById('galerie-form').addEventListener('submit', function () {
    document.querySelectorAll('.photos-existantes').forEach(container => {
        const remainingPaths = Array.from(container.querySelectorAll('.photo-path')).map(s => s.textContent);
        const hiddenInput = container.closest('.editor-body').querySelector('.photos-actuelles-input');
        hiddenInput.value = JSON.stringify(remainingPaths);
    });
});

function toggleEditor(i, btn) {
    const panel = document.getElementById('editor-panel-' + i);
    const row = document.querySelector('[data-overview-row="' + i + '"]');
    const isOpen = panel.style.display !== 'none';

    document.querySelectorAll('.editor-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.icon-btn.i-edit').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('#albums-overview tr').forEach(r => r.classList.remove('row-open'));

    if (!isOpen) {
        panel.style.display = 'block';
        btn.classList.add('active');
        row.classList.add('row-open');
        renderPagination(i);
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function closeEditor(i) {
    document.getElementById('editor-panel-' + i).style.display = 'none';
    document.querySelectorAll('.icon-btn.i-edit').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('#albums-overview tr').forEach(r => r.classList.remove('row-open'));
}

function removeAlbum(i) {
    if (!confirm('Retirer cet album de la liste ? Il ne sera supprimé qu\'après avoir cliqué sur "Enregistrer les modifications".')) return;
    document.querySelector('[data-overview-row="' + i + '"]').remove();
    const panel = document.getElementById('editor-panel-' + i);
    if (panel) panel.remove();
    updateAlbumCount();
}

function updateAlbumCount() {
    const n = document.querySelectorAll('#albums-overview tr').length;
    document.getElementById('album-count-num').textContent = n;
    document.getElementById('empty-albums').style.display = n === 0 ? 'block' : 'none';
}

function syncOverviewTitle(i, value, field) {
    const row = document.querySelector('[data-overview-row="' + i + '"]');
    if (!row) return;
    if (field === 'titre') {
        row.querySelector('.album-title-cell strong').textContent = value || 'Nouvel album';
        const label = document.getElementById('editor-title-' + i);
        if (label) label.textContent = 'Modification — ' + (value || 'Nouvel album');
    }
    if (field === 'date') {
        row.querySelector('.album-title-cell span').textContent = value;
    }
}

function previewCover(i, input) {
    if (input.files && input.files[0]) {
        const img = document.getElementById('cover-preview-' + i);
        img.src = URL.createObjectURL(input.files[0]);
        img.style.display = 'block';
        document.querySelector('[data-overview-row="' + i + '"] .thumb-cell').innerHTML =
            '<img src="' + img.src + '">';
    }
}

function showSelectedFiles(input, i) {
    const label = document.getElementById('dz-filenames-' + i);
    if (input.files.length > 0) {
        label.textContent = input.files.length + ' fichier(s) sélectionné(s) — seront ajoutés à l\'enregistrement';
    } else {
        label.textContent = '';
    }
}

function removePhoto(btn, i) {
    btn.closest('.photo-thumb').remove();
    const grid = document.getElementById('photo-grid-' + i);
    const remaining = grid.querySelectorAll('.photo-thumb').length;
    document.getElementById('photo-count-label-' + i).textContent = remaining;
    document.getElementById('badge-count-' + i).textContent = remaining + ' photos';
    if (remaining === 0) {
        const noPhotosDiv = document.getElementById('no-photos-' + i);
        if (!noPhotosDiv) {
            const div = document.createElement('div');
            div.className = 'no-photos';
            div.id = 'no-photos-' + i;
            div.innerHTML = '<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">' + ICO_IMAGE + '</svg> Aucune photo pour l\'instant — ajoutez-en avec la zone ci-dessus.';
            grid.parentElement.appendChild(div);
        }
    }
    renderPagination(i);
}

function renderPagination(i) {
    const grid = document.getElementById('photo-grid-' + i);
    const thumbs = Array.from(grid.querySelectorAll('.photo-thumb'));
    const totalPages = Math.max(1, Math.ceil(thumbs.length / PHOTOS_PAR_PAGE));
    const pagDiv = document.getElementById('pagination-' + i);

    if (thumbs.length <= PHOTOS_PAR_PAGE) {
        pagDiv.innerHTML = '';
        thumbs.forEach(t => t.classList.remove('hidden-page'));
        return;
    }

    let currentPage = parseInt(grid.dataset.currentPage || '1');
    if (currentPage > totalPages) currentPage = totalPages;
    grid.dataset.currentPage = currentPage;

    thumbs.forEach((t, idx) => {
        const page = Math.floor(idx / PHOTOS_PAR_PAGE) + 1;
        t.dataset.page = page;
        t.classList.toggle('hidden-page', page !== currentPage);
    });

    let html = '';
    html += `<button type="button" class="pg-btn" ${currentPage === 1 ? 'disabled' : ''} onclick="goToPage(${i}, ${currentPage - 1})"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">${ICO_CHEVL}</svg></button>`;
    for (let p = 1; p <= totalPages; p++) {
        html += `<button type="button" class="pg-btn ${p === currentPage ? 'active' : ''}" onclick="goToPage(${i}, ${p})">${p}</button>`;
    }
    html += `<button type="button" class="pg-btn" ${currentPage === totalPages ? 'disabled' : ''} onclick="goToPage(${i}, ${currentPage + 1})"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">${ICO_CHEVR}</svg></button>`;
    pagDiv.innerHTML = html;
}

function goToPage(i, page) {
    const grid = document.getElementById('photo-grid-' + i);
    grid.dataset.currentPage = page;
    renderPagination(i);
}

document.addEventListener('DOMContentLoaded', function () {
    @foreach($albums as $i => $album)
        renderPagination({{ $i }});
    @endforeach
});

let albumCount = document.querySelectorAll('#albums-overview tr').length;

function addAlbum() {
    const index = albumCount;
    albumCount++;

    const overview = document.getElementById('albums-overview');
    const row = document.createElement('tr');
    row.setAttribute('data-overview-row', index);
    row.innerHTML = `
        <td class="thumb-cell"><div class="no-thumb"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">${ICO_IMAGE}</svg></div></td>
        <td class="album-title-cell"><strong>Nouvel album</strong><span></span></td>
        <td><span class="photo-badge" id="badge-count-${index}">0 photos</span></td>
        <td class="actions-cell">
            <button type="button" class="icon-btn i-edit" onclick="toggleEditor(${index}, this)" title="Modifier">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">${ICO_PENCIL}</svg>
            </button>
            <button type="button" class="icon-btn i-delete" onclick="removeAlbum(${index})" title="Supprimer">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">${ICO_TRASH}</svg>
            </button>
        </td>
    `;
    overview.appendChild(row);
    document.getElementById('empty-albums').style.display = 'none';
    updateAlbumCount();

    const editorsContainer = document.getElementById('editors-container');
    const panel = document.createElement('div');
    panel.className = 'editor-panel';
    panel.id = 'editor-panel-' + index;
    panel.innerHTML = `
        <div class="editor-head">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">${ICO_PENCIL}</svg>
            <span class="head-label" id="editor-title-${index}">Modification — Nouvel album</span>
            <button type="button" class="btn-close-editor" onclick="closeEditor(${index})">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">${ICO_CLOSE}</svg>
                Fermer
            </button>
        </div>
        <div class="editor-body">
        
            <div class="mdg-row2">
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>Identifiant de l'album</div>
                    <input type="text" name="album_id[]" placeholder="Ex: nouvel-evenement" oninput="syncOverviewTitle(${index}, this.value, 'id')">
                </div>
                <div class="mdg-field">
                    <div class="mdg-label"><span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>Date affichée</div>
                    <input type="date" name="date[]" oninput="syncOverviewTitle(${index}, this.value, 'date')">
                </div>
            </div>
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>Titre affiché sur la carte</div>
                <input type="text" name="titre[]" placeholder="Titre complet de l'événement" oninput="syncOverviewTitle(${index}, this.value, 'titre')">
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
                    <input type="file" name="cover[]" accept="image/*" onchange="previewCover(${index}, this)">
                </div>
                <img id="cover-preview-${index}" src="" style="display:none;">
                <input type="hidden" name="cover_actuelle[]" value="">
            </div>
            <div class="photos-section">
                <div class="photos-section-title">
                    <span class="mdg-icon i-green" style="width:20px;height:20px;"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">${ICO_IMAGE}</svg></span>
                    Photos de l'album (<span id="photo-count-label-${index}">0</span>)
                </div>
                <label class="dropzone">
                    <svg class="dz-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">${ICO_UPLOAD}</svg>
                    <div class="dz-text">Cliquez ici pour ajouter de nouvelles photos</div>
                    <div class="dz-hint">Vous pouvez en sélectionner plusieurs à la fois</div>
                    <input type="file" name="nouvelles_photos[${index}][]" accept="image/*" multiple onchange="showSelectedFiles(this, ${index})">
                    <div class="dz-filenames" id="dz-filenames-${index}"></div>
                </label>
                <div class="photos-existantes" data-index="${index}">
                    <div class="photo-grid" id="photo-grid-${index}"></div>
                    <div class="no-photos" id="no-photos-${index}">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">${ICO_IMAGE}</svg>
                        Aucune photo pour l'instant — ajoutez-en avec la zone ci-dessus.
                    </div>
                </div>
                <div class="photo-pagination" id="pagination-${index}"></div>
            </div>
            <input type="hidden" name="photos_actuelles[]" class="photos-actuelles-input" value="[]">
        </div>
    `;
    editorsContainer.appendChild(panel);

    toggleEditor(index, overview.lastElementChild.querySelector('.i-edit'));
}
</script>

@endsection