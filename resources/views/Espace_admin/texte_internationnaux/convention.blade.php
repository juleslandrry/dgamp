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
    .mdg-field input[type=file]{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);
        transition:.15s ease;box-sizing:border-box;
    }
    .mdg-field input[type=text]:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .mdg-row2{display:grid;grid-template-columns:2fr 1fr;gap:18px;}
    .mdg-row2b{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
    .mdg-hint{font-size:11px;color:var(--ink-soft);margin-top:6px;}

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
        .mdg-row2,.mdg-row2b{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Textes Internationaux</div>
    <h1 class="mdg-title">Convention DGAM</h1>
    <p class="mdg-sub">Gère la liste des conventions internationales affichées sur le site public.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    @if(!$detection_ok)
        <div class="mdg-alert warn">⚠️ Les conventions n'ont pas pu être détectées automatiquement. Vérifie le contenu avant d'enregistrer.</div>
    @endif

    <form method="POST" action="{{ route('conventions.update') }}" enctype="multipart/form-data">
        @csrf

        <div id="conventions-list">
            @foreach($conventions as $i => $conv)
                <div class="acc-item card-block">
                    <div class="card-block-label">
                        <span class="card-num">{{ $i + 1 }}</span>
                        <span class="txt">Convention {{ $i + 1 }}</span>
                    </div>
                    @if($i > 0)
                        <button type="button" class="btn-remove-card" onclick="this.closest('.acc-item').remove()">Retirer</button>
                    @endif

                    <div class="mdg-row2">
                        <div class="mdg-field">
                            <div class="mdg-label">Titre du document</div>
                            <input type="text" name="titre[]" value="{{ $conv->titre }}" placeholder="Ex: MARPOL 78">
                        </div>
                        
                    </div>

                    <div class="mdg-field">
                        <div class="mdg-label">Description</div>
                        <input type="text" name="description[]" value="{{ $conv->description }}" placeholder="Description">
                    </div>

                    <div class="mdg-field">
                        <div class="mdg-label">Fichier PDF</div>
                        <input type="file" name="fichier[]" accept="application/pdf">
                        <div class="mdg-hint">Laisse vide pour garder le fichier actuel</div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn-add-card" onclick="addConvention()">+ Ajouter une convention</button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
function addConvention() {
    const list = document.getElementById('conventions-list');
    const num = list.querySelectorAll('.acc-item').length + 1;

    const wrap = document.createElement('div');
    wrap.className = 'acc-item card-block';
    wrap.innerHTML = `
        <div class="card-block-label">
            <span class="card-num">${num}</span>
            <span class="txt">Convention ${num} (nouvelle)</span>
        </div>
        <button type="button" class="btn-remove-card" onclick="this.closest('.acc-item').remove()">Annuler l'ajout</button>

        <div class="mdg-row2">
            <div class="mdg-field">
                <div class="mdg-label">
                    <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>
                    Titre du document
                </div>
                <input type="text" name="titre[]" placeholder="Ex: Nouvelle convention">
            </div>
           
        </div>

        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                Description
            </div>
            <input type="text" name="description[]" placeholder="Description du document">
        </div>

        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg></span>
                Fichier PDF
            </div>
            <input type="file" name="fichier[]" accept="application/pdf">
            <input type="hidden" name="lien[]" value="">
        </div>
    `;
    list.appendChild(wrap);
}
</script>

@endsection