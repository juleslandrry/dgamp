<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>DGAM — Gestionnaire de code source</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" href="assets/images/logo_Dgamp.jpeg" type="image/jp">
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
    position:relative;
  }
  .topbar::after{content:"";position:absolute;left:0;right:0;bottom:0;height:3px;
    background:linear-gradient(90deg,var(--orange) 0 33%,#fff 33% 66%,var(--green) 66% 100%);}
  .seal{width:28px;height:28px;border-radius:50%;flex-shrink:0;object-fit:cover;
    border:2px solid var(--gold);box-shadow:0 2px 6px rgba(0,0,0,.25);background:#fff;}
  .brand{font-family:'Fraunces',serif;font-weight:700;font-size:15.5px;color:#fff;letter-spacing:.01em;}
  .brand small{display:block;font-family:'IBM Plex Sans';font-weight:500;font-size:9px;color:var(--gold);letter-spacing:.1em;text-transform:uppercase;margin-top:1px;}

  /* lien englobant le logo + le texte de marque, pour revenir au dashboard */
  .brand-link{display:flex;align-items:center;gap:12px;text-decoration:none;cursor:pointer;}

  .topbar .right{margin-left:auto;display:flex;align-items:center;gap:10px;}
  .btn{font-family:'IBM Plex Sans';font-size:12px;font-weight:600;border-radius:6px;
    padding:8px 14px;cursor:pointer;display:flex;align-items:center;gap:6px;transition:.15s ease;border:none;text-decoration:none;}
  .btn svg{width:13px;height:13px;}
  .btn-ghost{background:rgba(255,255,255,.1);color:#fff;border:1.5px solid rgba(255,255,255,.35);}
  .btn-ghost:hover{background:rgba(255,255,255,.2);}
  .btn-solid{background:linear-gradient(135deg,var(--orange),#F08B2E);color:#fff;box-shadow:0 3px 10px rgba(232,114,12,.35);}
  .btn-solid:hover{box-shadow:0 4px 14px rgba(232,114,12,.5);transform:translateY(-1px);}

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
    <img class="seal" src="{{ asset('assets/images/logo_Dgamp.jpeg') }}" alt="Logo DGAMP">
    <div class="brand">DGAM<small>Gestionnaire de code source</small></div>
  </a>
  <div class="right">
    <a href="" download class="btn btn-ghost"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg>Télécharger le guide</a>
    <a href="{{ url('/') }}" target="_blank" class="btn btn-solid"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 3H3v10h10v-3M9 2h5v5M14 2L7 9"/></svg>Voir le site</a>
  </div>
</div>

<div class="shell">

  @include('Espace_admin.navbar')

  <div class="content-area">
    @yield('content')
  </div>

</div>

</body>
</html>