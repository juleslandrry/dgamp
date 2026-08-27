@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C;
        --gold:#C9A227; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6;
    }
    .va-wrap{max-width:820px;margin:0 auto;padding:36px 24px 60px;}
    .va-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .va-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .va-title{font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;}
    .va-sub{font-size:13px;color:var(--ink-soft);margin:0 0 22px;}
    .va-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .va-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    .section-block{background:#fff;border:1.5px solid var(--line);border-radius:14px;margin-bottom:18px;overflow:hidden;}
    .section-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1.5px solid var(--line);}
    .section-head .dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;}
    .section-head .txt{font-size:12.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--navy);}
    .section-head .hint{font-size:11.5px;color:var(--ink-soft);font-weight:400;text-transform:none;letter-spacing:0;margin-left:auto;}
    .section-body{padding:20px;}
    .dot.blue{background:var(--blue);} .dot.gold{background:var(--gold);}

    .va-field{margin-bottom:16px;}
    .va-field:last-child{margin-bottom:0;}
    .va-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;
        letter-spacing:.05em;margin-bottom:8px;display:block;}
    .va-field input[type=text],.va-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);box-sizing:border-box;
    }
    .va-field textarea{min-height:70px;resize:vertical;line-height:1.6;}
    .va-field input:focus,.va-field textarea:focus{
        outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }
    .va-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

    .va-current-img{display:flex;align-items:center;gap:14px;margin-bottom:10px;}
    .va-current-img img{width:90px;height:60px;object-fit:cover;border-radius:8px;border:1.5px solid var(--line);}
    .va-current-img span{font-size:12px;color:var(--ink-soft);}

    /* Liste verticale simple des informations */
    #items-list{display:flex;flex-direction:column;gap:12px;}
    .item-row{
        display:flex;gap:12px;align-items:flex-start;background:#FBFAF7;
        border:1.5px solid var(--line);border-radius:12px;padding:14px 16px;
    }
    .item-row .item-fields{flex:1;display:flex;flex-direction:column;gap:8px;}
    .item-row input[type=text]{
        border:1.5px solid var(--line);border-radius:8px;padding:9px 11px;font-size:13.5px;
        font-weight:700;color:var(--navy);
    }
    .item-row textarea{
        border:1.5px solid var(--line);border-radius:8px;padding:9px 11px;font-size:13.5px;
        min-height:50px;resize:vertical;line-height:1.5;font-family:inherit;
    }
    .item-remove{
        flex-shrink:0;width:32px;height:32px;border-radius:8px;border:1.5px solid #F2C9C9;
        background:#FBEAEA;color:#C0392B;font-size:16px;font-weight:700;cursor:pointer;
        display:flex;align-items:center;justify-content:center;line-height:1;
    }
    .item-remove:hover{background:#F5D5D5;}

    .btn-add-item{
        margin-top:14px;width:100%;padding:13px;border:1.5px dashed var(--navy);border-radius:10px;
        background:#fff;color:var(--navy);font-weight:700;font-size:13.5px;cursor:pointer;transition:.15s ease;
    }
    .btn-add-item:hover{background:#F4F1E9;}

    .empty-hint{font-size:13px;color:var(--ink-soft);text-align:center;padding:10px 0;}

    .va-actions{position:sticky;bottom:0;background:linear-gradient(transparent,#fff 30%);
        display:flex;justify-content:flex-end;padding-top:24px;margin-top:10px;}
    .va-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;border:none;
        border-radius:8px;padding:13px 28px;font-weight:700;cursor:pointer;font-size:13.5px;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .va-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);}

    @media (max-width:640px){ .va-row2{grid-template-columns:1fr;} }
</style>

<div class="va-wrap">
    <div class="va-crumb">Vie Associative</div>
    <h1 class="va-title">{{ $meta['label'] }}</h1>
    <p class="va-sub">Modifie le contenu de la page publique.</p>

    @if(session('success'))
        <div class="va-alert">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="va-alert warn">
            <strong>Des erreurs empêchent l'enregistrement :</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.vie-associative.update', $type) }}" enctype="multipart/form-data">
        @csrf

        <div class="section-block">
            <div class="section-head">
                <span class="dot blue"></span>
                <span class="txt">En-tête</span>
                <span class="hint">badge + titre + accroche</span>
            </div>
            <div class="section-body">
                <div class="va-row2">
                    <div class="va-field">
                        <label class="va-label">Badge</label>
                        <input type="text" name="badge" value="{{ old('badge', $page->badge ?? '') }}" placeholder="Ex: Protection & Solidarité">
                    </div>
                    <div class="va-field">
                        <label class="va-label">Titre principal</label>
                        <input type="text" name="titre" value="{{ old('titre', $page->titre ?? '') }}" placeholder="Ex: Fonds de Prévoyance DGAM">
                    </div>
                </div>
                <div class="va-field">
                    <label class="va-label">Accroche (sous le titre)</label>
                    <input type="text" name="lead" value="{{ old('lead', $page->lead ?? '') }}" placeholder="Ex: Garantir l'avenir de ceux qui veillent sur nos côtes.">
                </div>
            </div>
        </div>

        <div class="section-block">
            <div class="section-head">
                <span class="dot gold"></span>
                <span class="txt">Texte et image</span>
                <span class="hint">section de présentation</span>
            </div>
            <div class="section-body">
                <div class="va-field">
                    <label class="va-label">Titre de la section</label>
                    <input type="text" name="intro_titre" value="{{ old('intro_titre', $page->intro_titre ?? '') }}" placeholder="Ex: Pourquoi ce fonds ?">
                </div>
                <div class="va-field">
                    <label class="va-label">Texte</label>
                    <textarea name="intro_texte" rows="5">{{ old('intro_texte', $page->intro_texte ?? '') }}</textarea>
                </div>
                <div class="va-field">
                    <label class="va-label">Image</label>
                    @if($page && $page->intro_image)
                        <div class="va-current-img">
                            <img src="{{ asset('storage/'.$page->intro_image) }}" alt="Image actuelle">
                            <span>Image actuelle — choisis un fichier pour la remplacer</span>
                        </div>
                    @endif
                    <input type="file" name="intro_image" accept="image/*">
                </div>
            </div>
        </div>

        <div class="section-block">
            <div class="section-head">
                <span class="dot orange" style="background:var(--orange);"></span>
                <span class="txt">Informations</span>
                <span class="hint">ajoute autant de blocs que nécessaire</span>
            </div>
            <div class="section-body">
                <div id="items-list">
                    @forelse($items as $item)
                        <div class="item-row">
                            <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                            <div class="item-fields">
                                <input type="text" name="item_titre[]" value="{{ $item->titre }}" placeholder="Titre de l'information">
                                <textarea name="item_description[]" placeholder="Description (optionnel)">{{ $item->description }}</textarea>
                            </div>
                            <button type="button" class="item-remove" onclick="removeItem(this)">&times;</button>
                        </div>
                    @empty
                        <p class="empty-hint" id="empty-hint">Aucune information pour l'instant — clique ci-dessous pour en ajouter.</p>
                    @endforelse
                </div>

                <button type="button" class="btn-add-item" onclick="addItem()">+ Ajouter une information</button>
            </div>
        </div>

        <div class="va-actions">
            <button type="submit" class="va-btn-save">Enregistrer</button>
        </div>
    </form>
</div>

<script>
function addItem() {
    const hint = document.getElementById('empty-hint');
    if (hint) hint.remove();

    const row = document.createElement('div');
    row.className = 'item-row';
    row.innerHTML = `
        <input type="hidden" name="item_id[]" value="">
        <div class="item-fields">
            <input type="text" name="item_titre[]" placeholder="Titre de l'information">
            <textarea name="item_description[]" placeholder="Description (optionnel)"></textarea>
        </div>
        <button type="button" class="item-remove" onclick="removeItem(this)">&times;</button>
    `;
    document.getElementById('items-list').appendChild(row);
    row.querySelector('input[type=text]').focus();
}

function removeItem(btn) {
    btn.closest('.item-row').remove();
}
</script>

@endsection