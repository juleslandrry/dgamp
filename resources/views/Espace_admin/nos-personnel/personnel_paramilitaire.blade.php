@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C;
        --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6; --gold:#C9A227;
    }
    .pp-wrap{max-width:900px;margin:0 auto;padding:36px 24px 60px;}
    .pp-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .pp-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .pp-title{font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;}
    .pp-sub{font-size:13px;color:var(--ink-soft);margin:0 0 22px;}
    .pp-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .pp-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    .section-block{background:#fff;border:1.5px solid var(--line);border-radius:14px;margin-bottom:18px;overflow:hidden;}
    .section-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1.5px solid var(--line);}
    .section-head .dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;}
    .section-head .txt{font-size:12.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--navy);}
    .section-head .hint{font-size:11.5px;color:var(--ink-soft);font-weight:400;text-transform:none;letter-spacing:0;margin-left:auto;}
    .section-body{padding:20px;}
    .dot.blue{background:var(--blue);} .dot.gold{background:var(--gold);}

    .pp-field{margin-bottom:16px;}
    .pp-field:last-child{margin-bottom:0;}
    .pp-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;
        letter-spacing:.05em;margin-bottom:8px;display:block;}
    .pp-field input[type=text],.pp-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);box-sizing:border-box;
    }
    .pp-field textarea{min-height:70px;resize:vertical;line-height:1.6;}
    .pp-field input:focus,.pp-field textarea:focus{
        outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }
    .pp-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

    .pp-current-img{display:flex;align-items:center;gap:14px;margin-bottom:10px;}
    .pp-current-img img{width:90px;height:60px;object-fit:cover;border-radius:8px;border:1.5px solid var(--line);}
    .pp-current-img span{font-size:12px;color:var(--ink-soft);}

    .pp-actions{position:sticky;bottom:0;background:linear-gradient(transparent,#fff 30%);
        display:flex;justify-content:flex-end;padding-top:24px;margin-top:10px;}
    .pp-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;border:none;
        border-radius:8px;padding:13px 28px;font-weight:700;cursor:pointer;font-size:13.5px;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .pp-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);}

    @media (max-width:640px){ .pp-row2{grid-template-columns:1fr;} }
</style>

<div class="pp-wrap">
    <div class="pp-crumb">Personnel</div>
    <h1 class="pp-title">Personnel Paramilitaire</h1>
    <p class="pp-sub">Modifie le contenu de la page publique : le bandeau d'en-tête et la section de présentation avec image.</p>

    @if(session('success'))
        <div class="pp-alert">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="pp-alert warn">
            <strong>Des erreurs empêchent l'enregistrement :</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.personnel-paramilitaire.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="section-block">
            <div class="section-head">
                <span class="dot blue"></span>
                <span class="txt">Bandeau d'en-tête (fond image)</span>
                <span class="hint">badge + titre + description courte</span>
            </div>
            <div class="section-body">
                <div class="pp-row2">
                    <div class="pp-field">
                        <label class="pp-label">Badge</label>
                        <input type="text" name="badge" value="{{ old('badge', $data->badge ?? '') }}" placeholder="Ex: Marine Nationale">
                    </div>
                    <div class="pp-field">
                        <label class="pp-label">Titre principal</label>
                        <input type="text" name="titre" value="{{ old('titre', $data->titre ?? '') }}" placeholder="Ex: Personnel Paramilitaire">
                    </div>
                </div>
                <div class="pp-field">
                    <label class="pp-label">Description courte</label>
                    <textarea name="hero_description" rows="3" placeholder="Une ou deux phrases affichées sous le titre">{{ old('hero_description', $data->hero_description ?? '') }}</textarea>
                </div>
                <div class="pp-field">
                    <label class="pp-label">Image de fond</label>
                    @if($data && $data->hero_image)
                        <div class="pp-current-img">
                            <img src="{{ asset('storage/'.$data->hero_image) }}" alt="Image actuelle">
                            <span>Image actuelle — choisis un fichier pour la remplacer</span>
                        </div>
                    @endif
                    <input type="file" name="hero_image" accept="image/*">
                </div>
            </div>
        </div>

        <div class="section-block">
            <div class="section-head">
                <span class="dot gold"></span>
                <span class="txt">Section de présentation</span>
                <span class="hint">texte à côté d'une image sur la page publique</span>
            </div>
            <div class="section-body">
                <div class="pp-field">
                    <label class="pp-label">Titre de la section</label>
                    <input type="text" name="section_titre" value="{{ old('section_titre', $data->section_titre ?? '') }}" placeholder="Ex: Le Personnel Paramilitaire">
                </div>
                <div class="pp-field">
                    <label class="pp-label">Texte de présentation</label>
                    <textarea name="section_texte" id="section_texte" rows="8">{{ old('section_texte', $data->section_texte ?? '') }}</textarea>
                </div>
                <div class="pp-field">
                    <label class="pp-label">Liste de points (optionnel — un point par ligne)</label>
                    <textarea name="section_points" rows="4" placeholder="Ex:&#10;Encadrement opérationnel&#10;Sécurité des installations&#10;Soutien logistique">{{ old('section_points', $data && $data->section_points ? implode("\n", $data->section_points) : '') }}</textarea>
                </div>
                <div class="pp-field">
                    <label class="pp-label">Image de la section</label>
                    @if($data && $data->section_image)
                        <div class="pp-current-img">
                            <img src="{{ asset('storage/'.$data->section_image) }}" alt="Image actuelle">
                            <span>Image actuelle — choisis un fichier pour la remplacer</span>
                        </div>
                    @endif
                    <input type="file" name="section_image" accept="image/*">
                </div>
            </div>
        </div>

        <div class="pp-actions">
            <button type="submit" class="pp-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

{{-- CKEditor chargé uniquement sur cette page --}}
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('section_texte', {
        height: 260,
        removePlugins: 'elementspath',
        resize_enabled: false,
        toolbarGroups: [
            { name: 'clipboard', groups: ['clipboard', 'undo'] },
            { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
            { name: 'links' },
            { name: 'insert' },
            { name: 'forms' },
            '/',
            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
            { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
            { name: 'styles' },
            { name: 'colors' },
        ],
        removeButtons: 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,Language,BidiRtl,BidiLtr,Flash,Smiley,PageBreak,Iframe,Maximize,ShowBlocks,About,Anchor'
    });
</script>

@endsection