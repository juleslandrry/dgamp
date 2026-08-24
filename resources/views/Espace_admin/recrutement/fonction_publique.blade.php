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
    .btn-add-doc{background:var(--navy);color:#fff;border:none;border-radius:8px;
        padding:11px 20px;font-size:13px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .btn-add-doc:hover{background:#123A63;transform:translateY(-1px);}

    /* Table */
    .table-card{background:#fff;border:1.5px solid var(--line);border-radius:14px;overflow:hidden;
        box-shadow:0 3px 14px rgba(11,35,64,.04);}
    table.doc-table{width:100%;border-collapse:collapse;}
    table.doc-table thead th{background:#FAF9F5;text-align:left;font-size:11px;font-weight:700;
        color:var(--ink-soft);text-transform:uppercase;letter-spacing:.05em;padding:14px 16px;
        border-bottom:1.5px solid var(--line);}
    table.doc-table tbody tr{border-bottom:1px solid var(--line);transition:.1s ease;}
    table.doc-table tbody tr:last-child{border-bottom:none;}
    table.doc-table tbody tr.editing{background:var(--gold-soft,#FBF3DD);}
    table.doc-table tbody tr.is-new{background:#EAF3ED;}
    table.doc-table td{padding:12px 16px;vertical-align:middle;}
    .row-num{color:var(--ink-soft);font-weight:700;font-size:13px;width:32px;}

    .cell-input{width:100%;border:1.5px solid transparent;border-radius:7px;background:transparent;
        padding:8px 9px;font-size:13.5px;font-family:inherit;color:var(--ink);box-sizing:border-box;}
    .cell-input:read-only{cursor:default;}
    .cell-input:not(:read-only){border-color:var(--navy);background:#fff;box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .cell-input:not(:read-only):focus{outline:none;}

    .pdf-cell{white-space:nowrap;}
    .pdf-link{color:var(--green);font-size:12px;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:4px;}
    .pdf-link:hover{text-decoration:underline;}
    .pdf-empty{color:var(--ink-soft);font-size:12px;font-style:italic;}
    .pdf-file-input{font-size:11.5px;margin-top:6px;display:none;max-width:180px;}

    .actions-cell{white-space:nowrap;}
    .icon-btn{width:34px;height:34px;border-radius:8px;border:1.5px solid var(--line);background:#fff;
        cursor:pointer;display:inline-flex;align-items:center;justify-content:center;margin-right:6px;
        font-size:14px;transition:.15s ease;}
    .icon-btn:last-child{margin-right:0;}
    .icon-btn.i-view{color:var(--blue);border-color:#CFE4F2;}
    .icon-btn.i-view:hover{background:#E4F2FA;}
    .icon-btn.i-edit{color:var(--gold);border-color:#EEDFAE;}
    .icon-btn.i-edit:hover{background:#FBF3DD;}
    .icon-btn.i-edit.active{background:var(--gold);color:#fff;border-color:var(--gold);}
    .icon-btn.i-delete{color:var(--red);border-color:#F2C9C2;}
    .icon-btn.i-delete:hover{background:var(--red-soft);}
    .icon-btn.i-cancel{color:var(--ink-soft);}
    .icon-btn.i-cancel:hover{background:#F0F0F0;}

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

<div class="mdg-wrap">
    <div class="mdg-crumb">Recrutement</div>
    <h1 class="mdg-title">Fonction Publique</h1>
    <p class="mdg-sub">Gère la liste des documents relatifs à la Fonction Publique.</p>

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
        <h2>📋 Liste des documents ({{ count($documents) }})</h2>
        <button type="button" class="btn-add-doc" onclick="addDocument()">+ Ajouter un document</button>
    </div>

    <form method="POST" action="{{ route('fonction-publique.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="table-card">
            <table class="doc-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Référence</th>
                        <th>Description / Intitulé</th>
                        <th>PDF</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="fp-tbody">
                    @foreach($documents as $i => $doc)
                        <tr data-row>
                            <td class="row-num">{{ $i + 1 }}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{ $doc['id'] ?? '' }}">
                                <input type="text" class="cell-input" name="reference[]" value="{{ $doc['reference'] }}" placeholder="Référence" readonly>
                            </td>
                            <td>
                                <input type="text" class="cell-input" name="intitule[]" value="{{ $doc['intitule'] }}" placeholder="Description" readonly>
                            </td>
                            <td class="pdf-cell">
                                @if($doc['lien'])
                                    <a href="{{ asset($doc['lien']) }}" target="_blank" class="pdf-link">📄 Voir</a>
                                @else
                                    <span class="pdf-empty">Aucun fichier</span>
                                @endif
                                <input type="file" name="fichier[]" accept="application/pdf" class="pdf-file-input">
                            </td>
                            <td class="actions-cell">
                                @if(!empty($doc['id']))
                                    <button type="button" class="icon-btn i-edit" onclick="toggleEdit(this)" title="Modifier">✏️</button>
                                    <button type="submit" form="delete-form-{{ $doc['id'] }}" class="icon-btn i-delete"
                                            onclick="return confirm('Supprimer définitivement ce document ?');" title="Supprimer">🗑️</button>
                                @else
                                    <button type="button" class="icon-btn i-cancel" onclick="this.closest('tr').remove(); updateCount();" title="Annuler l'ajout">✖️</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="empty-row" class="empty-row" style="{{ count($documents) > 0 ? 'display:none;' : '' }}">
                <div style="padding:40px;text-align:center;color:var(--ink-soft);font-size:13.5px;">
                    Aucun document pour l'instant. Cliquez sur "+ Ajouter un document" ci-dessus.
                </div>
            </div>
        </div>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

{{-- Formulaires de suppression individuelle, en dehors du formulaire principal --}}
@foreach($documents as $doc)
    @if(!empty($doc['id']))
        <form id="delete-form-{{ $doc['id'] }}" method="POST" action="{{ route('fonction-publique.destroy', $doc['id']) }}" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endif
@endforeach

<script>
function toggleEdit(btn) {
    const row = btn.closest('tr');
    const inputs = row.querySelectorAll('.cell-input');
    const pdfInput = row.querySelector('.pdf-file-input');
    const isEditing = row.classList.contains('editing');

    if (isEditing) {
        inputs.forEach(i => i.readOnly = true);
        pdfInput.style.display = 'none';
        row.classList.remove('editing');
        btn.classList.remove('active');
        btn.textContent = '✏️';
    } else {
        inputs.forEach(i => i.readOnly = false);
        pdfInput.style.display = 'block';
        row.classList.add('editing');
        btn.classList.add('active');
        btn.textContent = '🔓';
        inputs[0].focus();
    }
}

function updateCount() {
    const n = document.querySelectorAll('#fp-tbody tr[data-row]').length;
    document.querySelector('.top-bar h2').innerHTML = '📋 Liste des documents (' + n + ')';
    document.getElementById('empty-row').style.display = n === 0 ? 'block' : 'none';
}

function addDocument() {
    const tbody = document.getElementById('fp-tbody');
    const num = tbody.querySelectorAll('tr[data-row]').length + 1;

    const tr = document.createElement('tr');
    tr.setAttribute('data-row', '');
    tr.className = 'is-new';
    tr.innerHTML = `
        <td class="row-num">${num}</td>
        <td>
            <input type="hidden" name="id[]" value="">
            <input type="text" class="cell-input" name="reference[]" placeholder="Référence">
        </td>
        <td>
            <input type="text" class="cell-input" name="intitule[]" placeholder="Description">
        </td>
        <td class="pdf-cell">
            <span class="pdf-empty">Nouveau</span>
            <input type="file" name="fichier[]" accept="application/pdf" class="pdf-file-input" style="display:block;">
        </td>
        <td class="actions-cell">
            <button type="button" class="icon-btn i-cancel" onclick="this.closest('tr').remove(); updateCount();" title="Annuler l'ajout">✖️</button>
        </td>
    `;
    tbody.appendChild(tr);
    document.getElementById('empty-row').style.display = 'none';
    updateCount();
    tr.querySelector('input[name="reference[]"]').focus();
    tr.scrollIntoView({ behavior: 'smooth', block: 'center' });
}
</script>

@endsection