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

    .mdg-wrap{max-width:1100px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-header-flex{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px;flex-wrap:wrap;gap:16px;}
    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);margin:0 0 4px;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}

    /* Table Styles */
    .table-container{background:#fff;border:1.5px solid var(--line);border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.03);}
    .admin-table{width:100%;border-collapse:collapse;text-align:left;font-size:13.5px;}
    .admin-table th{background:var(--navy);color:#fff;padding:14px 18px;font-weight:600;}
    .admin-table td{padding:14px 18px;border-bottom:1px solid var(--line);color:var(--ink);}
    .admin-table tr:last-child td{border-bottom:none;}
    .admin-table tr:hover{background:#FAF9F5;}

    .btn-add{background:var(--navy);color:#fff;border:none;border-radius:8px;padding:10px 18px;font-size:13px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .btn-add:hover{background:var(--navy-2);}

    .btn-act{border:none;background:transparent;padding:6px 10px;border-radius:6px;cursor:pointer;font-weight:600;font-size:12px;}
    .btn-act-edit{color:var(--blue);background:#EBF5FA;}
    .btn-act-edit:hover{background:#D6ECF7;}
    .btn-act-delete{color:#C0392B;background:#FBEAEA;}
    .btn-act-delete:hover{background:#F5D5D5;}

    /* Modal Styles */
    .modal-overlay{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(11,35,64,0.5);display:none;align-items:center;justify-content:center;z-index:1000;}
    .modal-overlay.active{display:flex;}
    .modal-card{background:#fff;border-radius:12px;width:100%;max-width:550px;padding:28px;box-shadow:0 10px 30px rgba(0,0,0,0.2);position:relative;}
    .modal-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:1px solid var(--line);padding-bottom:12px;}
    .modal-head h3{margin:0;color:var(--navy);font-size:18px;}
    .modal-close{background:none;border:none;font-size:20px;cursor:pointer;color:var(--ink-soft);}

    .mdg-field{margin-bottom:16px;}
    .mdg-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;margin-bottom:6px;display:block;}
    .mdg-field input[type=text], .mdg-field textarea, .mdg-field input[type=file]{
        width:100%;border:1.5px solid var(--line);border-radius:8px;padding:10px 12px;font-size:13.5px;box-sizing:border-box;
    }
    .mdg-field textarea{resize:vertical;min-height:80px;}

    .modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:24px;}
    .btn-cancel{background:#E0E0E0;color:#333;border:none;border-radius:6px;padding:9px 16px;cursor:pointer;font-weight:600;}
    .btn-save{background:var(--gold);color:#fff;border:none;border-radius:6px;padding:9px 18px;cursor:pointer;font-weight:700;}
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Communication</div>
    <div class="mdg-header-flex">
        <div>
            <h1 class="mdg-title">Communiqué DGAMP</h1>
            <p class="mdg-sub">Gère la liste des communiqués et documents officiels affichés sur le site public.</p>
        </div>
        <button class="btn-add" onclick="openModal('modalCreate')">+ Ajouter un communiqué</button>
    </div>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">N°</th>
                    <th>Titre du document</th>
                    <th>Description</th>
                    <th style="width: 120px;">Fichier</th>
                    <th style="width: 140px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($communiques as $index => $com)
                    <tr>
                        <td><strong>{{ $index + 1 }}</strong></td>
                        <td><strong>{{ $com->titre }}</strong></td>
                        <td>{{ $com->description ?? 'N/A' }}</td>
                        <td>
                            @if($com->fichier_path)
                                <a href="{{ asset('storage/' . $com->fichier_path) }}" target="_blank" style="color: var(--blue); font-weight: 600;">📄 Voir PDF</a>
                            @else
                                <span style="color:#aaa;">Aucun</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <button class="btn-act btn-act-edit" onclick="openEditModal({{ $com }})">Modifier</button>
                            <form action="{{ route('communiques.destroy', $com->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-act btn-act-delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--ink-soft); padding: 30px;">
                            Aucun communiqué enregistré pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Liens de pagination Laravel -->
    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
        {{ $communiques->links() }}
    </div>
</div>

<!-- MODAL CRÉATION -->
<div class="modal-overlay" id="modalCreate">
    <div class="modal-card">
        <div class="modal-head">
            <h3>Ajouter un communiqué</h3>
            <button class="modal-close" onclick="closeModal('modalCreate')">&times;</button>
        </div>
        <form action="{{ route('communiques.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mdg-field">
                <label class="mdg-label">Titre du document</label>
                <input type="text" name="titre" required placeholder="Ex: Arrêté n°332 du 26 février 2020...">
            </div>
            <div class="mdg-field">
                <label class="mdg-label">Description</label>
                <textarea name="description" placeholder="Description courte du document..."></textarea>
            </div>
            <div class="mdg-field">
                <label class="mdg-label">Fichier PDF</label>
                <input type="file" name="fichier" accept="application/pdf" required>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('modalCreate')">Annuler</button>
                <button type="submit" class="btn-save">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL ÉDITION -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-card">
        <div class="modal-head">
            <h3>Modifier le communiqué</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mdg-field">
                <label class="mdg-label">Titre du document</label>
                <input type="text" name="titre" id="edit_titre" required>
            </div>
            <div class="mdg-field">
                <label class="mdg-label">Description</label>
                <textarea name="description" id="edit_description"></textarea>
            </div>
            <div class="mdg-field">
                <label class="mdg-label">Fichier PDF (Laissez vide pour conserver l'actuel)</label>
                <input type="file" name="fichier" accept="application/pdf">
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('modalEdit')">Annuler</button>
                <button type="submit" class="btn-save">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.add('active');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}

function openEditModal(com) {
    document.getElementById('editForm').action = '/admin/communiques/' + com.id;
    document.getElementById('edit_titre').value = com.titre;
    document.getElementById('edit_description').value = com.description || '';
    openModal('modalEdit');
}
</script>

@endsection