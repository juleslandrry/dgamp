@extends('Espace_admin.layout')
@section('content')

<div class="stage">

    <div class="hero" id="hero">
      <div class="bg">
        <img src="{{ asset('assets/images/image33.jpeg') }}" alt="">
        <img src="{{ asset('assets/images/image34.jpeg') }}" alt="">
        <img src="{{ asset('assets/images/image39.jpeg') }}" alt="">
      </div>
      <div class="overlay"></div>
      <div class="content">
        <img class="seal" src="{{ asset('assets/images/logo_Dgamp.jpeg') }}" alt="Logo DGAMP">
        <h1>Bienvenue dans le gestionnaire DGAM</h1>
        <p>Sélectionnez une page dans le menu à gauche pour consulter ou modifier son contenu en toute simplicité.</p>
      </div>
    </div>

    {{--
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
        <div class="ln"><span class="no">1</span><span class="code"><span class="tag">@extends</span>(<span class="str">'layouts.app'</span>)</span></div>
        <div class="ln"><span class="no">2</span><span class="code"></span></div>
        <div class="ln"><span class="no">3</span><span class="code"><span class="tag">@section</span>(<span class="str">'content'</span>)</span></div>
        <div class="ln"><span class="no">4</span><span class="code"></span></div>
        <div class="ln"><span class="no">5</span><span class="code">&lt;<span class="tag">section</span> <span class="attr">class</span>=<span class="str">"immat-form py-5"</span>&gt;</span></div>
        <div class="ln"><span class="no">6</span><span class="code">  &lt;<span class="tag">h1</span> <span class="attr">class</span>=<span class="str">"immat-title"</span>&gt;Demande de permis&lt;/<span class="tag">h1</span>&gt;</span></div>
        <div class="ln"><span class="no">7</span><span class="code"></span></div>
        <div class="ln"><span class="no">8</span><span class="code">  &lt;<span class="tag">form</span> <span class="attr">method</span>=<span class="str">"POST"</span> <span class="attr">action</span>=<span class="str">"{{ route('permis.store') }}"</span>&gt;</span></div>
        <div class="ln"><span class="no">9</span><span class="code">    <span class="php">@csrf</span></span></div>
        <div class="ln"><span class="no">10</span><span class="code">    &lt;<span class="tag">input</span> <span class="attr">name</span>=<span class="str">"nom_demandeur"</span> <span class="attr">class</span>=<span class="str">"form-control"</span>&gt;</span></div>
        <div class="ln"><span class="no">11</span><span class="code">  &lt;/<span class="tag">form</span>&gt;</span></div>
        <div class="ln"><span class="no">12</span><span class="code">&lt;/<span class="tag">section</span>&gt;</span></div>
        <div class="ln"><span class="no">13</span><span class="code"></span></div>
        <div class="ln"><span class="no">14</span><span class="code"><span class="tag">@endsection</span></span></div>
        </div>
        <div class="status">
          <span>Blade · UTF-8</span>
          <span>Ligne 10, Col 22</span>
          <span class="ok">● Sauvegarde automatique activée</span>
        </div>
      </div>
    </div>
    --}}

</div>

@endsection