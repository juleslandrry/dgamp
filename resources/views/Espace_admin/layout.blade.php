<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>DGAM — Gestionnaire du site</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" href="{{ asset('storage/' . $siteSettings?->favicon) }}" type="image/jp">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
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
    --paper:#FFFDF8;
    --code-bg:#0E1A2C;
  }
  *{box-sizing:border-box;}
  body{margin:0;font-family:'IBM Plex Sans',sans-serif;background:#fff;color:var(--ink);}
  ::selection{background:var(--gold);color:#fff;}

  /* ===== Top bar réduite ===== */
  .topbar{
    height:52px;display:flex;align-items:center;padding:0 20px;gap:12px;
    background:linear-gradient(100deg,var(--navy) 0%,var(--navy-2) 60%,#164A78 100%);
    position:relative; z-index: 100;
  }
  .topbar::after{content:"";position:absolute;left:0;right:0;bottom:0;height:3px;
    background:linear-gradient(90deg,var(--orange) 0 33%,#fff 33% 66%,var(--green) 66% 100%);}
  .seal{width:28px;height:28px;border-radius:50%;flex-shrink:0;object-fit:cover;
    border:2px solid var(--gold);box-shadow:0 2px 6px rgba(0,0,0,.25);background:#fff;}
  .brand{font-family:'Fraunces',serif;font-weight:700;font-size:15.5px;color:#fff;letter-spacing:.01em;}
  .brand small{display:block;font-family:'IBM Plex Sans';font-weight:500;font-size:9px;color:var(--gold);letter-spacing:.1em;text-transform:uppercase;margin-top:1px;}

  /* lien englobant le logo + le texte de marque, pour revenir au dashboard */
  .brand-link{display:flex;align-items:center;gap:12px;text-decoration:none;cursor:pointer;}

  .topbar .right{margin-left:auto;display:flex;align-items:center;gap:8px;}
  .btn{font-family:'IBM Plex Sans';font-size:12px;font-weight:600;border-radius:6px;
    padding:6px 12px;cursor:pointer;display:flex;align-items:center;gap:6px;transition:.15s ease;border:none;text-decoration:none;white-space:nowrap;}
  .btn svg{width:13px;height:13px;}
  .btn-ghost{background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.35);}
  .btn-ghost:hover{background:rgba(255,255,255,.2);}
  .btn-solid{background:linear-gradient(135deg,var(--orange),#F08B2E);color:#fff;box-shadow:0 3px 10px rgba(232,114,12,.35);}
  .btn-solid:hover{box-shadow:0 4px 14px rgba(232,114,12,.5);transform:translateY(-1px);}

  /* ===== Styles Menu Déroulant Profil ===== */
  .user-dropdown-wrap { position: relative; display: inline-block; }
  .user-btn {
    background: rgba(255, 255, 255, 0.12);
    color: #fff;
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: 0.15s ease;
    white-space: nowrap;
  }
  .user-btn:hover { background: rgba(255, 255, 255, 0.22); }
  .user-avatar {
    width: 22px; height: 22px; border-radius: 50%; object-fit: cover;
    background: var(--orange); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 10px; text-transform: uppercase;
  }
  .dropdown-menu {
    position: absolute; right: 0; top: calc(100% + 8px);
    width: 210px; background: #fff; border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    border: 1px solid var(--line); overflow: hidden;
    display: none; flex-direction: column; z-index: 1000;
  }
  .dropdown-menu.show { display: flex; }
  .dropdown-header { padding: 10px 14px; background: var(--paper); border-bottom: 1px solid var(--line); }
  .dropdown-header strong { display: block; font-size: 12.5px; color: var(--navy); }
  .dropdown-header span { font-size: 11px; color: var(--ink-soft); }
  .dropdown-item {
    padding: 9px 14px; font-size: 12px; color: var(--ink); text-decoration: none;
    display: flex; align-items: center; gap: 8px; background: none; border: none;
    width: 100%; text-align: left; cursor: pointer; transition: 0.12s ease;
  }
  .dropdown-item:hover { background: var(--blue-soft); color: var(--navy); }
  .dropdown-item.danger { color: #d9534f; }
  .dropdown-item.danger:hover { background: #fdf2f2; }
  .dropdown-divider { height: 1px; background: var(--line); margin: 3px 0; }

  /* ===== Styles Modales Profil ===== */
  .modal-backdrop {
    position: fixed; inset: 0; background: rgba(11, 35, 64, 0.6); backdrop-filter: blur(3px);
    display: none; align-items: center; justify-content: center; z-index: 2000;
  }
  .modal-backdrop.open { display: flex; }
  .modal-box {
    background: #fff; width: 100%; max-width: 460px; border-radius: 10px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.3); overflow: hidden; animation: modalIn 0.2s ease;
  }
  @keyframes modalIn { from { opacity:0; transform: translateY(-10px); } to { opacity:1; transform: translateY(0); } }
  .modal-header {
    padding: 14px 18px; background: var(--navy); color: #fff;
    display: flex; justify-content: space-between; align-items: center;
  }
  .modal-header h3 { margin: 0; font-family: 'Fraunces', serif; font-size: 16px; }
  .modal-close { background: none; border: none; color: #fff; font-size: 20px; cursor: pointer; opacity: 0.7; }
  .modal-close:hover { opacity: 1; }
  .modal-body { padding: 18px; max-height: 75vh; overflow-y: auto; }
  .modal-footer { padding: 12px 18px; background: var(--paper); border-top: 1px solid var(--line); display: flex; justify-content: flex-end; gap: 8px; }
  .form-group { margin-bottom: 12px; }
  .form-group label { display: block; font-size: 11.5px; font-weight: 600; margin-bottom: 4px; color: var(--navy); }
  .form-control { width: 100%; padding: 7px 10px; font-size: 12.5px; border: 1.5px solid var(--line); border-radius: 6px; font-family: inherit; }
  .form-control:focus { outline: none; border-color: var(--blue); }

  /* ===== Layout ===== */
  /* overflow:hidden ici est la clé : le shell ne défile plus jamais lui-même,
     seul .content-area (ou .stage pour le tableau de bord) défile en interne. */
  .shell{display:flex;height:calc(100vh - 52px);overflow:hidden;}

  /* ===== Zone de contenu générique (toutes les pages) =====
     C'est ce conteneur qui défile désormais, jamais le body ni le menu.
     display:block classique (comme avant) : mdg-wrap et consorts gardent
     leur comportement normal (max-width + margin:auto). */
  .content-area{flex:1;min-width:0;height:100%;overflow-y:auto;}

  /* ===== Zone centrale (tableau de bord : hero / workspace) ===== */
  .stage{height:100%;position:relative;min-width:0;overflow:hidden;background:
    radial-gradient(circle at 15% 15%, var(--blue-soft) 0%, transparent 40%),
    radial-gradient(circle at 85% 85%, var(--green-soft) 0%, transparent 40%),
    #fff;}

  .hero{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;}
  .hero .bg{position:absolute;inset:0;overflow:hidden;}
  .hero .bg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;
    filter:blur(6px) brightness(.55) saturate(1.2);transform:scale(1.08);
    opacity:0;animation:cross 18s infinite;}
  .hero .bg img:nth-child(1){animation-delay:0s;}
  .hero .bg img:nth-child(2){animation-delay:6s;}
  .hero .bg img:nth-child(3){animation-delay:12s;}
  @keyframes cross{0%{opacity:0;} 6%{opacity:1;} 33%{opacity:1;} 40%{opacity:0;} 100%{opacity:0;}}
  .hero .overlay{position:absolute;inset:0;
    background:linear-gradient(160deg, rgba(11,35,64,.55), rgba(31,122,77,.35) 55%, rgba(232,114,12,.3));}
  .hero .content{position:relative;z-index:2;text-align:center;color:#fff;max-width:580px;padding:0 24px;}
  .hero .content .seal{width:70px;height:70px;margin:0 auto 20px;border-width:3px;box-shadow:0 6px 20px rgba(0,0,0,.35);}
  .hero .content h1{font-family:'Fraunces',serif;font-size:34px;font-weight:700;margin:0 0 12px;text-shadow:0 2px 12px rgba(0,0,0,.3);}
  .hero .content p{font-size:14.5px;line-height:1.65;color:#F0F3F7;margin:0;}

  /* ===== Fichiers + éditeur ===== */
  .workspace{position:absolute;inset:0;display:none;}
  .workspace.open{display:flex;}
  .files{width:240px;border-right:1px solid var(--line);background:var(--paper);padding:20px 16px;flex-shrink:0;overflow-y:auto;}
  .files h2{font-family:'Fraunces',serif;font-size:16px;font-weight:700;margin:0 0 4px;color:var(--navy);}
  .files .hint{font-size:11.5px;color:var(--ink-soft);margin:0 0 16px;line-height:1.4;}
  .file-item{display:flex;align-items:center;gap:9px;padding:10px 12px;border-radius:8px;font-size:12.5px;font-family:'IBM Plex Mono';color:var(--ink);cursor:pointer;margin-bottom:5px;border:1.5px solid transparent;transition:.12s ease;}
  .file-item:hover{background:var(--orange-soft);border-color:#F3D3AE;}
  .file-item.active{background:linear-gradient(135deg,var(--navy),var(--navy-2));color:#fff;box-shadow:0 3px 10px rgba(11,35,64,.25);}
  .file-item .dot{width:7px;height:7px;border-radius:50%;flex-shrink:0;}
  .dot.blade{background:var(--orange);box-shadow:0 0 0 3px var(--orange-soft);}
  .dot.css{background:var(--green);box-shadow:0 0 0 3px var(--green-soft);}

  .editor-wrap{flex:1;display:flex;flex-direction:column;min-width:0;}
  .tabs{display:flex;background:#0A1524;border-bottom:2px solid var(--orange);}
  .tab{padding:11px 18px;font-size:12.5px;font-family:'IBM Plex Mono';color:#6E82A0;border-right:1px solid #1C2E48;cursor:pointer;display:flex;align-items:center;gap:8px;}
  .tab.active{color:#fff;background:var(--code-bg);}
  .editor{flex:1;background:var(--code-bg);overflow:auto;padding:24px 28px;font-family:'IBM Plex Mono',monospace;font-size:13px;line-height:1.75;}
  .ln{display:flex;} .ln .no{width:34px;color:#3E5578;text-align:right;margin-right:20px;user-select:none;flex-shrink:0;} .ln .code{color:#E3ECF6;white-space:pre;}
  .tag{color:#6FB6EA;} .attr{color:#F0CD7A;} .str{color:#9CD98A;} .php{color:#F0A06E;}
  .status{height:32px;background:linear-gradient(90deg,var(--navy),var(--navy-2));color:#B9C9DC;font-size:11px;font-family:'IBM Plex Mono';display:flex;align-items:center;padding:0 18px;gap:18px;}
  .status .ok{color:#6FDB93;font-weight:600;}
</style>
</head>
<body>

<div class="topbar">
  <a href="{{ route('accueiladmin') }}" class="brand-link">
    <img class="seal" src="{{ asset('storage/' . $siteSettings?->logo_principal) }}" alt="Logo DGAMP">
    <div class="brand">DGAM<small>Gestionnaire du site</small></div>
  </a>
  <div class="right">
    <a href="" download class="btn btn-ghost"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg>Télécharger le guide</a>
    <a href="{{ url('/') }}" target="_blank" class="btn btn-solid"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 3H3v10h10v-3M9 2h5v5M14 2L7 9"/></svg>Voir le site</a>

    {{-- Menu Déroulant Profil --}}
    @php $admin = auth('admin')->user(); @endphp
    <div class="user-dropdown-wrap">
      <button type="button" class="user-btn" id="userMenuBtn">
        @if(!empty($admin->photo))
          <img class="user-avatar" src="{{ asset('storage/' . $admin->photo) }}" alt="Photo">
        @else
          <span class="user-avatar">{{ substr($admin->nom ?? 'A', 0, 1) }}</span>
        @endif
        <span>{{ $admin->nom ?? 'Administrateur' }}</span>
        <svg viewBox="0 0 16 16" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6l4 4 4-4"/></svg>
      </button>

      <div class="dropdown-menu" id="userDropdown">
        <div class="dropdown-header">
          <strong>{{ $admin->nom ?? 'Administrateur' }}</strong>
          <span>{{ $admin->email ?? '' }}</span>
        </div>
        
        <button type="button" class="dropdown-item" onclick="openModal('modalViewProfile')">
          <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="8" cy="5" r="3"/><path d="M2 14c0-3 3-4 6-4s6 1 6 4"/></svg>
          Mon profil
        </button>

        <button type="button" class="dropdown-item" onclick="openModal('modalEditProfile')">
          <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M11 2l3 3-9 9H2v-3l9-9z"/></svg>
          Modifier mon profil
        </button>

        <div class="dropdown-divider"></div>

        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="dropdown-item danger">
            <svg viewBox="0 0 16 16" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2H3v12h3M10 4l4 4-4 4M14 8H6"/></svg>
            Déconnexion
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="shell">

  @include('Espace_admin.navbar')

  <div class="content-area">
    @yield('content')
  </div>

</div>

{{-- MODALE 1 : Mon Profil --}}
<div class="modal-backdrop" id="modalViewProfile">
  <div class="modal-box">
    <div class="modal-header">
      <h3>Mon Profil</h3>
      <button class="modal-close" onclick="closeModal('modalViewProfile')">&times;</button>
    </div>
    <div class="modal-body">
      <div style="text-align:center; margin-bottom: 16px;">
        @if(!empty($admin->photo))
          <img src="{{ asset('storage/' . $admin->photo) }}" style="width:75px; height:75px; border-radius:50%; object-fit:cover; border:2px solid var(--gold);" alt="Photo">
        @else
          <div style="width:75px; height:75px; border-radius:50%; background:var(--orange); color:#fff; display:inline-flex; align-items:center; justify-content:center; font-size:24px; font-weight:700; margin:0 auto;">
            {{ substr($admin->nom ?? 'A', 0, 1) }}
          </div>
        @endif
      </div>
      <p><strong>Nom :</strong> {{ $admin->nom ?? 'N/A' }}</p>
      <p><strong>Adresse e-mail :</strong> {{ $admin->email ?? 'N/A' }}</p>
      <p><strong>Contact :</strong> {{ $admin->contact ?? 'Non renseigné' }}</p>
      <p><strong>Dernière connexion :</strong> {{ $admin->derniere_connexion ?? 'N/A' }}</p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" style="color:var(--ink);" onclick="closeModal('modalViewProfile')">Fermer</button>
      <button class="btn btn-solid" onclick="closeModal('modalViewProfile'); openModal('modalEditProfile');">Modifier</button>
    </div>
  </div>
</div>

{{-- MODALE 2 : Modifier mon Profil --}}
<div class="modal-backdrop" id="modalEditProfile">
  <div class="modal-box">
    <div class="modal-header">
      <h3>Modifier le Profil</h3>
      <button class="modal-close" onclick="closeModal('modalEditProfile')">&times;</button>
    </div>
    <form method="POST" action="{{ route('admin.profil.update', $admin->id ?? 0) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-body">
        <div class="form-group">
          <label>Photo de profil</label>
          <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
          <label>Nom</label>
          <input type="text" name="nom" class="form-control" value="{{ old('nom', $admin->nom ?? '') }}" required>
        </div>
        <div class="form-group">
          <label>Adresse e-mail</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email ?? '') }}" required>
        </div>
        <div class="form-group">
          <label>Contact / Téléphone</label>
          <input type="text" name="contact" class="form-control" value="{{ old('contact', $admin->contact ?? '') }}">
        </div>
        <div class="form-group">
          <label>Nouveau mot de passe (laisser vide si inchangé)</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" style="color:var(--ink);" onclick="closeModal('modalEditProfile')">Annuler</button>
        <button type="submit" class="btn btn-solid">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

<script>
  const userBtn = document.getElementById('userMenuBtn');
  const userDropdown = document.getElementById('userDropdown');

  if(userBtn) {
    userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      userDropdown.classList.toggle('show');
    });
  }

  document.addEventListener('click', () => {
    if(userDropdown) userDropdown.classList.remove('show');
  });

  function openModal(id) {
    document.getElementById(id).classList.add('open');
  }

  function closeModal(id) {
    document.getElementById(id).classList.remove('open');
  }
</script>

</body>
</html>