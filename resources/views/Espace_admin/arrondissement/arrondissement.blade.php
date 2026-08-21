@extends('Espace_admin.layout')

@section('content')

<!-- Summernote & jQuery pour la modale -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<style>
    .admin-container { max-width: 1200px; margin: 0 auto; padding: 25px 15px; }
    .admin-card { background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .btn-main { background: #0B2340; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; }
    .btn-main:hover { background: #1361b5; color: #fff; }
    .btn-edit { background: #f1f5f9; color: #0B2340; border: 1px solid #cbd5e1; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; cursor: pointer; margin-right: 6px; }
    .btn-edit:hover { background: #e2e8f0; }
    .btn-danger-sm { background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 13px; cursor: pointer; font-weight: 600; }
    .btn-danger-sm:hover { background: #dc2626; }
    
    .custom-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
    .custom-table th { background: #f8fafc; color: #0B2340; font-weight: 700; padding: 14px; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
    .custom-table td { padding: 14px; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; }
    .thumb-img { width: 60px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0; }
    .slug-badge { background: #f1f5f9; color: #64748b; padding: 4px 8px; border-radius: 4px; font-family: monospace; font-size: 12px; }

    /* Modern Modal Overlay & Container */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 9999; justify-content: center; align-items: center; padding: 20px; }
    .modal-overlay.active { display: flex; }
    
    .modal-content { 
        background: #ffffff; 
        width: 100%; 
        max-width: 900px; 
        max-height: 85vh; 
        border-radius: 16px; 
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); 
        display: flex; 
        flex-direction: column; 
        overflow: hidden; 
        animation: modalFadeIn 0.25s ease-out; 
    }
    @keyframes modalFadeIn { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }
    
    .modal-header { padding: 18px 25px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-shrink: 0; }
    .modal-header h3 { margin: 0; color: #0B2340; font-size: 18px; font-weight: 700; }
    .btn-close { background: none; border: none; font-size: 22px; color: #64748b; cursor: pointer; padding: 0; line-height: 1; }
    .btn-close:hover { color: #0f172a; }
    
    /* Intégration Flexbox pour garder le Form et Footer sous contrôle */
    .modal-content form { display: flex; flex-direction: column; height: 100%; overflow: hidden; margin: 0; }
    .modal-body { padding: 25px; overflow-y: auto; flex: 1 1 auto; }
    .modal-footer { padding: 15px 25px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px; flex-shrink: 0; }
    
    .form-label { font-weight: 600; color: #0B2340; margin-bottom: 8px; display: block; font-size: 14px; }
    .form-control-custom { width: 100%; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 14px; font-size: 14px; outline: none; box-sizing: border-box; }
    .form-control-custom:focus { border-color: #0B2340; box-shadow: 0 0 0 3px rgba(11,35,64,0.1); }
    
    .note-editor.note-frame { border: 1px solid #cbd5e1 !important; border-radius: 8px !important; }
</style>

<div class="admin-container">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #0B2340; font-weight: 700; margin: 0 0 5px 0;">Gestion des Arrondissements</h2>
            <p style="color: #64748b; margin: 0; font-size: 14px;">Gérez la présentation et les informations de chaque arrondissement.</p>
        </div>
        <a href="{{ route('arrondissements.create') }}" class="btn-main">
            <span>+</span> <span>Nouvel Arrondissement</span>
        </a>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600;">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-card">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Image</th>
                    <th>Titre</th>
                    <th>Slug</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($arrondissements as $arr)
                    <tr>
                        <td>
                            @if($arr->image)
                                <img src="{{ asset('storage/' . $arr->image) }}" alt="{{ $arr->titre }}" class="thumb-img">
                            @else
                                <span style="color: #94a3b8; font-size: 12px; font-style: italic;">Aucune</span>
                            @endif
                        </td>
                        <td><strong style="color: #0B2340; font-size: 15px;">{{ $arr->titre }}</strong></td>
                        <td><span class="slug-badge">{{ $arr->slug }}</span></td>
                        <td style="text-align: right;">
                            <button type="button" 
                                    class="btn-edit" 
                                    onclick="openEditModal({{ $arr->id }}, '{{ addslashes($arr->titre) }}', '{{ $arr->image ? asset('storage/' . $arr->image) : '' }}', {{ json_encode($arr->description) }})">
                                Éditer
                            </button>
                            
                            <form action="{{ route('arrondissements.destroy', $arr->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8;">
                            Aucun arrondissement enregistré pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($arrondissements->hasPages())
            <div style="margin-top: 20px;">
                {{ $arrondissements->links() }}
            </div>
        @endif
    </div>
</div>

<!-- ========================================== -->
<!-- MODALE DE MODIFICATION SCROLLABLE          -->
<!-- ========================================== -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Modifier l'Arrondissement</h3>
            <button class="btn-close" onclick="closeEditModal()">&times;</button>
        </div>
        
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Titre de l'Arrondissement</label>
                    <input type="text" id="edit_titre" name="titre" class="form-control-custom" required>
                </div>

                <div style="margin-bottom: 20px;">
                    <label class="form-label">Changer l'image principale (Optionnel)</label>
                    <input type="file" name="image" class="form-control-custom" accept="image/*">
                    <div id="current_image_container" style="margin-top: 10px; display: none;">
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 4px;">Image actuelle :</p>
                        <img id="edit_image_preview" src="" style="width: 120px; height: 75px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <div style="margin-bottom: 10px;">
                    <label class="form-label">Description & Contenu</label>
                    <textarea id="edit_editor" name="description"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-edit" onclick="closeEditModal()" style="padding: 10px 18px;">Annuler</button>
                <button type="submit" class="btn-main" style="background: #16a34a;">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#edit_editor').summernote({
        placeholder: 'Contenu de l\'arrondissement...',
        tabsize: 2,
        height: 220,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview']]
        ],
        callbacks: {
            onImageUpload: function(files) {
                uploadModalImage(files[0]);
            }
        }
    });

    function uploadModalImage(file) {
        let data = new FormData();
        data.append("image", file);
        data.append("_token", "{{ csrf_token() }}");

        $.ajax({
            url: "{{ route('arrondissements.upload_image') }}",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(response) {
                $('#edit_editor').summernote('insertImage', response.url);
            },
            error: function() {
                alert("Erreur lors de l'envoi de l'image.");
            }
        });
    }
});

function openEditModal(id, titre, imageUrl, description) {
    let updateUrl = "{{ route('arrondissements.update', ':id') }}".replace(':id', id);
    $('#editForm').attr('action', updateUrl);

    $('#edit_titre').val(titre);
    $('#edit_editor').summernote('code', description);

    if(imageUrl && imageUrl !== '') {
        $('#edit_image_preview').attr('src', imageUrl);
        $('#current_image_container').show();
    } else {
        $('#current_image_container').hide();
    }

    $('#editModal').addClass('active');
}

function closeEditModal() {
    $('#editModal').removeClass('active');
}

$(window).on('click', function(e) {
    if ($(e.target).is('#editModal')) {
        closeEditModal();
    }
});
</script>

@endsection