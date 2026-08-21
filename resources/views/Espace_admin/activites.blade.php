@extends('Espace_admin.layout')
@section('content')

<!-- CDN CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<style>
    .admin-container { max-width: 1200px; margin: 0 auto; padding: 25px 15px; }
    .admin-card { background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 25px; }
    .nav-tabs-custom { display: flex; gap: 10px; border-bottom: 2px solid #e2e8f0; margin-bottom: 25px; list-style: none; padding: 0; }
    .nav-tabs-custom .nav-link { border: none; background: transparent; padding: 12px 20px; font-weight: 600; color: #64748b; border-bottom: 3px solid transparent; cursor: pointer; }
    .nav-tabs-custom .nav-link.active { color: #0B2340; border-bottom-color: #0B2340; }
    .form-label { font-weight: 600; color: #0B2340; margin-bottom: 8px; display: block; font-size: 14px; }
    .form-control-custom { width: 100%; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 14px; font-size: 14px; outline: none; box-sizing: border-box; }
    .btn-main { background: #0B2340; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-orange { background: #E8720C; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; }
    .btn-danger-sm { background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; }

    .ck-editor__editable_inline {
        min-height: 200px;
        border-radius: 0 0 8px 8px !important;
    }
    .ck-toolbar {
        border-radius: 8px 8px 0 0 !important;
        background: #f8fafc !important;
    }
</style>

<div class="admin-container">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #0B2340; font-weight: 700; margin: 0 0 5px 0;">Gestion des Activités</h2>
            <p style="color: #64748b; margin: 0; font-size: 14px;">Gérez la présentation et les réglementations associées.</p>
        </div>
        <button class="btn-main" onclick="toggleFormAjout()">
            <span id="btn-icon">+</span> <span id="btn-text">Nouvelle Activité</span>
        </button>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORMULAIRE DE CRÉATION D'ACTIVITÉ -->
    <div id="form-nouvelle-activite" class="admin-card" style="display: {{ $activites->isEmpty() ? 'block' : 'none' }}; border-left: 4px solid #0B2340;">
        <h4 style="color: #0B2340; margin-top: 0; margin-bottom: 20px;">Créer une nouvelle activité</h4>
        
        <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label class="form-label">Titre de l'activité</label>
                    <input type="text" name="titre" class="form-control-custom" placeholder="ex: SÉCURITÉ MARITIME" required>
                </div>
                <div>
                    <label class="form-label">Photo d'illustration</label>
                    <input type="file" name="image" class="form-control-custom">
                </div>
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                @if(!$activites->isEmpty())
                    <button type="button" class="btn-main" style="background: #cbd5e1; color: #334155;" onclick="toggleFormAjout()">Annuler</button>
                @endif
                <button type="submit" class="btn-main" style="background: #16a34a;">Enregistrer l'activité</button>
            </div>
        </form>
    </div>

    @if(!$activites->isEmpty())
        <!-- NAVIGATION PAR ONGLETS -->
        <ul class="nav-tabs-custom">
            @foreach($activites as $index => $act)
                <li>
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}" onclick="switchTab('tab-{{ $act->id }}', this)">
                        {{ $act->titre }}
                    </button>
                </li>
            @endforeach
        </ul>

        <!-- CONTENU DE CHAQUE ACTIVITÉ -->
        @foreach($activites as $index => $act)
            <div id="tab-{{ $act->id }}" class="tab-content-item" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                <div style="display: grid; grid-template-columns: 1fr 1.6fr; gap: 25px;">
                    
                    <!-- 1. PRÉSENTATION DE L'ACTIVITÉ -->
                    <div class="admin-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                            <h4 style="color: #0B2340; margin: 0;">1. Fiche Activité</h4>
                            <form action="{{ route('activites.destroy', $act) }}" method="POST" onsubmit="return confirm('Supprimer cette activité ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-sm">Supprimer</button>
                            </form>
                        </div>

                        <form action="{{ route('activites.update', $act) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div style="margin-bottom: 15px;">
                                <label class="form-label">Titre de la rubrique</label>
                                <input type="text" name="titre" class="form-control-custom" value="{{ $act->titre }}" required>
                            </div>

                            <div style="margin-bottom: 20px;">
                                <label class="form-label">Photo d'illustration</label>
                                @if($act->image)
                                    <div style="margin-bottom: 10px;">
                                        <img src="{{ asset('storage/' . $act->image) }}" style="width: 100%; height: 140px; object-fit: cover; border-radius: 8px;">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control-custom">
                            </div>

                            <button type="submit" class="btn-orange">Mettre à jour l'en-tête</button>
                        </form>
                    </div>

                    <!-- 2. RÉGLEMENTATIONS -->
                    <div>
                        <div class="admin-card">
                            <h4 style="color: #0B2340; margin-top: 0; margin-bottom: 15px;">2. Ajouter une Réglementation</h4>
                            
                            <form action="{{ route('activites.reglementations.store', $act) }}" method="POST">
                                @csrf
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 12px;">
                                    <div>
                                        <label class="form-label">Titre</label>
                                        <input type="text" name="titre" class="form-control-custom" placeholder="ex: LOI N° 61-349" required>
                                    </div>
                                    <div>
                                        <label class="form-label">Sous-titre (Facultatif)</label>
                                        <input type="text" name="sous_titre" class="form-control-custom" placeholder="ex: Code de la Marine Marchande">
                                    </div>
                                </div>

                                <div style="margin-bottom: 12px;">
                                    <label class="form-label">Texte d'introduction (Facultatif)</label>
                                    <textarea name="intro" class="form-control-custom" rows="2" placeholder="Brève introduction..."></textarea>
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <label class="form-label">Description & Contenu (Mise en forme libre)</label>
                                    <textarea name="description" id="editor-description" class="form-control-custom" rows="6" placeholder="Saisissez ou collez votre texte..."></textarea>
                                </div>

                                <button type="submit" class="btn-main" style="width: 100%; background: #16a34a; justify-content: center;">+ Ajouter cette réglementation</button>
                            </form>
                        </div>

                        <div class="admin-card">
                            <h4 style="color: #0B2340; margin-top: 0; margin-bottom: 15px;">Réglementations enregistrées ({{ $act->reglementations->count() }})</h4>
                            
                            @forelse($act->reglementations as $reg)
                                <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: flex-start;">
                                    <div>
                                        <h5 style="color: #0B2340; margin: 0 0 3px 0; font-size: 16px;">{{ $reg->titre }}</h5>
                                        @if($reg->sous_titre)
                                            <p style="color: #1E7FB8; font-weight: 600; font-size: 13px; margin: 0 0 6px 0;">{{ $reg->sous_titre }}</p>
                                        @endif
                                        @if($reg->intro)
                                            <p style="color: #64748b; font-size: 13px; margin: 0 0 6px 0; font-style: italic;">{{ $reg->intro }}</p>
                                        @endif
                                        <div style="color: #334155; font-size: 13px; margin: 0;">
                                            {!! Str::limit(strip_tags($reg->description), 120) !!}
                                        </div>
                                    </div>
                                    <form action="{{ route('reglementations.destroy', $reg) }}" method="POST" onsubmit="return confirm('Supprimer cette réglementation ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-sm" style="padding: 4px 8px;">✕</button>
                                    </form>
                                </div>
                            @empty
                                <p style="color: #94a3b8; font-size: 14px; text-align: center; margin: 15px 0;">Aucune réglementation enregistrée.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endif

</div>

<script>
function toggleFormAjout() {
    const form = document.getElementById('form-nouvelle-activite');
    const btnText = document.getElementById('btn-text');
    const btnIcon = document.getElementById('btn-icon');
    
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        btnText.innerText = 'Fermer';
        btnIcon.innerText = '✕';
    } else {
        form.style.display = 'none';
        btnText.innerText = 'Nouvelle Activité';
        btnIcon.innerText = '+';
    }
}

function switchTab(tabId, element) {
    document.querySelectorAll('.tab-content-item').forEach(item => item.style.display = 'none');
    document.querySelectorAll('.nav-tabs-custom .nav-link').forEach(btn => btn.classList.remove('active'));
    
    document.getElementById(tabId).style.display = 'block';
    element.classList.add('active');
}
</script>

<script>
// Initialisation de l'éditeur CKEditor sur le champ description
document.addEventListener("DOMContentLoaded", function () {
    const editorElement = document.querySelector('#editor-description');
    
    if (editorElement) {
        ClassicEditor
            .create(editorElement, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'blockQuote', 'insertTable', 'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    }
});
</script>

@endsection