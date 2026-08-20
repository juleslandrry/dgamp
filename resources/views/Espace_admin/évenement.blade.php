@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340;
        --navy-2:#123A63;
        --blue:#1E7FB8;
        --orange:#E8720C;
        --green:#1F7A4D;
        --gold:#C9A227;
        --gold-soft:#FBF3DD;
        --ink:#1C2733;
        --ink-soft:#66707B;
        --line:#E7E2D6;
    }

    .mdg-wrap{max-width:960px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);
        margin:0 0 8px;letter-spacing:-.01em;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 26px;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    /* Onglets */
    .ev-tabs{display:flex;gap:8px;margin-bottom:26px;border-bottom:2px solid var(--line);background:#fff;}
    .ev-tab-btn{background:transparent;border:none;padding:12px 22px;font-size:13.5px;font-weight:700;
        color:var(--ink-soft);cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-2px;
        transition:.15s ease;}
    .ev-tab-btn.active{color:var(--navy);border-bottom-color:var(--gold);}
    .ev-tab-panel{display:none;}
    .ev-tab-panel.active{display:block;}

    .card-block{background:#FAF9F5;border:1.5px solid var(--line);border-radius:12px;
        padding:22px 24px;margin-bottom:18px;position:relative;}

    .card-block-label{display:flex;align-items:center;gap:10px;margin-bottom:16px;}
    .card-num{width:26px;height:26px;border-radius:8px;background:var(--navy);color:#fff;
        display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;}
    .card-block-label span.txt{font-size:12.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;}

    .mdg-field{margin-bottom:16px;min-width:0;}
    .mdg-field:last-child{margin-bottom:0;}
    .mdg-label{display:flex;align-items:center;gap:9px;font-size:11.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;}
    .mdg-icon{width:22px;height:22px;border-radius:7px;flex-shrink:0;display:flex;align-items:center;
        justify-content:center;color:#fff;}
    .mdg-icon svg{width:12px;height:12px;}
    .mdg-icon.i-blue{background:var(--blue);}
    .mdg-icon.i-orange{background:var(--orange);}
    .mdg-icon.i-green{background:var(--green);}
    .mdg-icon.i-gold{background:var(--gold);}
    .mdg-icon.i-navy{background:var(--navy);}

    .mdg-field input[type=text],
    .mdg-field input[type=file],
    .mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);
        transition:.15s ease;box-sizing:border-box;resize:vertical;
    }
    .mdg-field textarea{min-height:70px;line-height:1.6;}
    .mdg-field input[type=text]:focus,
    .mdg-field textarea:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}

    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
    .mdg-row3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:18px;}

    .btn-remove-card{position:absolute;top:20px;right:22px;background:#FBEAEA;color:#C0392B;
        border:none;border-radius:7px;padding:7px 13px;cursor:pointer;font-size:12px;font-weight:700;
        transition:.15s ease;}
    .btn-remove-card:hover{background:#F5D5D5;}

    .btn-add-card{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:8px;
        padding:11px 20px;cursor:pointer;font-size:13px;font-weight:700;margin-bottom:10px;transition:.15s ease;}
    .btn-add-card:hover{background:var(--gold-soft);}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:30px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;
        font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}

    @media (max-width: 640px){
        .mdg-row2,.mdg-row3{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Agenda</div>
    <h1 class="mdg-title">Gestion des Événements</h1>
    <p class="mdg-sub">Gère les événements passés (archives) et les événements à venir.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <div class="ev-tabs">
        <button type="button" class="ev-tab-btn active" onclick="switchTab('passes', this)">Événements Passés</button>
        <button type="button" class="ev-tab-btn" onclick="switchTab('avenir', this)">Événements à Venir</button>
    </div>

    {{-- ===== ONGLET ÉVÉNEMENTS PASSÉS ===== --}}
    <div id="tab-passes" class="ev-tab-panel active">

        @if(!$passes_ok)
            <div class="mdg-alert warn">⚠️ Les événements passés n'ont pas pu être détectés automatiquement. Vérifie le contenu avant d'enregistrer.</div>
        @endif

        <form method="POST" action="{{ route('evenements.passes.update') }}" enctype="multipart/form-data">
            @csrf

            <div id="passes-list">
                @foreach($passes as $i => $ev)
                    <div class="card-block">
                        <div class="card-block-label">
                            <span class="card-num">{{ $i + 1 }}</span>
                            <span class="txt">Événement {{ $i + 1 }}</span>
                        </div>
                        @if($i > 0)
                            <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Retirer</button>
                        @endif

                         <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>
                                    Titre
                                </div>
                                <input type="text" name="titre[]" value="{{ $ev['titre'] }}" placeholder="Ex: Célébration journée des femmes">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>
                                    Date de l'événement
                                </div>
                                <input type="date" name="date_evenement[]" value="{{ $ev['date_evenement'] }}">
                            </div>
                        </div>

                

                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v10H2z"/><path d="M2 6.5h12"/></svg></span>
                                Détails (texte complet affiché au clic sur "Voir plus")
                            </div>
                            <textarea name="details[]" style="min-height:110px;">{{ $ev['details'] }}</textarea>
                        </div>
                          

                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                                Description
                            </div>
                            <textarea name="description[]">{{ $ev['description'] }}</textarea>
                        </div>

                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="7" r="4.2"/><path d="M10.2 10.2L14 14"/></svg></span>
                                    Catégorie (filtre interne)
                                </div>
                                <input type="text" name="categorie[]" value="{{ $ev['categorie'] }}" placeholder="Ex: ceremonie">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M8 3v10"/></svg></span>
                                    Étiquette affichée
                                </div>
                                <input type="text" name="tag[]" value="{{ $ev['tag'] }}" placeholder="Ex: Ceremonie">
                            </div>
                        </div>

                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg></span>
                                Photo de l'événement
                            </div>
                            <input type="file" name="image[]" accept="image/*">
                            <input type="hidden" name="image_actuelle[]" value="{{ $ev['image'] }}">
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn-add-card" onclick="addPasse()">+ Ajouter un événement passé</button>

            <div class="mdg-actions">
                <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les événements passés</button>
            </div>
        </form>
    </div>

    {{-- ===== ONGLET ÉVÉNEMENTS À VENIR ===== --}}
    <div id="tab-avenir" class="ev-tab-panel">

        @if(!$avenir_ok)
            <div class="mdg-alert warn">⚠️ Les événements à venir n'ont pas pu être détectés automatiquement. Vérifie le contenu avant d'enregistrer.</div>
        @endif

        <form method="POST" action="{{ route('evenements.avenir.update') }}">
            @csrf

            <div id="avenir-list">
                @foreach($avenir as $i => $ev)
                    <div class="card-block">
                        <div class="card-block-label">
                            <span class="card-num">{{ $i + 1 }}</span>
                            <span class="txt">Événement {{ $i + 1 }}</span>
                        </div>
                        @if($i > 0)
                            <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Retirer</button>
                        @endif

                                                <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>
                                Titre de l'événement
                            </div>
                            <input type="text" name="titre[]" value="{{ $ev['titre'] }}" placeholder="Ex: Sécurité Maritime 2026">
                        </div>

                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>
                                    Date de l'événement
                                </div>
                                <input type="date" name="date_evenement[]" value="{{ $ev['date_evenement'] }}">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2.2 1.3"/></svg></span>
                                    Heure
                                </div>
                                <input type="time" name="heure_evenement[]" value="{{ $ev['heure_evenement'] }}">
                            </div>
                        </div>

                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 14.5S3 10 3 6.3a5 5 0 0110 0C13 10 8 14.5 8 14.5z"/><circle cx="8" cy="6.3" r="1.8"/></svg></span>
                                    Lieu
                                </div>
                                <input type="text" name="lieu[]" value="{{ $ev['lieu'] }}" placeholder="Port Autonome d'Abidjan">
                            </div>
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="7" r="4.2"/><path d="M10.2 10.2L14 14"/></svg></span>
                                    Catégorie (filtre)
                                </div>
                                <input type="text" name="categorie[]" value="{{ $ev['categorie'] }}" placeholder="Ex: conference">
                            </div>
                        </div>

                        <div class="mdg-row2">
                            <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M8 3v10"/></svg></span>
                                    Étiquette affichée
                                </div>
                                <input type="text" name="tag[]" value="{{ $ev['tag'] }}" placeholder="Ex: Conférence">
                            </div>
                                                        <div class="mdg-field">
                                <div class="mdg-label">
                                    <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>
                                    Lien externe (optionnel, laisser # sinon)
                                </div>
                                <input type="text" name="lien[]" value="{{ $ev['lien'] }}" placeholder="#">
                            </div>
                        </div>

                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v10H2z"/><path d="M2 6.5h12"/></svg></span>
                                Détails (texte affiché au clic sur "Détails")
                            </div>
                            <textarea name="details[]" style="min-height:110px;">{{ $ev['details'] }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn-add-card" onclick="addAvenir()">+ Ajouter un événement à venir</button>

            <div class="mdg-actions">
                <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les événements à venir</button>
            </div>
        </form>
    </div>
</div>

<script>
function switchTab(name, btn) {
    document.querySelectorAll('.ev-tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.ev-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}

function addPasse() {
    const list = document.getElementById('passes-list');
    const num = list.querySelectorAll('.card-block').length + 1;
    const wrap = document.createElement('div');
    wrap.className = 'card-block';
    wrap.innerHTML = `
        <div class="card-block-label"><span class="card-num">${num}</span><span class="txt">Événement ${num} (nouveau)</span></div>
        <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Annuler l'ajout</button>

                <div class="mdg-row2">
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>Titre</div>
                <input type="text" name="titre[]" placeholder="Titre de l'événement">
            </div>
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>Date de l'événement</div>
                <input type="date" name="date_evenement[]">
            </div>
        </div>

        <div class="mdg-field">
            <div class="mdg-label"><span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>Description</div>
            <textarea name="description[]"></textarea>
        </div>

        <div class="mdg-field">
            <div class="mdg-label"><span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v10H2z"/><path d="M2 6.5h12"/></svg></span>Détails</div>
            <textarea name="details[]" style="min-height:110px;"></textarea>
        </div>

        <div class="mdg-row2">
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="7" r="4.2"/><path d="M10.2 10.2L14 14"/></svg></span>Catégorie (filtre interne)</div>
                <input type="text" name="categorie[]" placeholder="Ex: formation">
            </div>
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M8 3v10"/></svg></span>Étiquette affichée</div>
                <input type="text" name="tag[]" placeholder="Ex: Formation">
            </div>
        </div>

        <div class="mdg-field">
            <div class="mdg-label"><span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg></span>Photo de l'événement</div>
            <input type="file" name="image[]" accept="image/*">
            <input type="hidden" name="image_actuelle[]" value="">
        </div>
    `;
    list.appendChild(wrap);
}

function addAvenir() {
    const list = document.getElementById('avenir-list');
    const num = list.querySelectorAll('.card-block').length + 1;
    const wrap = document.createElement('div');
    wrap.className = 'card-block';
    wrap.innerHTML = `
        <div class="card-block-label"><span class="card-num">${num}</span><span class="txt">Événement ${num} (nouveau)</span></div>
        <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Annuler l'ajout</button>

        <div class="mdg-field">
            <div class="mdg-label"><span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>Titre de l'événement</div>
            <input type="text" name="titre[]" placeholder="Titre de l'événement">
        </div>

            <div class="mdg-row2">
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg></span>Date de l'événement</div>
                <input type="date" name="date_evenement[]">
            </div>
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2.2 1.3"/></svg></span>Heure</div>
                <input type="time" name="heure_evenement[]">
            </div>
        </div>

        <div class="mdg-row2">
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 14.5S3 10 3 6.3a5 5 0 0110 0C13 10 8 14.5 8 14.5z"/><circle cx="8" cy="6.3" r="1.8"/></svg></span>Lieu</div>
                <input type="text" name="lieu[]" placeholder="Lieu de l'événement">
            </div>
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="7" cy="7" r="4.2"/><path d="M10.2 10.2L14 14"/></svg></span>Catégorie (filtre)</div>
                <input type="text" name="categorie[]" placeholder="Ex: conference">
            </div>
        </div>

        <div class="mdg-row2">
            <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M8 3v10"/></svg></span>Étiquette affichée</div>
                <input type="text" name="tag[]" placeholder="Ex: Conférence">
            </div>
                        <div class="mdg-field">
                <div class="mdg-label"><span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>Lien externe (optionnel)</div>
                <input type="text" name="lien[]" placeholder="#">
            </div>
        </div>

        <div class="mdg-field">
            <div class="mdg-label"><span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v10H2z"/><path d="M2 6.5h12"/></svg></span>Détails</div>
            <textarea name="details[]" style="min-height:110px;"></textarea>
        </div>
    `;
    list.appendChild(wrap);
}
</script>

@endsection