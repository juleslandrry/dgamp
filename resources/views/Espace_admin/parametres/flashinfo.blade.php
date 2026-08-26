@extends('Espace_admin.layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="admin-page-container">

    <div class="admin-page-header d-flex-between">
        <div>
            <h1 class="admin-title">Gestion des Flash Infos</h1>
            <p class="admin-subtitle">Gérez les messages d'alerte et annonces qui défilent sur le site.</p>
        </div>
        <button type="button" class="btn-custom btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addFlashModal">
            <i class="fas fa-plus"></i> Ajouter un message
        </button>
    </div>

    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <span><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif

    <div class="admin-card">
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Contenu du message</th>
                            <th style="width: 200px;">Lien</th>
                            <th style="width: 100px;">Ordre</th>
                            <th style="width: 100px;">Statut</th>
                            <th style="width: 150px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($flashInfos as $info)
                            <tr>
                                <td>{{ $info->contenu }}</td>
                                <td>
                                    @if($info->lien)
                                        <a href="{{ $info->lien }}" target="_blank" class="text-link"><i class="fas fa-external-link-alt"></i> Voir le lien</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $info->ordre }}</td>
                                <td>
                                    @if($info->is_active)
                                        <span class="badge-status badge-active">Actif</span>
                                    @else
                                        <span class="badge-status badge-inactive">Inactif</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <button type="button" class="btn-icon btn-edit-icon btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editFlashModal"
                                            data-id="{{ $info->id }}"
                                            data-contenu="{{ $info->contenu }}"
                                            data-lien="{{ $info->lien }}"
                                            data-ordre="{{ $info->ordre }}"
                                            data-active="{{ $info->is_active }}"
                                            title="Modifier">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <form action="{{ route('flash_info.destroy', $info->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete-icon" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center-empty">Aucun message d'information enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout -->
<div class="modal fade" id="addFlashModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('flash_info.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ajouter un Flash Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label>Texte du message</label>
                        <textarea name="contenu" class="input-custom" rows="3" placeholder="Saisissez votre annonce..." required></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label>Lien de redirection (Optionnel)</label>
                        <input type="url" name="lien" class="input-custom" placeholder="https://exemple.com">
                    </div>
                    <div class="row-custom">
                        <div class="form-group-custom half-width">
                            <label>Ordre d'affichage</label>
                            <input type="number" name="ordre" class="input-custom" value="0">
                        </div>
                        <div class="form-group-custom half-width align-checkbox">
                            <label class="checkbox-container">
                                <input type="checkbox" name="is_active" value="1" checked>
                                <span>Publier directement</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-custom btn-secondary-custom" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-custom btn-primary-custom">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modification -->
<div class="modal fade" id="editFlashModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form id="editFlashForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Modifier le Flash Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label>Texte du message</label>
                        <textarea name="contenu" id="edit_contenu" class="input-custom" rows="3" required></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label>Lien de redirection (Optionnel)</label>
                        <input type="url" name="lien" id="edit_lien" class="input-custom">
                    </div>
                    <div class="row-custom">
                        <div class="form-group-custom half-width">
                            <label>Ordre d'affichage</label>
                            <input type="number" name="ordre" id="edit_ordre" class="input-custom">
                        </div>
                        <div class="form-group-custom half-width align-checkbox">
                            <label class="checkbox-container">
                                <input type="checkbox" name="is_active" id="edit_active" value="1">
                                <span>Publier</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-custom btn-secondary-custom" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-custom btn-primary-custom">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .modal { display: none; position: fixed; top: 0; left: 0; z-index: 1055; width: 100%; height: 100%; overflow-x: hidden; overflow-y: auto; outline: 0; background: rgba(0,0,0,0.5); }
    .modal.show { display: block; }
    .modal-dialog { position: relative; width: auto; margin: 0.5rem; pointer-events: none; }
    .modal-dialog-centered { display: flex; align-items: center; min-height: calc(100% - 1rem); }
    .modal-lg { max-width: 700px; }
    @media (min-width: 576px) {
        .modal-dialog { margin: 1.75rem auto; }
        .modal-dialog-centered { min-height: calc(100% - 3.5rem); }
    }
    .modal-content { position: relative; display: flex; flex-direction: column; width: 100%; pointer-events: auto; background-color: #fff; border-radius: 12px; outline: 0; padding: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
    .modal-header { display: flex; align-items: center; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px solid #edf2f7; }
    .modal-title { margin: 0; font-size: 1.15rem; color: #1a202c; font-weight: 700; }
    .modal-body { padding: 20px 0; }
    .modal-footer { display: flex; justify-content: flex-end; gap: 10px; padding-top: 15px; border-top: 1px solid #edf2f7; }
    .btn-close { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: #a0aec0; }
    .btn-close::after { content: "✕"; }

    .admin-page-container { padding: 25px; font-family: 'Inter', system-ui, sans-serif; color: #2d3748; }
    .admin-page-header { margin-bottom: 25px; }
    .d-flex-between { display: flex; justify-content: space-between; align-items: center; }
    .admin-title { font-size: 1.6rem; font-weight: 700; color: #1a202c; margin: 0 0 5px 0; }
    .admin-subtitle { color: #718096; font-size: 0.9rem; margin: 0; }

    .alert-custom { padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .alert-success-custom { background: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; }
    .close-alert { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: inherit; }

    .admin-card { background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; overflow: hidden; }
    .admin-card-body { padding: 20px 24px; }
    .p-0 { padding: 0 !important; }

    .table-custom { width: 100%; border-collapse: collapse; }
    .table-custom th { background-color: #f8fafc; color: #4a5568; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; padding: 16px 20px; border-bottom: 1px solid #edf2f7; text-align: left; }
    .table-custom td { padding: 16px 20px; vertical-align: middle; border-bottom: 1px solid #edf2f7; font-size: 0.9rem; }

    .badge-status { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
    .badge-active { background: #c6f6d5; color: #22543d; }
    .badge-inactive { background: #edf2f7; color: #718096; }

    .btn-icon { width: 34px; height: 34px; border-radius: 6px; border: none; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; font-size: 0.85rem; }
    .btn-edit-icon { background: #ebf8ff; color: #3182ce; margin-right: 5px; }
    .btn-edit-icon:hover { background: #bee3f8; }
    .btn-delete-icon { background: #fff5f5; color: #e53e3e; }
    .btn-delete-icon:hover { background: #fed7d7; }

    .form-group-custom { margin-bottom: 18px; }
    .form-group-custom label { display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 6px; color: #4a5568; }
    .input-custom { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.9rem; outline: none; transition: 0.2s; box-sizing: border-box; }
    .input-custom:focus { border-color: #1361b5; box-shadow: 0 0 0 3px rgba(19, 97, 181, 0.15); }

    .row-custom { display: flex; gap: 15px; }
    .half-width { flex: 1; }
    .align-checkbox { display: flex; align-items: flex-end; padding-bottom: 8px; }
    .checkbox-container { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #4a5568; cursor: pointer; }

    .btn-custom { padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; text-decoration: none; }
    .btn-primary-custom { background: #1361b5; color: white; }
    .btn-primary-custom:hover { background: #0e4b8e; }
    .btn-secondary-custom { background: #edf2f7; color: #4a5568; }
    .btn-secondary-custom:hover { background: #e2e8f0; }

    .text-center-empty { text-align: center; color: #a0aec0; padding: 30px 0 !important; }
    .text-link { color: #3182ce; text-decoration: none; font-size: 0.85rem; }
    .text-link:hover { text-decoration: underline; }
    .text-muted { color: #a0aec0; }
    .d-inline-block { display: inline-block; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit');
    const editForm = document.getElementById('editFlashForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const contenu = this.getAttribute('data-contenu');
            const lien = this.getAttribute('data-lien');
            const ordre = this.getAttribute('data-ordre');
            const active = this.getAttribute('data-active') === '1';

            editForm.action = `/admin/flash-info/${id}`;
            document.getElementById('edit_contenu').value = contenu;
            document.getElementById('edit_lien').value = lien || '';
            document.getElementById('edit_ordre').value = ordre;
            document.getElementById('edit_active').checked = active;
        });
    });
});
</script>
@endsection