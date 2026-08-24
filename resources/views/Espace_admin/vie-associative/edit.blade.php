@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C; --green:#1F7A4D;
        --gold:#C9A227; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6; --purple:#6C4AB6;
    }
    .va-wrap{max-width:960px;margin:0 auto;padding:36px 24px 60px;}
    .va-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .va-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .va-title{font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;}
    .va-sub{font-size:13px;color:var(--ink-soft);margin:0 0 22px;}
    .va-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .va-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    .va-tabs{display:flex;gap:8px;margin-bottom:22px;border-bottom:1.5px solid var(--line);}
    .va-tab{padding:10px 18px;font-size:13px;font-weight:700;color:var(--ink-soft);cursor:pointer;
        border-bottom:3px solid transparent;transition:.15s ease;}
    .va-tab:hover{color:var(--navy);}
    .va-tab.active{color:var(--navy);border-bottom-color:var(--orange);}
    .va-panel{display:none;}
    .va-panel.active{display:block;animation:fadeIn .2s ease;}
    @keyframes fadeIn{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:translateY(0);}}

    .section-block{background:#fff;border:1.5px solid var(--line);border-radius:14px;margin-bottom:18px;overflow:hidden;}
    .section-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1.5px solid var(--line);}
    .section-head .dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;}
    .section-head .txt{font-size:12.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--navy);}
    .section-head .hint{font-size:11.5px;color:var(--ink-soft);font-weight:400;text-transform:none;letter-spacing:0;margin-left:auto;}
    .section-body{padding:20px;}
    .dot.blue{background:var(--blue);} .dot.gold{background:var(--gold);}
    .dot.green{background:var(--green);} .dot.purple{background:var(--purple);}

    .va-field{margin-bottom:16px;}
    .va-field:last-child{margin-bottom:0;}
    .va-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;
        letter-spacing:.05em;margin-bottom:8px;display:block;}
    .va-field input[type=text],.va-field select,.va-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);box-sizing:border-box;
    }
    .va-field textarea{min-height:70px;resize:vertical;line-height:1.6;}
    .va-field input:focus,.va-field select:focus,.va-field textarea:focus{
        outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }
    .va-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}

    .va-current-img{display:flex;align-items:center;gap:14px;margin-bottom:10px;}
    .va-current-img img{width:90px;height:60px;object-fit:cover;border-radius:8px;border:1.5px solid var(--line);}
    .va-current-img span{font-size:12px;color:var(--ink-soft);}

    /* Grille de cartes (sélection) */
    .card-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px;margin-bottom:22px;}
    .card-pick{background:#fff;border:1.5px solid var(--line);border-radius:14px;padding:16px 12px;
        cursor:pointer;text-align:center;transition:.15s ease;}
    .card-pick:hover{border-color:var(--navy);transform:translateY(-2px);}
    .card-pick.active{border-color:var(--navy);background:#F4F1E9;}
    .card-pick-name{font-size:12px;font-weight:700;color:var(--navy);}
    .card-pick-add{border-style:dashed;color:var(--ink-soft);}

    .card-tab-panel{display:none;}
    .card-tab-panel.active{display:block;}
    .btn-delete-card{background:#FBEAEA;color:#C0392B;border:1.5px solid #F2C9C9;
        border-radius:8px;padding:8px 16px;font-size:12px;font-weight:700;cursor:pointer;}
    .btn-delete-card:hover{background:#F5D5D5;}
    .card-top-bar{display:flex;justify-content:flex-end;margin-bottom:14px;}

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
    <p class="va-sub">Modifie le contenu de la page publique et gère les cartes affichées.</p>

    @if(session('success'))
        <div class="va-alert">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="va-alert warn">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="va-alert warn">
            <strong>Des erreurs empêchent l'enregistrement :</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="va-tabs">
        <div class="va-tab active" data-tab="contenu" onclick="switchMainTab('contenu', this)">Contenu de la page</div>
        <div class="va-tab" data-tab="cartes" onclick="switchMainTab('cartes', this)">Cartes ({{ $cards->count() }})</div>
    </div>

    {{-- ===================== ONGLET CONTENU ===================== --}}
    <div id="tab-contenu" class="va-panel active">
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

                    @if($meta['has_stats'])
                        <div class="va-row2">
                            <div class="va-field">
                                <label class="va-label">Statistique 1</label>
                                <input type="text" name="stat1_val" value="{{ old('stat1_val', $page->stat1_val ?? '') }}" placeholder="Ex: 100%" style="margin-bottom:8px;">
                                <input type="text" name="stat1_lab" value="{{ old('stat1_lab', $page->stat1_lab ?? '') }}" placeholder="Ex: Engagé">
                            </div>
                            <div class="va-field">
                                <label class="va-label">Statistique 2</label>
                                <input type="text" name="stat2_val" value="{{ old('stat2_val', $page->stat2_val ?? '') }}" placeholder="Ex: Solidarité" style="margin-bottom:8px;">
                                <input type="text" name="stat2_lab" value="{{ old('stat2_lab', $page->stat2_lab ?? '') }}" placeholder="Ex: Notre Force">
                            </div>
                        </div>
                    @endif

                    @if($meta['has_tags'])
                        <div class="va-field">
                            <label class="va-label">Petits tags (un par ligne)</label>
                            <textarea name="tags" rows="3" placeholder="Ex:&#10;Loisirs&#10;Sport&#10;Entraide">{{ old('tags', $page && $page->tags ? implode("\n", $page->tags) : '') }}</textarea>
                        </div>
                    @endif
                </div>
            </div>

            <div class="section-block">
                <div class="section-head">
                    <span class="dot gold"></span>
                    <span class="txt">Section d'introduction</span>
                    <span class="hint">texte à côté de l'image</span>
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
                        <label class="va-label">Liste de points (un par ligne)</label>
                        <textarea name="checklist" rows="4" placeholder="Ex:&#10;Assistance en cas de maladie&#10;Soutien aux familles">{{ old('checklist', $page && $page->checklist ? implode("\n", $page->checklist) : '') }}</textarea>
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

            @if($meta['has_cta'])
                <div class="section-block">
                    <div class="section-head">
                        <span class="dot purple"></span>
                        <span class="txt">Bloc d'appel à l'action</span>
                        <span class="hint">encart en bas de page</span>
                    </div>
                    <div class="section-body">
                        <div class="va-row2">
                            <div class="va-field">
                                <label class="va-label">Titre du bloc</label>
                                <input type="text" name="cta_titre" value="{{ old('cta_titre', $page->cta_titre ?? '') }}">
                            </div>
                            <div class="va-field">
                                <label class="va-label">Texte du bloc</label>
                                <input type="text" name="cta_texte" value="{{ old('cta_texte', $page->cta_texte ?? '') }}">
                            </div>
                        </div>
                        <div class="va-row2">
                            <div class="va-field">
                                <label class="va-label">Texte du bouton</label>
                                <input type="text" name="cta_bouton_texte" value="{{ old('cta_bouton_texte', $page->cta_bouton_texte ?? '') }}">
                            </div>
                            <div class="va-field">
                                <label class="va-label">Lien du bouton</label>
                                <input type="text" name="cta_bouton_lien" value="{{ old('cta_bouton_lien', $page->cta_bouton_lien ?? '') }}" placeholder="https://... ou #">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="va-actions">
                <button type="submit" class="va-btn-save">Enregistrer le contenu</button>
            </div>
        </form>
    </div>

    {{-- ===================== ONGLET CARTES ===================== --}}
    <div id="tab-cartes" class="va-panel">
        @if(!$page)
            <div class="va-alert warn">Enregistre d'abord le contenu de la page (onglet précédent) avant d'ajouter des cartes.</div>
        @else
            <div class="card-grid" id="card-grid">
                @foreach($cards as $i => $c)
                    <div class="card-pick @if($loop->first) active @endif" data-index="{{ $i }}" onclick="switchCardTab({{ $i }}, this)">
                        <div class="card-pick-name">{{ $c->titre ?: 'Nouvelle carte' }}</div>
                    </div>
                @endforeach
                <div class="card-pick card-pick-add" id="card-add-btn" onclick="addCard()">+ Ajouter une carte</div>
            </div>

            <form method="POST" action="{{ route('admin.vie-associative.cards.update', $type) }}">
                @csrf
                <div id="cards-container">
                    @foreach($cards as $i => $c)
                        <div id="card-tab-{{ $i }}" class="card-tab-panel @if($loop->first) active @endif">
                            <input type="hidden" name="card_id[]" value="{{ $c->id }}">
                            <div class="card-top-bar">
                                <button type="submit" form="delete-card-{{ $c->id }}" class="btn-delete-card">Supprimer cette carte</button>
                            </div>
                            <div class="section-block">
                                <div class="section-body">
                                    <div class="va-row2">
                                        <div class="va-field">
                                            <label class="va-label">Titre de la carte</label>
                                            <input type="text" name="card_titre[]" value="{{ $c->titre }}">
                                        </div>
                                        <div class="va-field">
                                            <label class="va-label">Couleur de l'icône</label>
                                            <select name="card_couleur[]">
                                                <option value="orange" @selected($c->couleur==='orange')>Orange</option>
                                                <option value="vert" @selected($c->couleur==='vert')>Vert</option>
                                                <option value="violet" @selected($c->couleur==='violet')>Violet</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="va-field">
                                        <label class="va-label">Description (paragraphe, optionnel)</label>
                                        <textarea name="card_description[]" rows="3">{{ $c->description }}</textarea>
                                    </div>
                                    <div class="va-field">
                                        <label class="va-label">Liste de points (un par ligne, optionnel)</label>
                                        <textarea name="card_points[]" rows="4">{{ $c->points ? implode("\n", $c->points) : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="va-actions">
                    <button type="submit" class="va-btn-save">Enregistrer les cartes</button>
                </div>
            </form>

            @foreach($cards as $c)
                <form id="delete-card-{{ $c->id }}" method="POST" action="{{ route('admin.vie-associative.cards.destroy', [$type, $c->id]) }}"
                      onsubmit="return confirm('Supprimer définitivement cette carte ?');" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        @endif
    </div>
</div>

<script>
let cardCount = {{ $cards->count() }};

function switchMainTab(tab, el) {
    document.querySelectorAll('.va-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.va-panel').forEach(p => p.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('tab-' + tab).classList.add('active');
}

function switchCardTab(index, el) {
    document.querySelectorAll('.card-pick').forEach(c => c.classList.remove('active'));
    document.querySelectorAll('.card-tab-panel').forEach(p => p.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('card-tab-' + index).classList.add('active');
}

function addCard() {
    const index = cardCount;
    cardCount++;

    const pick = document.createElement('div');
    pick.className = 'card-pick';
    pick.dataset.index = index;
    pick.onclick = function() { switchCardTab(index, pick); };
    pick.innerHTML = `<div class="card-pick-name">Nouvelle carte</div>`;
    document.getElementById('card-add-btn').insertAdjacentElement('beforebegin', pick);

    const panel = document.createElement('div');
    panel.id = 'card-tab-' + index;
    panel.className = 'card-tab-panel';
    panel.innerHTML = `
        <input type="hidden" name="card_id[]" value="">
        <div class="card-top-bar">
            <button type="button" class="btn-delete-card" onclick="removeNewCard(${index}, this)">Retirer cette nouvelle carte</button>
        </div>
        <div class="section-block">
            <div class="section-body">
                <div class="va-row2">
                    <div class="va-field"><label class="va-label">Titre de la carte</label><input type="text" name="card_titre[]" placeholder="Ex: Assoc. des Officiers"></div>
                    <div class="va-field"><label class="va-label">Couleur de l'icône</label>
                        <select name="card_couleur[]">
                            <option value="orange">Orange</option>
                            <option value="vert">Vert</option>
                            <option value="violet">Violet</option>
                        </select>
                    </div>
                </div>
                <div class="va-field"><label class="va-label">Description (optionnel)</label><textarea name="card_description[]" rows="3"></textarea></div>
                <div class="va-field"><label class="va-label">Liste de points (un par ligne, optionnel)</label><textarea name="card_points[]" rows="4"></textarea></div>
            </div>
        </div>
    `;
    document.getElementById('cards-container').appendChild(panel);

    switchCardTab(index, pick);
}

function removeNewCard(index, btn) {
    document.getElementById('card-tab-' + index).remove();
    document.querySelector('.card-pick[data-index="' + index + '"]').remove();
    const first = document.querySelector('.card-pick:not(.card-pick-add)');
    if (first) switchCardTab(first.dataset.index, first);
}
</script>

@endsection