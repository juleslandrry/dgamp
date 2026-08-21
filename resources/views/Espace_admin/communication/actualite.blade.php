@extends('Espace_admin.layout')
@section('content')

<!-- Integration CKEditor 5 via CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<style>
    :root{
        --navy:#0B2340;
        --navy-2:#123A63;
        --blue:#1E7FB8;
        --orange:#E8720C;
        --green:#1F7A4D;
        --gold:#C9A227;
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

    /* Alerts */
    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert-danger{background:#FDF2F2;border-left:4px solid #C0392B;color:#C0392B;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert-danger ul{margin:5px 0 0 18px;padding:0;}

    .invalid-feedback{color:#C0392B;font-size:11.5px;margin-top:4px;display:block;}

    /* Table Styles */
    .table-container{background:#fff;border:1.5px solid var(--line);border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.03);}
    .admin-table{width:100%;border-collapse:collapse;text-align:left;font-size:13.5px;}
    .admin-table th{background:var(--navy);color:#fff;padding:14px 18px;font-weight:600;}
    .admin-table td{padding:14px 18px;border-bottom:1px solid var(--line);color:var(--ink);vertical-align:middle;}
    .admin-table tr:last-child td{border-bottom:none;}
    .admin-table tr:hover{background:#FAF9F5;}

    .img-thumb{width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid var(--line);}
    .badge-cat{background:#EBF5FA;color:var(--blue);padding:4px 8px;border-radius:4px;font-size:11px;font-weight:700;}

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
    .modal-card{background:#fff;border-radius:12px;width:100%;max-width:700px;padding:28px;box-shadow:0 10px 30px rgba(0,0,0,0.2);position:relative;max-height:90vh;overflow-y:auto;}
    .modal-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:1px solid var(--line);padding-bottom:12px;}
    .modal-head h3{margin:0;color:var(--navy);font-size:18px;}
    .modal-close{background:none;border:none;font-size:20px;cursor:pointer;color:var(--ink-soft);}

    .mdg-field{margin-bottom:16px;}
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
    .mdg-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;margin-bottom:6px;display:block;}
    .mdg-field input[type=text], .mdg-field input[type=date], .mdg-field input[type=file]{
        width:100%;border:1.5px solid var(--line);border-radius:8px;padding:10px 12px;font-size:13.5px;box-sizing:border-box;
    }

    .ck-editor__editable_inline { min-height: 180px; }

    .modal-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:24px;}
    .btn-cancel{background:#E0E0E0;color:#333;border:none;border-radius:6px;padding:9px 16px;cursor:pointer;font-weight:600;}
    .btn-save{background:var(--gold);color:#fff;border:none;border-radius:6px;padding:9px 18px;cursor:pointer;font-weight:700;}
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Communication</div>
    <div class="mdg-header-flex">
        <div>
            <h1 class="mdg-title">Actualités DGAMP</h1>
            <p class="mdg-sub">Gère la liste des articles d'actualité affichés sur le site public.</p>
        </div>
        <button class="btn-add" onclick="openModal('modalCreate')">+ Ajouter une actualité</button>
    </div>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    {{-- Affichage global des erreurs de validation --}}
    @if($errors->any())
        <div class="mdg-alert-danger">
            <strong>Oups ! Attention aux erreurs de saisie :</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 60px;">Image</th>
                    <th>Titre de l'article</th>
                    <th>Catégorie</th>
                    <th>Date de publication</th>
                    <th style="width: 140px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actualites as $art)
                    <tr>
                        <td>
                            @if($art->image_path)
                                <img src="{{ asset('storage/' . $art->image_path) }}" class="img-thumb" alt="Miniature">
                            @else
                                <span style="color:#aaa; font-size: 11px;">Pas d'image</span>
                            @endif
                        </td>
                        <td><strong>{{ $art->titre }}</strong></td>
                        <td>
                            @if($art->categorie)
                                <span class="badge-cat">{{ $art->categorie }}</span>
                            @else
                                <span style="color:#aaa;">-</span>
                            @endif
                        </td>
                        <td>{{ $art->date_publication ? \Carbon\Carbon::parse($art->date_publication)->format('d/m/Y') : 'Non précisée' }}</td>
                        <td style="text-align: right;">
                            <button class="btn-act btn-act-edit" onclick="openEditModal({{ $art }})">Modifier</button>
                            <form action="{{ route('actualites.destroy', $art->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-act btn-act-delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--ink-soft); padding: 30px;">
                            Aucune actualité enregistrée pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
        {{ $actualites->links() }}
    </div>
</div>

<!-- MODAL CRÉATION -->
<div class="modal-overlay" id="modalCreate">
    <div class="modal-card">
        <div class="modal-head">
            <h3>Ajouter un article</h3>
            <button class="modal-close" onclick="closeModal('modalCreate')">&times;</button>
        </div>
        <form action="{{ route('actualites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mdg-field">
                <label class="mdg-label">Titre de l'article <span style="color:red;">*</span></label>
                <input type="text" name="titre" value="{{ old('titre') }}" required placeholder="Titre de l'actualité">
                @error('titre') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mdg-row2">
                <div class="mdg-field">
                    <label class="mdg-label">Catégorie</label>
                    <input type="text" name="categorie" value="{{ old('categorie') }}" placeholder="Ex: RENCONTRE, FORMATION">
                    @error('categorie') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mdg-field">
                    <label class="mdg-label">Date de publication</label>
                    <input type="date" name="date_publication" value="{{ old('date_publication') }}">
                    @error('date_publication') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mdg-field">
                <label class="mdg-label">Description <span style="color:red;">*</span></label>
                <textarea name="description" id="create_description">{{ old('description') }}</textarea>
                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mdg-field">
                <label class="mdg-label">Photo de l'article</label>
                <input type="file" name="image" accept="image/*">
                @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
            <h3>Modifier l'article</h3>
            <button class="modal-close" onclick="closeModal('modalEdit')">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mdg-field">
                <label class="mdg-label">Titre de l'article <span style="color:red;">*</span></label>
                <input type="text" name="titre" id="edit_titre" required>
                @error('titre') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mdg-row2">
                <div class="mdg-field">
                    <label class="mdg-label">Catégorie</label>
                    <input type="text" name="categorie" id="edit_categorie">
                    @error('categorie') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                <div class="mdg-field">
                    <label class="mdg-label">Date de publication</label>
                    <input type="date" name="date_publication" id="edit_date">
                    @error('date_publication') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mdg-field">
                <label class="mdg-label">Description <span style="color:red;">*</span></label>
                <textarea name="description" id="edit_description"></textarea>
                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mdg-field">
                <label class="mdg-label">Changer la photo (Optionnel)</label>
                <input type="file" name="image" accept="image/*">
                @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('modalEdit')">Annuler</button>
                <button type="submit" class="btn-save">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<script>
let editorCreate, editorEdit;

document.addEventListener('DOMContentLoaded', () => {
    ClassicEditor
        .create(document.querySelector('#create_description'))
        .then(editor => { editorCreate = editor; })
        .catch(error => { console.error(error); });

    ClassicEditor
        .create(document.querySelector('#edit_description'))
        .then(editor => { editorEdit = editor; })
        .catch(error => { console.error(error); });

    // Si des erreurs de validation existent lors de la soumission d'un formulaire, ré-ouvrir la modale
    @if($errors->any())
        openModal('modalCreate');
    @endif
});

function openModal(id) {
    document.getElementById(id).classList.add('active');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}

function openEditModal(art) {
    document.getElementById('editForm').action = '/admin/actualites/' + art.id;
    document.getElementById('edit_titre').value = art.titre;
    document.getElementById('edit_categorie').value = art.categorie || '';
    document.getElementById('edit_date').value = art.date_publication || '';
    
    if (editorEdit) {
        editorEdit.setData(art.description || '');
    }

    openModal('modalEdit');
}
</script>

@endsection