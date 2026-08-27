@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C; --green:#1F7A4D;
        --gold:#C9A227; --gold-soft:#FBF3DD; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6;
        --purple:#6C4AB6;
    }
    .mdg-wrap{max-width:960px;margin:0 auto;padding:36px 24px 60px;}
    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .mdg-title{font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 22px;}
    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    /* Grille de cartes de sélection */
    .svc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px;margin-bottom:28px;}
    .svc-card{background:#fff;border:1.5px solid var(--line);border-radius:14px;padding:18px 14px;
        cursor:pointer;text-align:center;transition:.15s ease;}
    .svc-card:hover{border-color:var(--navy);transform:translateY(-2px);box-shadow:0 6px 16px rgba(11,35,64,.08);}
    .svc-card.active{border-color:var(--navy);background:#F4F1E9;box-shadow:0 4px 14px rgba(11,35,64,.12);}
    .svc-card-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;
        margin:0 auto 10px;color:#fff;font-weight:700;font-size:13px;letter-spacing:.02em;}
    .svc-card-name{font-size:12.5px;font-weight:700;color:var(--navy);line-height:1.3;}
    .svc-card-add{border-style:dashed;display:flex;flex-direction:column;align-items:center;justify-content:center;}
    .svc-card-add .svc-card-icon{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);font-size:20px;}
    .svc-card-add .svc-card-name{color:var(--ink-soft);}

    .accent-navy .svc-card-icon{background:var(--navy);}
    .accent-blue .svc-card-icon{background:var(--blue);}
    .accent-orange .svc-card-icon{background:var(--orange);}
    .accent-green .svc-card-icon{background:var(--green);}
    .accent-gold .svc-card-icon{background:var(--gold);}

    .tab-panel{display:none;}
    .tab-panel.active{display:block;animation:fadeIn .2s ease;}
    @keyframes fadeIn{from{opacity:0;transform:translateY(4px);}to{opacity:1;transform:translateY(0);}}

    .section-block{background:#fff;border:1.5px solid var(--line);border-radius:14px;margin-bottom:18px;overflow:hidden;}
    .section-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1.5px solid var(--line);}
    .section-head .dot{width:9px;height:9px;border-radius:50%;flex-shrink:0;}
    .section-head .txt{font-size:12.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--navy);}
    .section-head .hint{font-size:11.5px;color:var(--ink-soft);font-weight:400;text-transform:none;letter-spacing:0;margin-left:auto;}
    .section-body{padding:20px;}
    .dot.blue{background:var(--blue);} .dot.gold{background:var(--gold);}
    .dot.green{background:var(--green);} .dot.purple{background:var(--purple);}

    .mdg-field{margin-bottom:16px;}
    .mdg-field:last-child{margin-bottom:0;}
    .mdg-label{font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;
        letter-spacing:.05em;margin-bottom:8px;display:block;}
    .mdg-field input[type=text],.mdg-field select,.mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);box-sizing:border-box;
    }
    .mdg-field textarea{min-height:70px;resize:vertical;line-height:1.6;}
    .mdg-field input:focus,.mdg-field select:focus,.mdg-field textarea:focus{
        outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);
    }
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
    .mdg-row3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px;}

    .tab-top-bar{display:flex;justify-content:flex-end;margin-bottom:14px;}
    .btn-delete-service{background:#FBEAEA;color:#C0392B;border:1.5px solid #F2C9C9;
        border-radius:8px;padding:8px 16px;font-size:12px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .btn-delete-service:hover{background:#F5D5D5;}

    .mdg-actions{position:sticky;bottom:0;background:linear-gradient(transparent,#fff 30%);
        display:flex;justify-content:flex-end;padding-top:24px;margin-top:10px;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;border:none;
        border-radius:8px;padding:13px 28px;font-weight:700;cursor:pointer;font-size:13.5px;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);}

    @media (max-width:640px){ .mdg-row2,.mdg-row3{grid-template-columns:1fr;} }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM</div>
    <h1 class="mdg-title">Services en Ligne</h1>
    <p class="mdg-sub">Clique sur un service pour le modifier, ou ajoute-en un nouveau — il apparaîtra automatiquement sur le site.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mdg-alert warn">
            <strong>Des erreurs empêchent l'enregistrement :</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="svc-grid" id="svc-grid">
        @foreach($services as $i => $s)
            <div class="svc-card accent-{{ $s['accent'] }} @if($loop->first) active @endif" data-index="{{ $i }}" onclick="switchTab({{ $i }}, this)">
                <div class="svc-card-icon">{{ strtoupper(substr($s['icon'], 0, 2)) }}</div>
                <div class="svc-card-name">{{ $s['titre'] ?: 'Nouveau service' }}</div>
            </div>
        @endforeach
        <div class="svc-card svc-card-add" id="svc-add-card" onclick="addService()">
            <div class="svc-card-icon">+</div>
            <div class="svc-card-name">Ajouter un service</div>
        </div>
    </div>

    <form method="POST" action="{{ route('services-en-ligne.update') }}" id="svc-form">
        @csrf

        <div id="panels-container">
            @foreach($services as $i => $s)
                <div id="tab-{{ $i }}" class="tab-panel @if($loop->first) active @endif">
                    <input type="hidden" name="id[]" value="{{ $s['id'] }}">
                    <input type="hidden" name="accent[]" value="{{ $s['accent'] }}">
                    <input type="hidden" name="icon[]" value="{{ $s['icon'] }}">
                    <input type="hidden" name="lien[]" value="{{ $s['lien'] }}">

                    <div class="tab-top-bar">
                        @if($s['id'])
                            <button type="submit" form="delete-form-{{ $s['id'] }}" class="btn-delete-service">Supprimer ce service</button>
                        @endif
                    </div>

                    <div class="section-block">
                        <div class="section-head">
                            <span class="dot blue"></span>
                            <span class="txt">Contenu affiché sur la page publique</span>
                            <span class="hint">badge + titre + texte + bouton</span>
                        </div>
                        <div class="section-body">
                            <div class="mdg-row2">
                                <div class="mdg-field">
                                    <label class="mdg-label">Badge (petit texte au-dessus du titre)</label>
                                    <input type="text" name="badge[]" value="{{ $s['badge'] }}" placeholder="Ex: Autorité Maritime">
                                </div>
                                <div class="mdg-field">
                                    <label class="mdg-label">Titre principal</label>
                                    <input type="text" name="titre[]" value="{{ $s['titre'] }}" placeholder="Ex: Immatriculation des Navires">
                                </div>
                            </div>
                            <div class="mdg-field">
                                <label class="mdg-label">Texte de description</label>
                                <textarea name="description[]" id="description-{{ $i }}" class="rich-editor" rows="3">{{ $s['description'] }}</textarea>
                            </div>
                            <div class="mdg-field">
                                <label class="mdg-label">Texte du bouton</label>
                                <input type="text" name="bouton_texte[]" value="{{ $s['bouton_texte'] }}" placeholder="Ex: Consulter le registre">
                            </div>
                        </div>
                    </div>

                    <div class="section-block">
                        <div class="section-head">
                            <span class="dot purple"></span>
                            <span class="txt">Popup "En savoir plus"</span>
                            <span class="hint">s'affiche au clic sur le bouton</span>
                        </div>
                        <div class="section-body">
                            <div class="mdg-field">
                                <label class="mdg-label">Texte détaillé</label>
                                <textarea name="detail_texte[]" id="detail_texte-{{ $i }}" class="rich-editor" rows="4" placeholder="Explique en détail ce service, les démarches à suivre...">{{ $s['detail_texte'] }}</textarea>
                            </div>
                            <div class="mdg-field">
                                <label class="mdg-label">Liste de points (optionnel — un point par ligne)</label>
                                <textarea name="detail_points[]" rows="4" placeholder="Ex:&#10;Copie de la carte d'identité&#10;Justificatif de domicile&#10;Formulaire rempli">{{ $s['detail_points'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>

    @foreach($services as $s)
        @if($s['id'])
            <form id="delete-form-{{ $s['id'] }}" method="POST" action="{{ route('services-en-ligne.destroy', $s['id']) }}"
                  onsubmit="return confirm('Supprimer définitivement ce service ? Il disparaîtra aussi du site public.');" style="display:none;">
                @csrf
                @method('DELETE')
            </form>
        @endif
    @endforeach
</div>

<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>

<script>
let panelCount = {{ count($services) }};

function initEditorsForTab(index) {
    tinymce.init({
        selector: '#tab-' + index + ' .rich-editor',
        license_key: 'gpl',
        height: 220,
        menubar: false,
        plugins: 'lists link',
        toolbar: 'bold italic underline | bullist numlist | link | removeformat',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; font-size: 14px; line-height: 1.6; }',
        branding: false,
        statusbar: false,
    });
}

function switchTab(index, cardEl) {
    document.querySelectorAll('.tab-panel.active .rich-editor').forEach(function (ta) {
        const ed = tinymce.get(ta.id);
        if (ed) { ed.save(); ed.remove(); }
    });

    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.svc-card').forEach(c => c.classList.remove('active'));
    document.getElementById('tab-' + index).classList.add('active');
    cardEl.classList.add('active');

    initEditorsForTab(index);
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function addService() {
    const index = panelCount;
    panelCount++;

    // Nouvelle carte
    const card = document.createElement('div');
    card.className = 'svc-card accent-navy';
    card.dataset.index = index;
    card.onclick = function() { switchTab(index, card); };
    card.innerHTML = `<div class="svc-card-icon">NW</div><div class="svc-card-name">Nouveau service</div>`;
    document.getElementById('svc-add-card').insertAdjacentElement('beforebegin', card);

    // Nouveau panneau
    const panel = document.createElement('div');
    panel.id = 'tab-' + index;
    panel.className = 'tab-panel';
    panel.innerHTML = `
        <input type="hidden" name="id[]" value="">
        <input type="hidden" name="accent[]" value="navy">
        <input type="hidden" name="icon[]" value="folder">
        <input type="hidden" name="lien[]" value="#">
        <div class="tab-top-bar">
            <button type="button" class="btn-delete-service" onclick="removeNewService(${index}, this)">Retirer ce nouveau service</button>
        </div>
        <div class="section-block">
            <div class="section-head"><span class="dot blue"></span><span class="txt">Contenu affiché sur la page publique</span></div>
            <div class="section-body">
                <div class="mdg-row2">
                    <div class="mdg-field"><label class="mdg-label">Badge</label><input type="text" name="badge[]" placeholder="Ex: Services Officiels"></div>
                    <div class="mdg-field"><label class="mdg-label">Titre principal</label><input type="text" name="titre[]" placeholder="Ex: Nouveau Service"></div>
                </div>
                <div class="mdg-field"><label class="mdg-label">Texte de description</label><textarea name="description[]" id="description-${index}" class="rich-editor" rows="3"></textarea></div>
                <div class="mdg-field"><label class="mdg-label">Texte du bouton</label><input type="text" name="bouton_texte[]" placeholder="Ex: En savoir plus"></div>
            </div>
        </div>
        <div class="section-block">
            <div class="section-head"><span class="dot purple"></span><span class="txt">Popup "En savoir plus"</span></div>
            <div class="section-body">
                <div class="mdg-field"><label class="mdg-label">Texte détaillé</label><textarea name="detail_texte[]" id="detail_texte-${index}" class="rich-editor" rows="4"></textarea></div>
                <div class="mdg-field"><label class="mdg-label">Liste de points (un point par ligne)</label><textarea name="detail_points[]" rows="4"></textarea></div>
            </div>
        </div>
    `;
    document.getElementById('panels-container').appendChild(panel);

    switchTab(index, card);
}

function removeNewService(index, btn) {
    document.getElementById('tab-' + index).remove();
    document.querySelector('.svc-card[data-index="' + index + '"]').remove();
    // Réactive le premier onglet
    const firstCard = document.querySelector('.svc-card:not(.svc-card-add)');
    if (firstCard) switchTab(firstCard.dataset.index, firstCard);
}

document.addEventListener('DOMContentLoaded', function () {
    initEditorsForTab(0);
});

document.getElementById('svc-form').addEventListener('submit', function () {
    if (window.tinymce) tinymce.triggerSave();
});
</script>

@endsection