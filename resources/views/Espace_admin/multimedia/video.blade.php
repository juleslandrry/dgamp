@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C; --green:#1F7A4D;
        --gold:#C9A227; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6;
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

    .top-bar{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
    .top-bar h2{font-size:17px;font-weight:700;color:var(--navy);margin:0;display:flex;align-items:center;gap:8px;}
    .top-bar h2 svg{width:17px;height:17px;color:var(--navy);}
    .btn-add-doc{background:var(--navy);color:#fff;border:none;border-radius:8px;
        padding:11px 20px;font-size:13px;font-weight:700;cursor:pointer;transition:.15s ease;
        display:inline-flex;align-items:center;gap:8px;}
    .btn-add-doc:hover{background:#123A63;transform:translateY(-1px);}
    .btn-add-doc svg{width:14px;height:14px;}

    .table-card{background:#fff;border:1.5px solid var(--line);border-radius:14px;overflow:hidden;
        box-shadow:0 3px 14px rgba(11,35,64,.04);}
    table.doc-table{width:100%;border-collapse:collapse;}
    table.doc-table thead th{background:#FAF9F5;text-align:left;font-size:11px;font-weight:700;
        color:var(--ink-soft);text-transform:uppercase;letter-spacing:.05em;padding:14px 16px;
        border-bottom:1.5px solid var(--line);}
    table.doc-table tbody tr{border-bottom:1px solid var(--line);transition:.1s ease;}
    table.doc-table tbody tr:last-child{border-bottom:none;}
    table.doc-table tbody tr.editing{background:#FBF3DD;}
    table.doc-table tbody tr.is-new{background:#EAF3ED;}
    table.doc-table td{padding:12px 16px;vertical-align:middle;}
    .row-num{color:var(--ink-soft);font-weight:700;font-size:13px;width:32px;}

    .thumb-cell{width:70px;}
    .video-thumb{width:60px;height:38px;border-radius:7px;background:var(--navy);
        display:flex;align-items:center;justify-content:center;color:var(--gold);flex-shrink:0;}
    .video-thumb svg{width:16px;height:16px;}

    .cell-input{width:100%;border:1.5px solid transparent;border-radius:7px;background:transparent;
        padding:8px 9px;font-size:13.5px;font-family:inherit;color:var(--ink);box-sizing:border-box;}
    .cell-input:read-only{cursor:default;}
    .cell-input:not(:read-only){border-color:var(--navy);background:#fff;box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .cell-input:not(:read-only):focus{outline:none;}

    .actions-cell{white-space:nowrap;}
    .icon-btn{width:34px;height:34px;border-radius:8px;border:1.5px solid var(--line);background:#fff;
        cursor:pointer;display:inline-flex;align-items:center;justify-content:center;margin-right:6px;
        transition:.15s ease;}
    .icon-btn:last-child{margin-right:0;}
    .icon-btn svg{width:15px;height:15px;}
    .icon-btn.i-view{color:var(--blue);border-color:#CFE4F2;}
    .icon-btn.i-view:hover{background:#E4F2FA;}
    .icon-btn.i-edit{color:var(--gold);border-color:#EEDFAE;}
    .icon-btn.i-edit:hover{background:#FBF3DD;}
    .icon-btn.i-edit.active{background:var(--gold);color:#fff;border-color:var(--gold);}
    .icon-btn.i-delete{color:var(--red);border-color:#F2C9C2;}
    .icon-btn.i-delete:hover{background:var(--red-soft);}
    .icon-btn.i-cancel{color:var(--ink-soft);}
    .icon-btn.i-cancel:hover{background:#F0F0F0;}
    .icon-btn:disabled{opacity:.35;cursor:not-allowed;}

    .empty-row td{text-align:center;padding:40px;color:var(--ink-soft);font-size:13.5px;}

    .mdg-actions{display:flex;justify-content:flex-end;margin-top:22px;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;border:none;
        border-radius:8px;padding:13px 28px;font-weight:700;cursor:pointer;font-size:13.5px;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);}

    @media (max-width:820px){
        .table-card{overflow-x:auto;}
        table.doc-table{min-width:700px;}
    }
</style>

@php
$ico = [
    'plus'   => '<path d="M8 3v10M3 8h10"/>',
    'pencil' => '<path d="M11.5 2.5l2 2L5 13l-2.6.6.6-2.6z"/>',
    'trash'  => '<path d="M3 4.5h10M6.2 4.5V3a1 1 0 011-1h1.6a1 1 0 011 1v1.5M4.3 4.5l.6 8a1 1 0 001 .9h4.2a1 1 0 001-.9l.6-8"/>',
    'close'  => '<path d="M4 4l8 8M12 4l-8 8"/>',
    'video'  => '<rect x="2" y="4" width="8" height="8" rx="1.2"/><path d="M10 6.3l4-1.8v7l-4-1.8z"/>',
    'play'   => '<path d="M6 4l6 4-6 4z"/>',
];
@endphp

<div class="mdg-wrap">
    <div class="mdg-crumb">Multimédia</div>
    <h1 class="mdg-title">Vidéos DGAM</h1>
    <p class="mdg-sub">Gère les vidéos YouTube affichées sur le site public.</p>

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

    @if(!$detection_ok)
        <div class="mdg-alert warn">Aucune vidéo enregistrée pour l'instant.</div>
    @endif

    <div class="top-bar">
        <h2>
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $ico['video'] !!}</svg>
            Liste des vidéos (<span id="video-count-num">{{ count($videos) }}</span>)
        </h2>
        <button type="button" class="btn-add-doc" onclick="addVideo()">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">{!! $ico['plus'] !!}</svg>
            Ajouter une vidéo
        </button>
    </div>

    <form method="POST" action="{{ route('videos.update') }}">
        @csrf

        <div class="table-card">
            <table class="doc-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>Lien d'intégration (embed)</th>
                        <th>Titre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="video-tbody">
                    @foreach($videos as $i => $video)
                        <tr data-row>
                            <td class="row-num">{{ $i + 1 }}</td>
                            <td class="thumb-cell">
                                <div class="video-thumb">
                                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">{!! $ico['play'] !!}</svg>
                                </div>
                            </td>
                            <td>
                                <input type="hidden" name="id[]" value="{{ $video['id'] ?? '' }}">
                                <input type="text" class="cell-input" name="url[]" value="{{ $video['url'] }}" placeholder="https://www.youtube.com/embed/XXXXXXXXXXX" readonly>
                            </td>
                            <td>
                                <input type="text" class="cell-input" name="titre[]" value="{{ $video['titre'] }}" placeholder="Titre affiché sous la vidéo" readonly>
                            </td>
                            <td class="actions-cell">
                                @if($video['url'])
                                    <a href="{{ $video['url'] }}" target="_blank" class="icon-btn i-view" title="Voir la vidéo">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z"/><circle cx="8" cy="8" r="2"/></svg>
                                    </a>
                                @endif
                                @if(!empty($video['id']))
                                    <button type="button" class="icon-btn i-edit" onclick="toggleEdit(this)" title="Modifier">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">{!! $ico['pencil'] !!}</svg>
                                    </button>
                                    <button type="submit" form="delete-form-{{ $video['id'] }}" class="icon-btn i-delete"
                                            onclick="return confirm('Supprimer définitivement cette vidéo ?');" title="Supprimer">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">{!! $ico['trash'] !!}</svg>
                                    </button>
                                @else
                                    <button type="button" class="icon-btn i-cancel" onclick="this.closest('tr').remove(); updateCount();" title="Annuler l'ajout">
                                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">{!! $ico['close'] !!}</svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="empty-row" class="empty-row" style="{{ count($videos) > 0 ? 'display:none;' : '' }}">
                <div style="padding:40px;text-align:center;color:var(--ink-soft);font-size:13.5px;">
                    Aucune vidéo pour l'instant. Cliquez sur "Ajouter une vidéo" ci-dessus.
                </div>
            </div>
        </div>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

{{-- Formulaires de suppression individuelle, en dehors du formulaire principal --}}
@foreach($videos as $video)
    @if(!empty($video['id']))
        <form id="delete-form-{{ $video['id'] }}" method="POST" action="{{ route('videos.destroy', $video['id']) }}" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endforeach

<script>
const ICO_PENCIL = '<path d="M11.5 2.5l2 2L5 13l-2.6.6.6-2.6z"/>';
const ICO_CLOSE  = '<path d="M4 4l8 8M12 4l-8 8"/>';
const ICO_PLAY   = '<path d="M6 4l6 4-6 4z"/>';

function toggleEdit(btn) {
    const row = btn.closest('tr');
    const inputs = row.querySelectorAll('.cell-input');
    const isEditing = row.classList.contains('editing');

    if (isEditing) {
        inputs.forEach(i => i.readOnly = true);
        row.classList.remove('editing');
        btn.classList.remove('active');
        btn.innerHTML = '<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">' + ICO_PENCIL + '</svg>';
    } else {
        inputs.forEach(i => i.readOnly = false);
        row.classList.add('editing');
        btn.classList.add('active');
        btn.innerHTML = '<svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">' + ICO_CLOSE + '</svg>';
        inputs[0].focus();
    }
}

function updateCount() {
    const n = document.querySelectorAll('#video-tbody tr[data-row]').length;
    document.getElementById('video-count-num').textContent = n;
    document.getElementById('empty-row').style.display = n === 0 ? 'block' : 'none';
}

function addVideo() {
    const tbody = document.getElementById('video-tbody');
    const num = tbody.querySelectorAll('tr[data-row]').length + 1;

    const tr = document.createElement('tr');
    tr.setAttribute('data-row', '');
    tr.className = 'is-new';
    tr.innerHTML = `
        <td class="row-num">${num}</td>
        <td class="thumb-cell">
            <div class="video-thumb"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">${ICO_PLAY}</svg></div>
        </td>
        <td>
            <input type="hidden" name="id[]" value="">
            <input type="text" class="cell-input" name="url[]" placeholder="https://www.youtube.com/embed/XXXXXXXXXXX">
        </td>
        <td>
            <input type="text" class="cell-input" name="titre[]" placeholder="Titre affiché sous la vidéo">
        </td>
        <td class="actions-cell">
            <button type="button" class="icon-btn i-cancel" onclick="this.closest('tr').remove(); updateCount();" title="Annuler l'ajout">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round">${ICO_CLOSE}</svg>
            </button>
        </td>
    `;
    tbody.appendChild(tr);
    document.getElementById('empty-row').style.display = 'none';
    updateCount();
    tr.querySelector('input[name="url[]"]').focus();
    tr.scrollIntoView({ behavior: 'smooth', block: 'center' });
}
</script>

@endsection