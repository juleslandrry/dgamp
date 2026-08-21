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
          <li><a href="{{ route('motdg') }}" class="node"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg>Mot du DG</a></li>
          <li><a href="#"  class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h12v8H2z"/><path d="M2 4l6 5 6-5"/></svg>Biographie</a></li>

          <li><div class="group-label">Connaître la DGAM <span class="sep">›</span> Organisation</div></li>
          <li><a href="{{ route('admin.historique') }}"  class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2.2 1.3"/></svg>Historique</a></li>
          <li><a href="{{ route('admin.missions') }}"  class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><circle cx="8" cy="8" r="3"/><circle cx="8" cy="8" r=".4" fill="currentColor"/></svg>Mission et Objectifs</a></li>
          <li><a href="{{ route('admin.organigramme') }}"  class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="1.5" width="4" height="3"/><rect x="1" y="10.5" width="4" height="3"/><rect x="11" y="10.5" width="4" height="3"/><path d="M8 4.5v3.5M8 8h-5v2.5M8 8h5v2.5"/></svg>Organigramme</a></li>

          <li><div class="group-label">Connaître la DGAM <span class="sep">›</span> Documentation</div></li>
          <li>
            <div class="node" data-toggle="textesnat"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 2v12M2 3h10l-2 2 2 2H2"/></svg>Textes nationaux<svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg></div>
            <ul class="sub" id="textesnat">
              <li><a href="{{ route('lois.index') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Lois</a></li>
              <li><a href="{{ route('decrets.index') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Décrets</a></li>
              <li><a href="{{ route('arretes.index') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Arrêtés et Décisions</a></li>
            </ul>
          </li>
          <li>
            <div class="node" data-toggle="textesint"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M2 8h12M8 2c1.8 2 1.8 10 0 12M8 2c-1.8 2-1.8 10 0 12"/></svg>Textes Internationaux<svg class="caret" viewBox="0 0 16 16"><path fill="currentColor" d="M4 2l8 6-8 6z"/></svg></div>
            <ul class="sub" id="textesint">
              <li><a href="{{ route('conventions.edit') }}"class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Conventions</a></li>
              <li><a href="{{ route('accords.edit') }}"class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Accords</a></li>
              <li><a href="{{ route('protocoles.edit') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg>Protocoles</a></li>
            </ul>
          </li>

          <li><div class="group-label">Agenda</div></li>
          <li><a href="{{ route('evenements') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="11" rx="1.2"/><path d="M2 6.5h12M5 2v3M11 2v3"/></svg>Evènements</a></li>

          <li><div class="group-label">Recrutement</div></li>
          <li><a href="{{ route('ena') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="12" height="8" rx="1.2"/><path d="M6 5V3h4v2M2 9h12"/></svg>ENA</a></li>
          <li><a href="{{ route('fonction-publique') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="12" height="8" rx="1.2"/><path d="M6 5V3h4v2M2 9h12"/></svg>Fonction Publique</a></li>

          <li><div class="group-label">Multimédia</div></li>
          <li><a href="{{ route('galerie') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><circle cx="5.5" cy="6.5" r="1.1"/><path d="M2.5 11.5l3.5-3.5L9 11l2-2 2.5 2.5"/></svg>Galerie Images</a></li>
          <li><a href="{{ route('videos') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="8" height="8" rx="1.2"/><path d="M10 6.3l4-1.8v7l-4-1.8z"/></svg>Galerie Vidéos</a></li>

          <li><div class="group-label">Communication</div></li>
          <li><a href="{{ route('communiques.index') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M3 1h7l3 3v11H3z"/></svg>Communiqué</a></li>
          <li><a href="{{ route('actualites.index') }}" class="node" data-target="hero"><svg class="gi" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg>Actualités</a></li>

        </ul>
      </li>

      <li><a href="{{ route('activites.index') }}" class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 13l3-5 3 3 3-6 3 8"/></svg></span>Nos Activités</a></li>

      <li><a href="{{ route('services-en-ligne') }}" class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6.3"/><path d="M1.7 8h12.6M8 1.7c1.8 2 1.8 10.6 0 12.6M8 1.7c-1.8 2-1.8 10.6 0 12.6"/></svg></span>Services en Ligne</a></li>

      <li>
        <a href="arrondissements" class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 14.5S3 10 3 6.3a5 5 0 0110 0C13 10 8 14.5 8 14.5z"/><circle cx="8" cy="6.3" r="1.8"/></svg></span>Régions et Arrondissements</a>
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

      <li><a href="{{ route('operateurs.index') }}" class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="5.3" r="2.6"/><path d="M2.7 14a5.3 5.3 0 0110.6 0"/></svg></span>Opérateurs</a></li>
      <li><a href="{{ route('partenaires.index') }}" class="node" data-target="hero"><span class="icon-badge"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h5l1 2h6v8H2z"/></svg></span>Partenaires</a></li>

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

<style>
   /* ===== NOUVEAU DESIGN DE MENU : capsules avec pastille d'icône colorée ===== */
  .nav{width:280px;background:var(--paper);overflow-y:auto;padding:18px 14px 40px;
    border-right:1px solid var(--line);flex-shrink:0;box-shadow:2px 0 10px rgba(11,35,64,.03);}
  .nav-title{font-size:10.5px;text-transform:uppercase;letter-spacing:.14em;color:var(--orange);
    padding:0 8px 14px;font-weight:700;display:flex;align-items:center;gap:6px;}
  .nav-title::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

  ul.tree{list-style:none;margin:0;padding:0;}
  .tree li{position:relative;margin-bottom:2px;}

  .tree .node{
    display:flex;align-items:center;gap:10px;padding:9px 12px;font-size:13.8px;font-weight:500;
    cursor:pointer;color:var(--ink);transition:.15s ease;user-select:none;border-radius:11px;
    position:relative;
  }
  a.node{text-decoration:none;}
  .tree .node,.tree .node *{cursor:pointer;}

  /* pastille d'icône ronde colorée, façon "avatar" */
  .tree > li > .node .icon-badge{
    width:28px;height:28px;border-radius:9px;flex-shrink:0;display:flex;align-items:center;justify-content:center;
    background:var(--blue-soft);color:var(--blue);transition:.15s ease;
  }
  .tree > li > .node .icon-badge svg{width:15px;height:15px;}
  .tree > li > .node:hover{background:#F4F1E9;}
  .tree > li > .node:hover .icon-badge{background:var(--blue);color:#fff;}
  .tree > li > .node.active{background:var(--navy);color:#fff;box-shadow:0 4px 14px rgba(11,35,64,.25);}
  .tree > li > .node.active .icon-badge{background:var(--orange);color:#fff;}
  .tree > li > .node.active .caret{color:#fff;}

  /* items de sous-niveau : simple puce colorée au lieu d'une pastille pleine */
  .tree .sub .node{padding:8px 12px 8px 18px;font-size:13.2px;}
  .tree .sub .node::before{content:"";width:5px;height:5px;border-radius:50%;background:var(--green);opacity:.5;flex-shrink:0;transition:.15s ease;}
  .tree .sub .node:hover{background:var(--green-soft);color:var(--green);}
  .tree .sub .node:hover::before{opacity:1;transform:scale(1.3);}
  .tree .sub .node.active{background:var(--green);color:#fff;font-weight:700;}
  .tree .sub .node.active::before{background:#fff;opacity:1;}
  .tree .sub .sub .node{padding-left:32px;}
  .tree .sub .sub .sub .node{padding-left:46px;}

  .tree .caret{width:9px;height:9px;flex-shrink:0;transition:transform .15s ease;opacity:.5;margin-left:auto;}
  .tree .caret.open{transform:rotate(90deg);}
  .tree ul.sub{list-style:none;margin:4px 0 6px;padding-left:8px;overflow:hidden;max-height:0;
    transition:max-height .2s ease;position:relative;border-left:2px solid var(--line);margin-left:14px;}
  .tree ul.sub.open{max-height:3000px;}

  .badge{margin-left:auto;font-size:9px;font-family:'IBM Plex Mono';padding:2px 7px;border-radius:8px;background:var(--gold-soft);color:#8A6D14;font-weight:600;}
  .group-label{font-size:10px;color:var(--ink-soft);padding:14px 10px 6px 22px;font-weight:700;
    display:flex;align-items:center;gap:5px;letter-spacing:.03em;cursor:default;text-transform:uppercase;}
  .group-label,.group-label *{cursor:default;}
  .group-label .sep{color:var(--gold);}

  .gi{width:14px;height:14px;flex-shrink:0;opacity:.85;}
  .circ{width:11px;height:11px;flex-shrink:0;border:2px solid currentColor;border-radius:50%;opacity:.7;}


</style>

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
