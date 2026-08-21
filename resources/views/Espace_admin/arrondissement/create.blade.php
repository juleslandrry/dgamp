@extends('Espace_admin.layout') {{-- Vérifie bien le nom de ton layout admin --}}

@section('content')

<!-- Summernote (Bibliothèque WYSIWYG avec support images) -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<style>
    .admin-container { max-width: 1000px; margin: 0 auto; padding: 25px 15px; }
    .admin-card { background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .form-label { font-weight: 600; color: #0B2340; margin-bottom: 8px; display: block; font-size: 14px; }
    .form-control-custom { width: 100%; border: 1px solid #cbd5e1; border-radius: 8px; padding: 12px 14px; font-size: 14px; outline: none; box-sizing: border-box; background: #ffffff; color: #1e293b; }
    .form-control-custom:focus { border-color: #0B2340; box-shadow: 0 0 0 3px rgba(11,35,64,0.1); }
    .btn-main { background: #0B2340; color: #fff; border: none; padding: 12px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-size: 15px; }
    .btn-main:hover { background: #1361b5; }
    .btn-cancel { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 12px 20px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 15px; }
    .btn-cancel:hover { background: #e2e8f0; }
    
    /* Correction du style de Summernote pour qu'il s'intègre parfaitement */
    .note-editor.note-frame { border: 1px solid #cbd5e1 !important; border-radius: 8px !important; overflow: hidden; }
    .note-toolbar { background: #f8fafc !important; border-bottom: 1px solid #e2e8f0 !important; }
</style>

<div class="admin-container">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #0B2340; font-weight: 700; margin: 0 0 5px 0;">
                {{ isset($arrondissement) ? 'Modifier' : 'Ajouter'}} un Arrondissement
            </h2>
            <p style="color: #64748b; margin: 0; font-size: 14px;">Complétez les informations ci-dessous.</p>
        </div>
        <a href="{{ route('arrondissements.index') }}" class="btn-cancel">
            ← Annuler et Retour
        </a>
    </div>

    <div class="admin-card">
        <form action="{{ isset($arrondissement) ? route('arrondissements.update', $arrondissement->id) : route('arrondissements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($arrondissement))
                @method('PUT')
            @endif

            <div style="margin-bottom: 20px;">
                <label class="form-label">Titre de l'Arrondissement</label>
                <input type="text" name="titre" class="form-control-custom" value="{{ old('titre', $arrondissement->titre ?? '') }}" placeholder="ex: Arrondissement Maritime d'Abidjan" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label class="form-label">Image Principale / Bannières</label>
                <input type="file" name="image" class="form-control-custom" accept="image/*">
                @if(isset($arrondissement) && $arrondissement->image)
                    <div style="margin-top: 10px;">
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 5px;">Image actuelle :</p>
                        <img src="{{ asset('storage/' . $arrondissement->image) }}" style="width: 140px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                @endif
            </div>

            <div style="margin-bottom: 25px;">
                <label class="form-label">Description & Contenu (Mise en forme & Images intégrées)</label>
                <textarea id="editor" name="description">{{ old('description', $arrondissement->description ?? '') }}</textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="submit" class="btn-main" style="background: #16a34a;">
                    {{ isset($arrondissement) ? 'Mettre à jour l\'arrondissement' : 'Enregistrer l\'arrondissement' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#editor').summernote({
        placeholder: 'Saisissez ou collez votre texte ici...',
        tabsize: 2,
        height: 380,
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
                uploadImage(files[0]);
            }
        }
    });

    function uploadImage(file) {
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
                $('#editor').summernote('insertImage', response.url);
            },
            error: function() {
                alert("Erreur lors de l'envoi de l'image.");
            }
        });
    }
});
</script>

@endsection