<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>DGAM — Espace de connexion</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --navy:#0B2340;
    --navy-2:#123A63;
    --blue:#1E7FB8;
    --orange:#E8720C;
    --green:#1F7A4D;
    --gold:#C9A227;
    --ink:#1C2733;
    --ink-soft:#66707B;
    --line:#E7E2D6;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;height:100%;font-family:'IBM Plex Sans',sans-serif;color:var(--ink);}
  ::selection{background:var(--gold);color:#fff;}

  .screen{position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;background:var(--navy);padding:24px;}

  /* fond flouté défilant, identique en esprit à l'accueil du gestionnaire */
  .bg{position:absolute;inset:0;overflow:hidden;}
  .bg img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;
    filter:blur(7px) brightness(.5) saturate(1.2);transform:scale(1.08);
    opacity:0;animation:cross 18s infinite;}
  .bg img:nth-child(1){animation-delay:0s;}
  .bg img:nth-child(2){animation-delay:6s;}
  .bg img:nth-child(3){animation-delay:12s;}
  @keyframes cross{0%{opacity:0;} 6%{opacity:1;} 33%{opacity:1;} 40%{opacity:0;} 100%{opacity:0;}}
  .overlay{position:absolute;inset:0;
    background:linear-gradient(160deg, rgba(11,35,64,.72), rgba(31,122,77,.4) 60%, rgba(232,114,12,.35));}

  /* liseré tricolore discret en haut de l'écran */
  .flag-line{position:absolute;top:0;left:0;right:0;height:5px;z-index:3;
    background:linear-gradient(90deg,var(--orange) 0 33%,#fff 33% 66%,var(--green) 66% 100%);}

  /* carte de connexion */
  .card{
    position:relative;z-index:2;width:100%;max-width:400px;background:#fff;
    border-radius:16px;box-shadow:0 24px 60px rgba(0,0,0,.35);overflow:hidden;
    animation:rise .5s ease both;
  }
  @keyframes rise{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}

  .card-head{
    padding:34px 32px 26px;text-align:center;
    background:linear-gradient(100deg,var(--navy) 0%,var(--navy-2) 65%,#164A78 100%);
    position:relative;
  }
  .card-head::after{content:"";position:absolute;left:0;right:0;bottom:0;height:3px;
    background:linear-gradient(90deg,var(--orange) 0 33%,#fff 33% 66%,var(--green) 66% 100%);}
  .seal{width:62px;height:62px;border-radius:50%;object-fit:cover;border:2.5px solid var(--gold);
    box-shadow:0 4px 14px rgba(0,0,0,.3);margin-bottom:14px;}
  .card-head h1{font-family:'Fraunces',serif;font-weight:700;font-size:19px;color:#fff;margin:0;letter-spacing:.01em;}
  .card-head p{font-size:11.5px;color:var(--gold);text-transform:uppercase;letter-spacing:.14em;margin:6px 0 0;font-weight:600;}

  .card-body{padding:30px 32px 32px;}

  .field{margin-bottom:18px;}
  .field label{display:block;font-size:12.5px;font-weight:600;color:var(--ink);margin-bottom:7px;}
  .field .input-wrap{position:relative;display:flex;align-items:center;}
  .field .input-wrap svg{position:absolute;left:13px;width:16px;height:16px;color:var(--ink-soft);pointer-events:none;}
  .field input{
    width:100%;padding:12px 14px 12px 40px;border:1.5px solid var(--line);border-radius:9px;
    font-size:14px;font-family:'IBM Plex Sans';color:var(--ink);transition:.15s ease;background:#FCFBF7;
  }
  .field input:focus{outline:none;border-color:var(--blue);background:#fff;box-shadow:0 0 0 3px rgba(30,127,184,.12);}
  .field .toggle-pw{position:absolute;right:12px;cursor:pointer;color:var(--ink-soft);background:none;border:none;padding:2px;display:flex;}
  .field .toggle-pw svg{position:static;}

  .row-between{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;font-size:12.5px;}
  .remember{display:flex;align-items:center;gap:7px;color:var(--ink-soft);cursor:pointer;user-select:none;}
  .remember input{width:15px;height:15px;accent-color:var(--blue);cursor:pointer;}
  .forgot{color:var(--blue);text-decoration:none;font-weight:600;}
  .forgot:hover{text-decoration:underline;}

  .submit{
    width:100%;padding:13px;border:none;border-radius:9px;cursor:pointer;
    background:linear-gradient(135deg,var(--orange),#F08B2E);color:#fff;
    font-family:'IBM Plex Sans';font-size:14px;font-weight:700;letter-spacing:.01em;
    box-shadow:0 6px 16px rgba(232,114,12,.35);transition:.15s ease;
    display:flex;align-items:center;justify-content:center;gap:8px;
  }
  .submit:hover{box-shadow:0 8px 20px rgba(232,114,12,.5);transform:translateY(-1px);}
  .submit svg{width:16px;height:16px;}

  .error{
    background:#FDECEC;border:1px solid #F3C4C4;color:#B23A3A;font-size:12.5px;
    padding:10px 14px;border-radius:8px;margin-bottom:18px;display:flex;align-items:center;gap:8px;
  }
  .error svg{width:15px;height:15px;flex-shrink:0;}

  .back{
    position:relative;z-index:2;margin-top:18px;text-align:center;
  }
  .back a{color:rgba(255,255,255,.85);font-size:12.5px;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
  .back a:hover{color:#fff;}
  .back svg{width:13px;height:13px;}
</style>
</head>
<body>

<div class="screen">
  <div class="flag-line"></div>
  <div class="bg">
    <img src="img/image33.jpeg" alt="">
    <img src="img/image34.jpeg" alt="">
    <img src="img/image39.jpeg" alt="">
  </div>
  <div class="overlay"></div>

  <div>
    <div class="card">
      <div class="card-head">
        <img class="seal" src="{{ asset ('assets/images/logo_Dgamp.jpeg')}}" alt="Logo DGAMP">
        <h1>Espace Administrateur</h1>
        <p>DGAM · Gestionnaire de contenu</p>
      </div>

      <div class="card-body">

        {{-- @if ($errors->any()) --}}
        {{-- <div class="error">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="8" r="6.3"/><path d="M8 5v4M8 11h.01"/></svg>
          <span>Identifiant ou mot de passe incorrect.</span>
        </div> --}}
        {{-- @endif --}}

        <form method="POST" action="#">
          @csrf

          <div class="field">
            <label for="email">Adresse e-mail</label>
            <div class="input-wrap">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h12v8H2z"/><path d="M2 4l6 5 6-5"/></svg>
              <input type="email" id="email" name="email" placeholder="admin@dgamp.ci" required autofocus>
            </div>
          </div>

          <div class="field">
            <label for="password">Mot de passe</label>
            <div class="input-wrap">
              <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="10" height="7" rx="1.2"/><path d="M5 7V4.5a3 3 0 016 0V7"/></svg>
              <input type="password" id="password" name="password" placeholder="••••••••" required>
              <button type="button" class="toggle-pw" id="togglePw" title="Afficher le mot de passe">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M1 8s2.5-5 7-5 7 5 7 5-2.5 5-7 5-7-5-7-5z"/><circle cx="8" cy="8" r="2"/></svg>
              </button>
            </div>
          </div>

          <button type="submit" class="submit">
            Se connecter
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
          </button>
        </form>

      </div>
    </div>

  </div>
</div>

<script>
  document.getElementById('togglePw').addEventListener('click', ()=>{
    const pw = document.getElementById('password');
    pw.type = pw.type === 'password' ? 'text' : 'password';
  });
</script>

</body>
</html>



{{-- <!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>DGAM — Gestionnaire de code source</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="icon" type="image/jpeg" href="{{ asset('assets/images/logo_dgamp.jpeg') }}">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=IBM+Plex+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

</head>
<body>

<div class="topbar">
  <img class="seal" src="{{ asset('assets/images/logo_dgamp.jpeg') }}" alt="Logo DGAMP">
  <div class="brand">DGAM<small>Gestionnaire de code source</small></div>
  <div class="right">
    <a href="{{ asset('assets/guide/guide-utilisation-dgamp.pdf') }}" download class="btn btn-ghost"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg>Télécharger le guide</a>
    <a href="{{ url('/') }}" target="_blank" class="btn btn-solid"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 3H3v10h10v-3M9 2h5v5M14 2L7 9"/></svg>Voir le site</a>
  </div>
</div>

<div class="shell">

  <nav class="nav" id="navEl">
    <div class="nav-title">Pages du site</div>
    <ul class="tree" id="tree">
      <li>
        <div class="node" data-toggle="accueil">
          <span class="icon-badge"><svg viewBox="0 0 16 16" fill="currentColor"><path d="M8 1l7 6v8H1V7z"/></svg></span>
          Accueil
          <svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg>
        </div>
        <ul class="sub" id="accueil">

          <li><div class="group-label">Connaître la DGAM <span class="sep">›</span> Directeur Général</div></li>
          <li><a href="{{ route('admin.motdudg') }}" class="node"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg>Mot du DG</a></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h12v8H2z"/><path d="M2 4l6 5 6-5"/></svg>Ecrire au DG</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="5.3" r="2.3"/><path d="M3 14c0-2.8 2.2-5 5-5s5 2.2 5 5"/></svg>Biographie</div></li>

          <li><div class="group-label">Connaître la DGAM <span class="sep">›</span> Organisation</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2.2 1.3"/></svg>Historique</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><circle cx="8" cy="8" r="3"/><circle cx="8" cy="8" r=".4" fill="currentColor"/></svg>Mission et Objectifs</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="1.5" width="4" height="3"/><rect x="1" y="10.5" width="4" height="3"/><rect x="11" y="10.5" width="4" height="3"/><path d="M8 4.5v3.5M8 8h-5v2.5M8 8h5v2.5"/></svg>Organigramme</div></li>

          <li><div class="group-label">Connaître la DGAM <span class="sep">›</span> Documentation</div></li>
          <li>
            <div class="node" data-toggle="textesnat"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 2v12M2 3h10l-2 2 2 2H2"/></svg>Textes nationaux<svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg></div>
            <ul class="sub" id="textesnat">
              <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Lois</div></li>
              <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Décrets</div></li>
              <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Arrêtés et Décisions</div></li>
            </ul>
          </li>
          <li>
            <div class="node" data-toggle="textesint"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M2 8h12M8 2c1.8 2 1.8 10 0 12M8 2c-1.8 2-1.8 10 0 12"/></svg>Textes Internationaux<svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg></div>
            <ul class="sub" id="textesint">
              <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Conventions</div></li>
              <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Accords</div></li>
              <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Protocoles</div></li>
            </ul>
          </li>

          <li><div class="group-label">Agenda</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg>Evènements</div></li>

          <li><div class="group-label">Recrutement</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="12" height="8" rx="1.2"/><path d="M6 5V3h4v2M2 9h12"/></svg>ENA</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="12" height="8" rx="1.2"/><path d="M6 5V3h4v2M2 9h12"/></svg>Fonction Publique</div></li>

          <li><div class="group-label">Multimédia</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg>Galerie Images</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="8" height="8" rx="1.2"/><path d="M10 6.3l4-1.8v7l-4-1.8z"/></svg>Galerie Vidéos</div></li>

          <li><div class="group-label">Communication</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 1h7l3 3v11H3z"/></svg>Communiqué</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg>Actualités</div></li>

        </ul>
      </li>

      <li><div class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 13l3-5 3 3 3-6 3 8"/></svg></span>Nos Activités</div></li>

      <li><div class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6.3"/><path d="M1.7 8h12.6M8 1.7c1.8 2 1.8 10.6 0 12.6M8 1.7c-1.8 2-1.8 10.6 0 12.6"/></svg></span>Services en Ligne</div></li>

      <li>
        <div class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 14.5S3 10 3 6.3a5 5 0 0110 0C13 10 8 14.5 8 14.5z"/><circle cx="8" cy="6.3" r="1.8"/></svg></span>Régions et Arrondissements</div>
      </li>

      <li>
        <div class="node" data-toggle="perso">
          <span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="5.7" cy="6" r="2.1"/><circle cx="10.6" cy="6" r="2.1"/><path d="M2 14c0-2.4 1.7-4.2 3.7-4.2M9.9 9.8c2 0 3.7 1.8 3.7 4.2"/></svg></span>
          Nos Personnels
          <svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg>
        </div>
        <ul class="sub" id="perso">
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1.5l5 2v4c0 3.6-2.2 5.9-5 6.7-2.8-.8-5-3.1-5-6.7v-4z"/></svg>Personnels millitaires</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="5.7" cy="6" r="2"/><circle cx="10.6" cy="6" r="2"/><path d="M2.3 13.7c0-2.3 1.6-4 3.6-4M10.1 9.7c2 0 3.6 1.7 3.6 4"/></svg>Personnels interministériels</div></li>
        </ul>
      </li>

      <li>
        <div class="node" data-toggle="vie">
          <span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 1h7l3 3v11H3z"/></svg></span>
          Vie associative
          <svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg>
        </div>
        <ul class="sub" id="vie">
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9a4 4 0 014-4h2a3 3 0 013 3v.5l1.2.9-1.2.9v.7a1 1 0 01-1 1h-1v1H7v-1H6a3 3 0 01-3-3z"/><circle cx="10.3" cy="7.3" r=".5" fill="currentColor"/></svg>Fond de prévoyance</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M8 13.5S2.5 10 2.5 6.3A2.8 2.8 0 018 4.6a2.8 2.8 0 015.5 1.7c0 3.7-5.5 7.2-5.5 7.2z"/></svg>Vie sociales</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="5.7" cy="6" r="2"/><circle cx="10.6" cy="6" r="2"/><path d="M2.3 13.7c0-2.3 1.6-4 3.6-4M10.1 9.7c2 0 3.6 1.7 3.6 4"/></svg>Autres associations</div></li>
        </ul>
      </li>

      <li><div class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="5.3" r="2.6"/><path d="M2.7 14a5.3 5.3 0 0110.6 0"/></svg></span>Opérateurs</div></li>
      <li><div class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h5l1 2h6v8H2z"/></svg></span>Partenaires</div></li>

      <li>
        <div class="node" data-toggle="parametres">
          <span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="2.3"/><path d="M8 1.5v1.6M8 12.9v1.6M14.5 8h-1.6M3.1 8H1.5M12.5 3.5l-1.1 1.1M4.6 11.3l-1.1 1.1M12.5 12.5l-1.1-1.1M4.6 4.7L3.5 3.5"/></svg></span>
          Paramètres
          <svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg>
        </div>
        <ul class="sub" id="parametres">
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 4.5h11M2.5 8h11M2.5 11.5h11"/><circle cx="6" cy="4.5" r="1.1" fill="currentColor" stroke="none"/><circle cx="10.5" cy="8" r="1.1" fill="currentColor" stroke="none"/><circle cx="5.5" cy="11.5" r="1.1" fill="currentColor" stroke="none"/></svg>Paramètre d'apparence</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg>Galerie</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="8" height="8" rx="1.2"/><path d="M10 6.3l4-1.8v7l-4-1.8z"/></svg>Vidéos</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 13.5V9l3-3 3 2 4-5 2 2v8.5z"/><path d="M2 13.5h12"/></svg>Statistique</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 2.5h12v8H9l-1.5 3-1.5-3H2z"/></svg>Banière</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M9 1L3 9h4l-1 6 6-8H8z"/></svg>Flash info</div></li>
          <li><div class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="5.7" cy="6" r="2"/><circle cx="10.6" cy="6" r="2"/><path d="M2.3 13.7c0-2.3 1.6-4 3.6-4M10.1 9.7c2 0 3.6 1.7 3.6 4"/></svg>Administrateurs</div></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div class="stage">

    <div class="hero" id="hero">
      <div class="bg">
        <img src="{{ asset('assets/images/image33.jpeg') }}" alt="">
        <img src="{{ asset('assets/images/image34.jpeg') }}" alt="">
        <img src="{{ asset('assets/images/image39.jpeg') }}" alt="">
      </div>
      <div class="overlay"></div>
      <div class="content">
<img class="seal" src="{{ asset('assets/images/logo_dgamp.jpeg') }}" alt="Logo DGAMP">
        <h1>Bienvenue dans le gestionnaire DGAM</h1>
        <p>Sélectionnez une page dans le menu à gauche pour consulter ou modifier son contenu en toute simplicité.</p>
      </div>
    </div>

    <div class="workspace" id="workspace">
      <div class="files">
        <h2>Permis de conduire</h2>
        <p class="hint">Fichiers liés à cette page. Cliquez pour ouvrir dans l'éditeur.</p>
        <div class="file-item active"><span class="dot blade"></span>formulaire.blade.php</div>
        <div class="file-item"><span class="dot blade"></span>conditions.blade.php</div>
        <div class="file-item"><span class="dot css"></span>style.css</div>
      </div>
      <div class="editor-wrap">
        <div class="tabs">
          <div class="tab active">formulaire.blade.php</div>
          <div class="tab">style.css</div>
        </div>
        <div class="editor">
<div class="ln"><span class="no">1</span><span class="code"><span class="tag">@@extends</span>(<span class="str">'layouts.app'</span>)</span></div>
<div class="ln"><span class="no">2</span><span class="code"></span></div>
<div class="ln"><span class="no">3</span><span class="code"><span class="tag">@@section</span>(<span class="str">'content'</span>)</span></div>
<div class="ln"><span class="no">4</span><span class="code"></span></div>
<div class="ln"><span class="no">5</span><span class="code">&lt;<span class="tag">section</span> <span class="attr">class</span>=<span class="str">"immat-form py-5"</span>&gt;</span></div>
<div class="ln"><span class="no">6</span><span class="code">  &lt;<span class="tag">h1</span> <span class="attr">class</span>=<span class="str">"immat-title"</span>&gt;Demande de permis&lt;/<span class="tag">h1</span>&gt;</span></div>
<div class="ln"><span class="no">7</span><span class="code"></span></div>
<div class="ln"><span class="no">8</span><span class="code">  &lt;<span class="tag">form</span> <span class="attr">method</span>=<span class="str">"POST"</span> <span class="attr">action</span>=<span class="str">"@{{ route('permis.store') }}"</span>&gt;</span></div>
<div class="ln"><span class="no">9</span><span class="code">    <span class="php">@@csrf</span></span></div>
<div class="ln"><span class="no">10</span><span class="code">    &lt;<span class="tag">input</span> <span class="attr">name</span>=<span class="str">"nom_demandeur"</span> <span class="attr">class</span>=<span class="str">"form-control"</span>&gt;</span></div>
<div class="ln"><span class="no">11</span><span class="code">  &lt;/<span class="tag">form</span>&gt;</span></div>
<div class="ln"><span class="no">12</span><span class="code">&lt;/<span class="tag">section</span>&gt;</span></div>
<div class="ln"><span class="no">13</span><span class="code"></span></div>
<div class="ln"><span class="no">14</span><span class="code"><span class="tag">@@endsection</span></span></div>
        </div>
        <div class="status">
          <span>Blade · UTF-8</span>
          <span>Ligne 10, Col 22</span>
          <span class="ok">● Sauvegarde automatique activée</span>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  document.querySelectorAll('.node').forEach(el=>{
    el.addEventListener('click', (e)=>{
      e.stopPropagation();

      // Surbrillance : toujours retirer partout puis appliquer sur l'élément cliqué
      document.querySelectorAll('.node').forEach(n=>n.classList.remove('active'));
      el.classList.add('active');

      // Si l'onglet a un sous-menu : ouvrir/fermer
      if(el.dataset.toggle){
        const sub = document.getElementById(el.dataset.toggle);
        if(sub) sub.classList.toggle('open');
        const caret = el.querySelector('.caret');
        if(caret) caret.classList.toggle('open');
      }

      // Si l'onglet cible une zone d'affichage (accueil / éditeur)
      if(el.dataset.target){
        const target = el.dataset.target;
        document.getElementById('hero').style.display = target==='hero' ? 'flex':'none';
        document.getElementById('workspace').classList.toggle('open', target==='workspace');
      }
    });
  });
</script>

</body>
</html> --}}