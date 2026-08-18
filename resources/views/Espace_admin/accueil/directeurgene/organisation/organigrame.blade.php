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

    .mdg-wrap{max-width:900px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);
        margin:0 0 8px;letter-spacing:-.01em;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 26px;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    .mdg-section-title{display:flex;align-items:center;gap:10px;font-size:17px;font-weight:700;
        color:var(--navy);margin:38px 0 18px;padding-bottom:10px;border-bottom:2px solid var(--gold);}
    .mdg-section-title:first-of-type{margin-top:6px;}

    .mdg-field{margin-bottom:22px;min-width:0;}
    .mdg-label{display:flex;align-items:center;gap:9px;font-size:12.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;margin-bottom:9px;}
    .mdg-icon{width:24px;height:24px;border-radius:7px;flex-shrink:0;display:flex;align-items:center;
        justify-content:center;color:#fff;}
    .mdg-icon svg{width:13px;height:13px;}
    .mdg-icon.i-blue{background:var(--blue);}
    .mdg-icon.i-orange{background:var(--orange);}
    .mdg-icon.i-navy{background:var(--navy);}

    .mdg-field input[type=text]{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:12px 14px;font-size:14.5px;font-family:inherit;color:var(--ink);
        transition:.15s ease;box-sizing:border-box;
    }
    .mdg-field input[type=text]:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}

    /* Cartes répétables */
    .card-block{background:#FAF9F5;border:1.5px solid var(--line);border-radius:10px;
        padding:18px 20px;margin-bottom:16px;position:relative;}
    .card-block-label{display:flex;align-items:center;gap:8px;font-weight:700;color:var(--navy);
        font-size:12.5px;margin-bottom:14px;text-transform:uppercase;letter-spacing:.05em;}
    .card-num{width:22px;height:22px;border-radius:50%;background:var(--navy);color:#fff;
        display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0;}
    .field{margin-bottom:12px;}
    .field:last-child{margin-bottom:0;}
    .field label{display:block;font-weight:700;color:var(--ink-soft);margin-bottom:6px;font-size:11.5px;
        text-transform:uppercase;letter-spacing:.04em;}
    .field input[type=text]{
        width:100%;border:1.5px solid var(--line);border-radius:8px;padding:10px 12px;
        font-size:13.5px;font-family:inherit;box-sizing:border-box;background:#fff;transition:.15s ease;
    }
    .field input:focus{outline:none;border-color:var(--navy);}
    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}

    .btn-remove-card{position:absolute;top:14px;right:16px;background:#FBEAEA;color:#C0392B;
        border:none;border-radius:7px;padding:7px 13px;cursor:pointer;font-size:12px;font-weight:700;
        transition:.15s ease;}
    .btn-remove-card:hover{background:#F5D5D5;}

    .btn-add-card{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:8px;
        padding:10px 18px;cursor:pointer;font-size:12.5px;font-weight:700;margin-bottom:10px;transition:.15s ease;}
    .btn-add-card:hover{background:var(--gold-soft);}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:34px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;
        font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}

    @media (max-width: 640px){
        .field-row{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Organisation</div>
    <h1 class="mdg-title">Organigramme</h1>
    <p class="mdg-sub">Modifie les noms des directions/services, ou gère la liste des documents PDF.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    @if(!$detection_ok)
        <div class="mdg-alert warn">⚠️ La structure n'a pas pu être détectée automatiquement. Vérifie le contenu avant d'enregistrer.</div>
    @endif

    <form method="POST" action="{{ route('organigramme.update') }}">
        @csrf

        {{-- ===== DIRECTEUR GÉNÉRAL ===== --}}
        <div class="mdg-section-title">Direction Générale</div>
        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="1.5" width="4" height="3"/><rect x="1" y="10.5" width="4" height="3"/><rect x="11" y="10.5" width="4" height="3"/><path d="M8 4.5v3.5M8 8h-5v2.5M8 8h5v2.5"/></svg></span>
                Titre de la boîte principale
            </div>
            <input type="text" name="directeur_titre" value="{{ old('directeur_titre', $directeur_titre) }}">
        </div>

        {{-- ===== DÉPARTEMENTS ===== --}}
        <div class="mdg-section-title">Directions & Services</div>
        @foreach($departements as $i => $dept)
            <div class="card-block">
                <div class="card-block-label"><span class="card-num">{{ $i + 1 }}</span> Direction {{ $i + 1 }}</div>
                <div class="field">
                    <label>Nom de la direction</label>
                    <input type="text" name="dept_nom[]" value="{{ $dept['nom'] }}">
                </div>
                <div class="field-row">
                    <div class="field">
                        <label>Service 1</label>
                        <input type="text" name="dept_service1[]" value="{{ $dept['service1'] }}">
                    </div>
                    <div class="field">
                        <label>Service 2</label>
                        <input type="text" name="dept_service2[]" value="{{ $dept['service2'] }}">
                    </div>
                </div>
            </div>
        @endforeach

        {{-- ===== DOCUMENTS PDF ===== --}}
        <div class="mdg-section-title">Documents PDF</div>
        <div id="pdf-list">
            @foreach($pdfs as $i => $pdf)
                <div class="card-block">
                    <div class="card-block-label"><span class="card-num">{{ $i + 1 }}</span> Document {{ $i + 1 }}</div>
                    <div class="field">
                        <label>Titre du document</label>
                        <input type="text" name="pdf_titre[]" value="{{ $pdf['titre'] }}">
                    </div>
                    <div class="field-row">
                        <div class="field">
                            <label>Lien du fichier</label>
                            <input type="text" name="pdf_lien[]" value="{{ $pdf['lien'] }}" placeholder="ex: /storage/documents/decret.pdf">
                        </div>
                        <div class="field">
                            <label>Texte du bouton</label>
                            <input type="text" name="pdf_bouton[]" value="{{ $pdf['bouton'] }}" placeholder="Voir le PDF">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn-add-card" onclick="addPdf()">+ Ajouter un document PDF</button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
function addPdf() {
    const list = document.getElementById('pdf-list');
    const num = list.querySelectorAll('.card-block').length + 1;

    const wrap = document.createElement('div');
    wrap.className = 'card-block';
    wrap.innerHTML = `
        <div class="card-block-label"><span class="card-num">${num}</span> Document ${num} (nouveau)</div>
        <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Annuler l'ajout</button>
        <div class="field">
            <label>Titre du document</label>
            <input type="text" name="pdf_titre[]">
        </div>
        <div class="field-row">
            <div class="field">
                <label>Lien du fichier</label>
                <input type="text" name="pdf_lien[]" placeholder="ex: /storage/documents/decret.pdf">
            </div>
            <div class="field">
                <label>Texte du bouton</label>
                <input type="text" name="pdf_bouton[]" placeholder="Voir le PDF">
            </div>
        </div>
    `;
    list.appendChild(wrap);
}
</script>

@endsection