@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340;
        --navy-2:#123A63;
        --blue:#1E7FB8;
        --blue-soft:#E4F2FA;
        --orange:#E8720C;
        --orange-soft:#FDEEE0;
        --green:#1F7A4D;
        --green-soft:#E5F5EC;
        --gold:#C9A227;
        --gold-soft:#FBF3DD;
        --ink:#1C2733;
        --ink-soft:#66707B;
        --line:#E7E2D6;
    }

    .mdg-wrap{max-width:1000px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);margin:0 0 26px;letter-spacing:-.01em;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}

    .mdg-layout{display:grid;grid-template-columns:minmax(0,1fr) 260px;gap:40px;align-items:start;}

    .mdg-field{margin-bottom:24px;min-width:0;}

    .mdg-label{display:flex;align-items:center;gap:9px;font-size:12.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;margin-bottom:9px;}

    .mdg-icon{width:24px;height:24px;border-radius:7px;flex-shrink:0;display:flex;align-items:center;
        justify-content:center;color:#fff;}
    .mdg-icon svg{width:13px;height:13px;}
    .mdg-icon.i-blue{background:var(--blue);}
    .mdg-icon.i-orange{background:var(--orange);}
    .mdg-icon.i-green{background:var(--green);}
    .mdg-icon.i-gold{background:var(--gold);}

    .mdg-field input[type=text],
    .mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:12px 14px;font-size:14.5px;font-family:inherit;color:var(--ink);
        transition:.15s ease;resize:vertical;
    }
    .mdg-field textarea{min-height:280px;line-height:1.7;}
    .mdg-field input[type=text]:focus,
    .mdg-field textarea:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}

    .mdg-error{color:#C0392B;font-size:11.5px;margin-top:5px;}

    /* Colonne photo */
    .mdg-photo-col{text-align:center;}
    .mdg-photo-preview{width:100%;aspect-ratio:1/1;object-fit:cover;border-radius:10px;
        border:2px solid var(--gold);box-shadow:0 6px 18px rgba(11,35,64,.15);margin-bottom:14px;}

    .mdg-file-btn{display:block;text-align:center;border:1.5px dashed var(--navy);border-radius:8px;
        padding:10px 12px;font-size:12.5px;color:var(--navy);cursor:pointer;font-weight:600;
        background:transparent;transition:.15s ease;}
    .mdg-file-btn:hover{background:var(--gold-soft);}
    .mdg-file-input{display:none;}
    .mdg-file-name{font-size:11px;color:var(--ink-soft);margin-top:6px;}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:10px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;
        font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}
    .mdg-btn-ghost{background:transparent;color:var(--navy);border:1.5px solid var(--navy);}
    .mdg-btn-ghost:hover{background:var(--navy);color:#fff;}

    @media (max-width: 720px){
        .mdg-layout{grid-template-columns:1fr;}
        .mdg-photo-col{order:-1;max-width:220px;margin:0 auto 10px;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Directeur Général</div>
    <h1 class="mdg-title">Mot du DG</h1>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('motdg.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mdg-layout">
            <div>
                <div class="mdg-field">
    <div class="mdg-label">
        <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="5.3" r="2.6"/><path d="M2.7 14a5.3 5.3 0 0110.6 0"/></svg></span>
        Grade 
    </div>
    <input type="text" name="grade_dg" value="{{ old('grade_dg', $grade_dg) }}" placeholder="Ex: Colonel-Major">
    @error('grade_dg') <div class="mdg-error">{{ $message }}</div> @enderror
</div>

<div class="mdg-field">
    <div class="mdg-label">
        <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="5.3" r="2.6"/><path d="M2.7 14a5.3 5.3 0 0110.6 0"/></svg></span>
        Nom 
    </div>
    <input type="text" name="nom_dg" value="{{ old('nom_dg', $nom_dg) }}" placeholder="Ex: KOUASSI">
    @error('nom_dg') <div class="mdg-error">{{ $message }}</div> @enderror
</div>

<div class="mdg-field">
    <div class="mdg-label">
        <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="5.3" r="2.6"/><path d="M2.7 14a5.3 5.3 0 0110.6 0"/></svg></span>
        Prénom
    </div>
    <input type="text" name="prenom_dg" value="{{ old('prenom_dg', $prenom_dg) }}" placeholder="Ex: Yao Julien">
    @error('prenom_dg') <div class="mdg-error">{{ $message }}</div> @enderror
</div>

                <div class="mdg-field">
                    <div class="mdg-label">
                        <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>
                        Fonction / Titre
                    </div>
                    <input type="text" name="titre_dg" value="{{ old('titre_dg', $titre_dg) }}">
                    @error('titre_dg') <div class="mdg-error">{{ $message }}</div> @enderror
                </div>

                <div class="mdg-field">
                    <div class="mdg-label">
                        <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                        Texte du Mot du DG
                    </div>
                    <textarea name="texte_dg" id="texte_dg">{{ old('texte_dg', $texte_dg) }}</textarea>
                    @error('texte_dg') <div class="mdg-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mdg-photo-col">
                <div class="mdg-label" style="justify-content:center;">
                    <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg></span>
                    Photo
                </div>
                <img src="{{ asset($photo) }}" class="mdg-photo-preview" id="mdg-preview" alt="Photo DG">

                <label for="mdg-photo-input" class="mdg-file-btn">Choisir une nouvelle photo</label>
                <input type="file" name="photo" id="mdg-photo-input" class="mdg-file-input" accept="image/*"
                    onchange="document.getElementById('mdg-preview').src=URL.createObjectURL(this.files[0]);
                              document.getElementById('mdg-filename').textContent=this.files[0].name;">
                <div class="mdg-file-name" id="mdg-filename">Aucun fichier choisi</div>
                @error('photo') <div class="mdg-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mdg-actions">
            <button type="reset" class="mdg-btn mdg-btn-ghost">Vider les champs</button>
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: '#texte_dg',
        license_key: 'gpl',
        height: 500,
        menubar: false,
        plugins: 'lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime table wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | code fullscreen',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; font-size: 15px; line-height: 1.7; }',
        branding: false,
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('motdg.upload-image') }}', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(result => {
                    if (result.location) {
                        resolve(result.location);
                    } else {
                        reject('Échec de l\'upload de l\'image');
                    }
                })
                .catch(() => reject('Erreur réseau lors de l\'upload'));
            });
        }
    });
</script>

@endsection