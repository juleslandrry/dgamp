@extends('Espace_admin.layout')

@section('title', 'Administrateurs')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap');

    .reg-page {
        --ink:#0F172A; --deep:#1E293B; --teal:#0EA5E9; --teal-dark:#0284C7;
        --brass:#D97706; --fog:#F8FAFC; --slate:#64748B; --line:#E2E8F0;
        --danger:#EF4444; --surface:#FFFFFF;
        padding: 2rem;
        font-family:'Plus Jakarta Sans', sans-serif;
        color:var(--ink);
        box-sizing:border-box;
    }
    .reg-page *, .reg-modal-overlay *, .reg-modal-overlay *::before, .reg-modal-overlay *::after { box-sizing:border-box; }

    .reg-header { display:flex; align-items:flex-end; justify-content:space-between; gap:1.5rem; flex-wrap:wrap; margin-bottom:1.5rem; }
    .reg-eyebrow { display:block; font-family:'JetBrains Mono',monospace; font-size:.7rem; letter-spacing:.1em; text-transform:uppercase; color:var(--teal-dark); margin-bottom:.3rem; font-weight:600; }
    .reg-header h1 { font-weight:700; font-size:1.85rem; margin:0 0 .3rem; color:var(--ink); letter-spacing:-0.02em; }
    .reg-header p { margin:0; color:var(--slate); font-size:.92rem; }

    .reg-stats-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.75rem;
    }
    .reg-stat-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }
    .reg-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--fog);
        color: var(--slate);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .reg-stat-icon--active { background: #F0F9FF; color: var(--teal-dark); }
    .reg-stat-info { display: flex; flex-direction: column; }
    .reg-stat-val { font-weight: 700; font-size: 1.1rem; color: var(--ink); line-height: 1.2; }
    .reg-stat-lbl { font-size: .78rem; color: var(--slate); font-weight: 500; }

    .reg-btn { display:inline-flex; align-items:center; justify-content:center; gap:.55rem; border:none; padding:.65rem 1.25rem; border-radius:10px; font-weight:600; font-size:.88rem; cursor:pointer; transition:all .2s cubic-bezier(0.4, 0, 0.2, 1); font-family:inherit; }
    .reg-btn--primary { background:var(--ink); color:#fff; box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15); }
    .reg-btn--primary:hover { background:var(--deep);color:#000000; transform: translateY(-1px); box-shadow: 0 6px 16px rgba(15, 23, 42, 0.25); }
    .reg-btn--ghost { background:#fff; color:var(--slate); border:1px solid var(--line); }
    .reg-btn--ghost:hover { border-color:#CBD5E1; color:var(--ink); background:var(--fog); }
    .reg-btn--danger { background:var(--danger); color:#000000; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); }
    .reg-btn--danger:hover { background:#DC2626;color:#ffffff; transform: translateY(-1px); }

    .reg-alert { display:flex; align-items:flex-start; gap:.75rem; padding:1rem 1.1rem; border-radius:12px; font-size:.88rem; margin-bottom:1.2rem; border:1px solid; }
    .reg-alert--ok { background:#F0FDF4; color:#166534; border-color:#BBF7D0; }
    .reg-alert--danger { background:#FEF2F2; color:#991B1B; border-color:#FECACA; }
    .reg-alert ul { margin:.25rem 0 0; padding-left:1.1rem; }
    .reg-alert__close { margin-left:auto; background:none; border:none; font-size:1.1rem; cursor:pointer; color:inherit; opacity:.6; }

    .reg-toolbar { margin-bottom:1.2rem; }
    .reg-search { position:relative; display:flex; align-items:center; gap:.6rem; background:#fff; border:1px solid var(--line); border-radius:10px; padding:.55rem .9rem; max-width:380px; color:var(--slate); transition: border-color .15s; }
    .reg-search:focus-within { border-color:var(--teal-dark); box-shadow:0 0 0 3px rgba(14, 165, 233, 0.12); }
    .reg-search input { border:none; outline:none; background:transparent; font-size:.88rem; width:100%; color:var(--ink); font-family:inherit; }
    .reg-search__clear { color:var(--slate); text-decoration:none; font-size:1.1rem; }

    .reg-ledger { background:#fff; border:1px solid var(--line); border-radius:14px; overflow:hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.02); }
    .reg-ledger__head, .reg-row { display:grid; grid-template-columns:56px 2.2fr 1.1fr 1.2fr 1.2fr 96px; align-items:center; }
    .reg-ledger__head { padding:.85rem 1.4rem; background:var(--fog); border-bottom:1px solid var(--line); }
    .reg-ledger__head .reg-col { font-family:'JetBrains Mono',monospace; font-size:.68rem; letter-spacing:.08em; text-transform:uppercase; color:var(--slate); font-weight:600; }

    .reg-row { padding:1rem 1.4rem; border-bottom:1px solid var(--line); transition:.15s; }
    .reg-row:last-child { border-bottom:none; }
    .reg-row:hover { background:#F8FAFC; }

    .reg-num { font-family:'JetBrains Mono',monospace; font-size:.8rem; color:var(--slate); }

    .reg-col--name { display:flex; align-items:center; gap:.85rem; }
    .reg-avatar-img { width:40px; height:40px; border-radius:10px; object-fit:cover; border:1px solid var(--line); }
    .reg-avatar { width:40px; height:40px; border-radius:10px; background:var(--ink); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:.85rem; flex-shrink:0; letter-spacing:-0.03em; }
    .reg-identity { display:flex; flex-direction:column; min-width:0; }
    .reg-identity__name { font-weight:600; font-size:.92rem; color:var(--ink); }
    .reg-identity__email { font-family:'JetBrains Mono',monospace; font-size:.75rem; color:var(--slate); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

    .reg-contact-text { font-size:.85rem; color:var(--ink); font-weight:500; }
    
    .reg-tag { display:inline-block; font-size:.75rem; font-weight:600; color:#B45309; background:#FEF3C7; border:1px solid #FDE68A; padding:.2rem .65rem; border-radius:6px; }
    .reg-tag--super { color:#4338CA; background:#EEF2FF; border-color:#C7D2FE; }

    /* Statut automatique */
    .reg-status { display:inline-flex; align-items:center; gap:.4rem; font-size:.82rem; font-weight:600; color:var(--slate); }
    .reg-status--online { color:#047857; }
    .reg-status__dot { width:8px; height:8px; border-radius:50%; background:#94A3B8; }
    .reg-status--online .reg-status__dot { background:#10B981; box-shadow:0 0 0 3px rgba(16, 185, 129, 0.2); }

    .reg-col--action { display:flex; justify-content:flex-end; gap:.4rem; }
    .reg-iconbtn { width:34px; height:34px; border-radius:8px; border:1px solid var(--line); background:#fff; color:var(--slate); display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .15s ease; padding:0; }
    .reg-iconbtn:hover { border-color:var(--teal-dark); color:var(--teal-dark); background:#F0F9FF; }
    .reg-iconbtn--danger:hover { border-color:var(--danger); color:var(--danger); background:#FEF2F2; }

    .reg-empty { text-align:center; padding:3.5rem 1rem; color:var(--slate); }
    .reg-pagination { display:flex; justify-content:flex-end; margin-top:1.2rem; }

    /* Modales */
    .reg-modal-overlay {
        position:fixed; inset:0; background:rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        display:none; align-items:center; justify-content:center;
        z-index:1000; padding:1.25rem; font-family:'Plus Jakarta Sans',sans-serif;
    }
    .reg-modal-overlay.is-open { display:flex; }

    .reg-modal { 
        background:#fff; border-radius:18px; overflow:hidden; 
        width:100%; max-width:520px; max-height:92vh; overflow-y:auto; 
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25); border: 1px solid var(--line);
        animation: modalAppear .2s ease-out;
    }

    @keyframes modalAppear {
        from { opacity: 0; transform: scale(0.96) translateY(8px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .reg-modal__head { 
        position:relative; padding:1.5rem 1.75rem 1.25rem; 
        border-bottom:1px solid var(--line); display:flex; align-items:center; gap:1rem;
    }

    .reg-modal__icon {
        width: 44px; height: 44px; border-radius: 12px; background: #F0F9FF;
        color: var(--teal-dark); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .reg-modal__icon--danger { background: #FEF2F2; color: var(--danger); }

    .reg-modal__title-group h5 { font-weight:700; font-size:1.15rem; margin:0; color:var(--ink); letter-spacing:-0.01em; }

    .reg-modal__close { 
        position:absolute; top:1.25rem; right:1.25rem; background:var(--fog); 
        border:1px solid var(--line); width: 30px; height: 30px; border-radius: 50%;
        display:flex; align-items:center; justify-content:center; font-size:1.1rem; 
        line-height:1; color:var(--slate); cursor:pointer; transition: all .15s;
    }
    .reg-modal__close:hover { background:var(--line); color:var(--ink); }

    .reg-modal__body { padding:1.5rem 1.75rem; }
    .reg-modal__body--center { text-align:center; padding:2.2rem 1.8rem 1rem; }

    .reg-modal__foot { 
        display:flex; justify-content:flex-end; gap:.75rem; padding:1.25rem 1.75rem; 
        background:var(--fog); border-top:1px solid var(--line); 
    }
    .reg-modal__foot--center { justify-content:center; background:#fff; border-top:none; padding-top:.5rem; }

    .reg-field { margin-bottom:1.2rem; }
    .reg-field label { 
        display:flex; justify-content:space-between; align-items:center;
        font-size:.82rem; font-weight:600; color:var(--ink); margin-bottom:.45rem; 
    }
    .reg-field label .opt { font-weight:400; color:var(--slate); font-size:.75rem; }

    .reg-field input, .reg-field select { 
        width:100%; padding:.7rem .9rem; border:1px solid var(--line); 
        border-radius:10px; font-size:.9rem; font-family:inherit; outline:none; 
        transition: all .15s ease; color:var(--ink); background: #FAFBFD;
    }
    .reg-field input:focus, .reg-field select:focus { 
        border-color:var(--teal-dark); background:#fff; box-shadow:0 0 0 4px rgba(14, 165, 233, 0.12); 
    }

    .reg-field-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }

    .reg-password-wrapper { position: relative; display: flex; align-items: center; }
    .reg-password-wrapper input { padding-right: 2.5rem; }
    .reg-toggle-password {
        position: absolute; right: .75rem; background: none; border: none; padding: 0;
        cursor: pointer; color: var(--slate); display: flex; align-items: center; justify-content: center;
    }

    @media (max-width: 850px) {
        .reg-ledger__head { display:none; }
        .reg-row { grid-template-columns:1fr; gap:.6rem; padding:1rem 1.1rem; }
        .reg-col--action { justify-content:flex-start; }
        .reg-field-row { grid-template-columns:1fr; gap:0; }
    }
</style>

<div class="reg-page">

    {{-- EN-TÊTE --}}
    <div class="reg-header">
        <div class="reg-header__title">
            <span class="reg-eyebrow">Espace admin · Paramètres</span>
            <h1>Registre des administrateurs</h1>
            <p>Gestion centrale des accès et autorisations utilisateur.</p>
        </div>
        <button type="button" class="reg-btn reg-btn--primary" onclick="regOpenModal('modalAjouter')">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 3v10M3 8h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            Nouvel administrateur
        </button>
    </div>

    {{-- BANDEAU MÉTRIQUES --}}
    <div class="reg-stats-bar">
        <div class="reg-stat-card">
            <div class="reg-stat-icon reg-stat-icon--active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="reg-stat-info">
                <span class="reg-stat-val">{{ $administrateurs->total() }}</span>
                <span class="reg-stat-lbl">Total administrateurs</span>
            </div>
        </div>
        <div class="reg-stat-card">
            <div class="reg-stat-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="reg-stat-info">
                <span class="reg-stat-val">{{ $administrateurs->first()?->created_at?->format('d/m/Y') ?? '--' }}</span>
                <span class="reg-stat-lbl">Dernier ajout enregistré</span>
            </div>
        </div>
    </div>

    {{-- ALERTES --}}
    @if (session('succes'))
        <div class="reg-alert reg-alert--ok">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="none"><path d="M3 8.5l3.2 3.2L13 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>{{ session('succes') }}</span>
            <button type="button" class="reg-alert__close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if (session('erreur'))
        <div class="reg-alert reg-alert--danger">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="none"><path d="M8 5v4.5M8 12h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.5"/></svg>
            <span>{{ session('erreur') }}</span>
            <button type="button" class="reg-alert__close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="reg-alert reg-alert--danger">
            <svg width="18" height="18" viewBox="0 0 16 16" fill="none"><path d="M8 5v4.5M8 12h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="8" cy="8" r="6.5" stroke="currentColor" stroke-width="1.5"/></svg>
            <div>
                <strong>Impossible d'enregistrer :</strong>
                <ul>
                    @foreach ($errors->all() as $erreur)
                        <li>{{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- TOOLBAR --}}
    <div class="reg-toolbar">
        <form method="GET" action="{{ route('administrateurs.index') }}" class="reg-search">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.8"/><path d="M11 11l3.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            <input type="text" name="q" value="{{ request('q', $recherche ?? '') }}" placeholder="Rechercher par nom, email, contact ou titre…">
            @if(request()->filled('q'))
                <a href="{{ route('administrateurs.index') }}" class="reg-search__clear" title="Effacer">&times;</a>
            @endif
        </form>
    </div>

    {{-- REGISTRE --}}
    <div class="reg-ledger">
        <div class="reg-ledger__head">
            <span class="reg-col reg-col--num">N°</span>
            <span class="reg-col reg-col--name">Administrateur</span>
            <span class="reg-col reg-col--contact">Contact</span>
            <span class="reg-col reg-col--title">Rôle / Titre</span>
            <span class="reg-col reg-col--status">Statut</span>
            <span class="reg-col reg-col--action">Action</span>
        </div>

        @forelse ($administrateurs as $admin)
            @php
                // Détection de présence (< 5 minutes)
                $isOnline = $admin->derniere_connexion && \Carbon\Carbon::parse($admin->derniere_connexion)->gt(now()->subMinutes(5));
            @endphp
            <div class="reg-row">
                <span class="reg-col reg-col--num"><span class="reg-num">{{ str_pad($loop->iteration + ($administrateurs->currentPage()-1)*$administrateurs->perPage(), 2, '0', STR_PAD_LEFT) }}</span></span>

                <span class="reg-col reg-col--name">
                    @if ($admin->photo)
                        <img src="{{ asset('storage/' . $admin->photo) }}" alt="{{ $admin->nom }}" class="reg-avatar-img">
                    @else
                        <span class="reg-avatar">{{ strtoupper(substr($admin->nom, 0, 2)) }}</span>
                    @endif
                    <span class="reg-identity">
                        <span class="reg-identity__name">{{ $admin->nom }}</span>
                        <span class="reg-identity__email">{{ $admin->email }}</span>
                    </span>
                </span>

                <span class="reg-col reg-col--contact">
                    <span class="reg-contact-text">{{ $admin->contact ?? 'N/A' }}</span>
                </span>

                <span class="reg-col reg-col--title">
                    <span class="reg-tag {{ str_contains(strtolower($admin->titre), 'super') ? 'reg-tag--super' : '' }}">
                        {{ $admin->titre }}
                    </span>
                </span>

                <span class="reg-col reg-col--status">
                    <span class="reg-status {{ $isOnline ? 'reg-status--online' : '' }}">
                        <span class="reg-status__dot"></span>
                        {{ $isOnline ? 'En ligne' : 'Hors ligne' }}
                    </span>
                </span>

                <span class="reg-col reg-col--action">
                    <button type="button"
                            class="reg-iconbtn"
                            title="Modifier"
                            onclick="regOpenEdit({
                                action: '{{ route('administrateurs.update', $admin) }}',
                                nom: {{ Js::from($admin->nom) }},
                                email: {{ Js::from($admin->email) }},
                                contact: {{ Js::from($admin->contact ?? '') }},
                                titre: {{ Js::from($admin->titre) }}
                            })">
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M11.3 2.3a1.6 1.6 0 0 1 2.3 2.3L5 13.2l-3 .8.8-3 8.5-8.5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button"
                            class="reg-iconbtn reg-iconbtn--danger"
                            title="Supprimer"
                            onclick="regOpenDelete({
                                action: '{{ route('administrateurs.destroy', $admin) }}',
                                nom: {{ Js::from($admin->nom) }}
                            })">
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M3 4.5h10M6.5 4.5V3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1.5M4.5 4.5V13a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V4.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </span>
            </div>
        @empty
            <div class="reg-empty">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none"><path d="M12 3 3 8l9 5 9-5-9-5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M6 11v6c0 1.2 2.7 3 6 3s6-1.8 6-3v-6" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                <p>Le registre est vide pour l'instant.</p>
                <button type="button" class="reg-btn reg-btn--ghost" onclick="regOpenModal('modalAjouter')">Ajouter le premier administrateur</button>
            </div>
        @endforelse
    </div>

    @if ($administrateurs->hasPages())
        <div class="reg-pagination">{{ $administrateurs->withQueryString()->links() }}</div>
    @endif
</div>

{{-- MODALE : AJOUTER --}}
<div class="reg-modal-overlay @if($errors->any() && old('_method') !== 'PUT') is-open @endif" id="modalAjouter" onclick="if(event.target===this) regCloseModal('modalAjouter')">
    <div class="reg-modal">
        <form method="POST" action="{{ route('administrateurs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="reg-modal__head">
                <div class="reg-modal__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                </div>
                <div class="reg-modal__title-group">
                    <span class="reg-eyebrow">Nouvelle fiche</span>
                    <h5>Créer un administrateur</h5>
                </div>
                <button type="button" class="reg-modal__close" onclick="regCloseModal('modalAjouter')">&times;</button>
            </div>
            <div class="reg-modal__body">
                <div class="reg-field">
                    <label for="add_nom">Nom complet</label>
                    <input type="text" id="add_nom" name="nom" value="{{ old('nom') }}" placeholder="Ex : Kouamé Hurbain" required>
                </div>
                <div class="reg-field-row">
                    <div class="reg-field">
                        <label for="add_email">Adresse email</label>
                        <input type="email" id="add_email" name="email" value="{{ old('email') }}" placeholder="nom@dgamp.ci" required>
                    </div>
                    <div class="reg-field">
                        <label for="add_contact">Contact <span class="opt">(Optionnel)</span></label>
                        <input type="text" id="add_contact" name="contact" value="{{ old('contact') }}" placeholder="Ex : +225 07000000">
                    </div>
                </div>
                <div class="reg-field">
                    <label for="add_titre">Rôle / Titre</label>
                    <select id="add_titre" name="titre" required>
                        <option value="Administrateur" {{ old('titre') == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                        <option value="Super Administrateur" {{ old('titre') == 'Super Administrateur' ? 'selected' : '' }}>Super Administrateur</option>
                    </select>
                </div>
                <div class="reg-field">
                    <label for="add_photo">Photo de profil <span class="opt">(Optionnel)</span></label>
                    <input type="file" id="add_photo" name="photo" accept="image/*">
                </div>
                <div class="reg-field-row" style="margin-bottom:0;">
                    <div class="reg-field" style="margin-bottom:0;">
                        <label for="add_password">Mot de passe</label>
                        <div class="reg-password-wrapper">
                            <input type="password" id="add_password" name="password" placeholder="8 caract. min." required>
                            <button type="button" class="reg-toggle-password" onclick="togglePasswordVisibility('add_password', this)" title="Afficher/Masquer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="reg-field" style="margin-bottom:0;">
                        <label for="add_password_confirmation">Confirmation</label>
                        <div class="reg-password-wrapper">
                            <input type="password" id="add_password_confirmation" name="password_confirmation" placeholder="Répéter..." required>
                            <button type="button" class="reg-toggle-password" onclick="togglePasswordVisibility('add_password_confirmation', this)" title="Afficher/Masquer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reg-modal__foot">
                <button type="button" class="reg-btn reg-btn--ghost" onclick="regCloseModal('modalAjouter')">Annuler</button>
                <button type="submit" class="reg-btn reg-btn--primary">Enregistrer la fiche</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALE : MODIFIER --}}
<div class="reg-modal-overlay @if($errors->any() && old('_method') === 'PUT') is-open @endif" id="modalModifier" onclick="if(event.target===this) regCloseModal('modalModifier')">
    <div class="reg-modal">
        <form method="POST" id="formModifier" action="{{ old('_form_action', '') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="_form_action" id="edit_form_action" value="{{ old('_form_action', '') }}">
            <div class="reg-modal__head">
                <div class="reg-modal__icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </div>
                <div class="reg-modal__title-group">
                    <span class="reg-eyebrow">Mise à jour</span>
                    <h5>Modifier le profil</h5>
                </div>
                <button type="button" class="reg-modal__close" onclick="regCloseModal('modalModifier')">&times;</button>
            </div>
            <div class="reg-modal__body">
                <div class="reg-field">
                    <label for="edit_nom">Nom complet</label>
                    <input type="text" id="edit_nom" name="nom" value="{{ old('nom') }}" required>
                </div>
                <div class="reg-field-row">
                    <div class="reg-field">
                        <label for="edit_email">Adresse email</label>
                        <input type="email" id="edit_email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="reg-field">
                        <label for="edit_contact">Contact <span class="opt">(Optionnel)</span></label>
                        <input type="text" id="edit_contact" name="contact" value="{{ old('contact') }}">
                    </div>
                </div>
                <div class="reg-field">
                    <label for="edit_titre">Rôle / Titre</label>
                    <select id="edit_titre" name="titre" required>
                        <option value="Administrateur">Administrateur</option>
                        <option value="Super Administrateur">Super Administrateur</option>
                    </select>
                </div>
                <div class="reg-field">
                    <label for="edit_photo">Changer la photo <span class="opt">(Optionnel)</span></label>
                    <input type="file" id="edit_photo" name="photo" accept="image/*">
                </div>
                <div class="reg-field-row" style="margin-bottom:0;">
                    <div class="reg-field" style="margin-bottom:0;">
                        <label for="edit_password">Mot de passe <span class="opt">(Optionnel)</span></label>
                        <div class="reg-password-wrapper">
                            <input type="password" id="edit_password" name="password" placeholder="Inchangé si vide">
                            <button type="button" class="reg-toggle-password" onclick="togglePasswordVisibility('edit_password', this)" title="Afficher/Masquer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="reg-field" style="margin-bottom:0;">
                        <label for="edit_password_confirmation">Confirmation</label>
                        <div class="reg-password-wrapper">
                            <input type="password" id="edit_password_confirmation" name="password_confirmation" placeholder="Confirmer...">
                            <button type="button" class="reg-toggle-password" onclick="togglePasswordVisibility('edit_password_confirmation', this)" title="Afficher/Masquer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reg-modal__foot">
                <button type="button" class="reg-btn reg-btn--ghost" onclick="regCloseModal('modalModifier')">Annuler</button>
                <button type="submit" class="reg-btn reg-btn--primary">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

{{-- MODALE : SUPPRIMER --}}
<div class="reg-modal-overlay" id="modalSupprimer" onclick="if(event.target===this) regCloseModal('modalSupprimer')">
    <div class="reg-modal">
        <form method="POST" id="formSupprimer" action="">
            @csrf
            @method('DELETE')
            <div class="reg-modal__head">
                <div class="reg-modal__icon reg-modal__icon--danger">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </div>
                <div class="reg-modal__title-group">
                    <span class="reg-eyebrow" style="color:var(--danger);">Action irréversible</span>
                    <h5>Supprimer l'administrateur</h5>
                </div>
                <button type="button" class="reg-modal__close" onclick="regCloseModal('modalSupprimer')">&times;</button>
            </div>
            <div class="reg-modal__body reg-modal__body--center">
                <h5>Êtes-vous sûr ?</h5>
                <p>Le compte de <strong id="delete_nom" style="color:var(--ink);"></strong> sera définitivement retiré du système.</p>
            </div>
            <div class="reg-modal__foot reg-modal__foot--center">
                <button type="button" class="reg-btn reg-btn--ghost" onclick="regCloseModal('modalSupprimer')">Annuler</button>
                <button type="submit" class="reg-btn reg-btn--danger">Supprimer définitivement</button>
            </div>
        </form>
    </div>
</div>

<script>
    function regOpenModal(id) {
        document.getElementById(id).classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }
    function regCloseModal(id) {
        document.getElementById(id).classList.remove('is-open');
        document.body.style.overflow = '';
    }
    function regOpenEdit(data) {
        document.getElementById('formModifier').action = data.action;
        document.getElementById('edit_form_action').value = data.action;
        document.getElementById('edit_nom').value = data.nom;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_contact').value = data.contact;
        document.getElementById('edit_titre').value = data.titre;
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_password_confirmation').value = '';
        regOpenModal('modalModifier');
    }
    function regOpenDelete(data) {
        document.getElementById('formSupprimer').action = data.action;
        document.getElementById('delete_nom').textContent = data.nom;
        regOpenModal('modalSupprimer');
    }

    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const iconEye = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
        const iconEyeOff = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>`;

        if (input.type === "password") {
            input.type = "text";
            btn.innerHTML = iconEyeOff;
        } else {
            input.type = "password";
            btn.innerHTML = iconEye;
        }
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.reg-modal-overlay.is-open').forEach(function (overlay) {
                overlay.classList.remove('is-open');
            });
            document.body.style.overflow = '';
        }
    });
</script>

@endsection