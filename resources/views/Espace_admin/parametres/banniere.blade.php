@extends('Espace_admin.layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="admin-page-container">

    <div class="admin-page-header d-flex-between">
        <div>
            <h1 class="admin-title">Gestion des Bannières</h1>
            <p class="admin-subtitle">Gérez les images et les textes défilants de la bannière principale du site.</p>
        </div>
        <button type="button" class="btn-custom btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addBannerModal">
            <i class="fas fa-plus"></i> Ajouter une bannière
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
                            <th style="width: 120px;">Image</th>
                            <th>Titre / Texte</th>
                            <th style="width: 100px;">Ordre</th>
                            <th style="width: 100px;">Statut</th>
                            <th style="width: 150px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banners as $banner)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Bannière" class="banner-img-preview">
                                </td>
                                <td class="fw-bold">{!! $banner->titre !!}</td>
                                <td>{{ $banner->ordre }}</td>
                                <td>
                                    @if($banner->is_active)
                                        <span class="badge-status badge-active">Actif</span>
                                    @else
                                        <span class="badge-status badge-inactive">Inactif</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <button type="button" class="btn-icon btn-edit-icon btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editBannerModal"
                                            data-id="{{ $banner->id }}"
                                            data-titre="{!! htmlspecialchars($banner->titre, ENT_QUOTES) !!}"
                                            data-ordre="{{ $banner->ordre }}"
                                            data-active="{{ $banner->is_active }}"
                                            data-image="{{ asset('storage/' . $banner->image) }}"
                                            title="Modifier">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <form action="{{ route('banniere.destroy', $banner->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
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
                                <td colspan="5" class="text-center-empty">Aucune bannière enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout -->
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('banniere.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ajouter une bannière</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label>Titre / Texte défilant</label>
                        <textarea name="titre" id="add_titre_editor" class="input-custom" rows="4"></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label>Image (Format recommandé : 1920x600)</label>
                        <input type="file" name="image" class="input-file-custom" accept="image/*" required>
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
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Modifier la bannière</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label>Titre / Texte défilant</label>
                        <textarea name="titre" id="edit_titre_editor" class="input-custom" rows="4"></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label>Image actuelle</label>
                        <div class="preview-area-sm">
                            <img id="edit_preview" src="" alt="Aperçu">
                        </div>
                        <label style="margin-top: 10px;">Remplacer l'image (optionnel)</label>
                        <input type="file" name="image" class="input-file-custom" accept="image/*">
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

<!-- Script CDN CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<style>
    /* Intégration et visibilité des modales */
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

    /* Fix pour l'affichage de l'éditeur CKEditor dans la modale */
    .ck-editor__editable_inline { min-height: 120px; color: #2d3748; }

    /* Styles de base de la page admin */
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
    .banner-img-preview { width: 80px; height: 48px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; }

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
    .input-file-custom { font-size: 0.8rem; width: 100%; color: #4a5568; }

    .row-custom { display: flex; gap: 15px; }
    .half-width { flex: 1; }
    .align-checkbox { display: flex; align-items: flex-end; padding-bottom: 8px; }
    .checkbox-container { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #4a5568; cursor: pointer; }

    .preview-area-sm { height: 70px; display: flex; align-items: center; justify-content: flex-start; }
    .preview-area-sm img { max-height: 100%; max-width: 120px; border-radius: 6px; border: 1px solid #cbd5e0; object-fit: cover; }

    .btn-custom { padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; text-decoration: none; }
    .btn-primary-custom { background: #1361b5; color: white; }
    .btn-primary-custom:hover { background: #0e4b8e; }
    .btn-secondary-custom { background: #edf2f7; color: #4a5568; }
    .btn-secondary-custom:hover { background: #e2e8f0; }

    .text-center-empty { text-align: center; color: #a0aec0; padding: 30px 0 !important; }
    .d-inline-block { display: inline-block; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let addEditor, editEditor;

    // Configuration de la barre d'outils
    const editorConfig = {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo' ]
    };

    // Initialisation CKEditor pour l'ajout
    ClassicEditor
        .create(document.querySelector('#add_titre_editor'), editorConfig)
        .then(editor => { addEditor = editor; })
        .catch(error => { console.error(error); });

    // Initialisation CKEditor pour la modification
    ClassicEditor
        .create(document.querySelector('#edit_titre_editor'), editorConfig)
        .then(editor => { editEditor = editor; })
        .catch(error => { console.error(error); });

    // Injection des données dans la modale d'édition
    const editButtons = document.querySelectorAll('.btn-edit');
    const editForm = document.getElementById('editBannerForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const titre = this.getAttribute('data-titre');
            const ordre = this.getAttribute('data-ordre');
            const active = this.getAttribute('data-active') === '1';
            const image = this.getAttribute('data-image');

            editForm.action = `/admin/banniere/${id}`;
            document.getElementById('edit_ordre').value = ordre;
            document.getElementById('edit_active').checked = active;
            document.getElementById('edit_preview').src = image;

            if (editEditor) {
                // Décodage propre des entités HTML pour éviter d'échapper à nouveau
                const txt = document.createElement('textarea');
                txt.innerHTML = titre;
                editEditor.setData(txt.value);
            }
        });
    });
});
</script>
@endsection