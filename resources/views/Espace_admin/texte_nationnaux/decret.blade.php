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
    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}
    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);margin:0 0 8px;letter-spacing:-.01em;}
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 26px;}
    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;border-radius:6px;margin-bottom:22px;font-size:13.5px;}

    .card-block{background:#FAF9F5;border:1.5px solid var(--line);border-radius:12px;padding:22px 24px;margin-bottom:18px;position:relative;}
    .card-block-label{display:flex;align-items:center;gap:10px;margin-bottom:16px;}
    .card-num{width:26px;height:26px;border-radius:8px;background:var(--navy);color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;}
    .card-block-label span.txt{font-size:12.5px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.05em;}

    .mdg-field{margin-bottom:16px;min-width:0;}
    .mdg-field:last-child{margin-bottom:0;}
    .mdg-label{display:flex;align-items:center;gap:9px;font-size:11.5px;font-weight:700;color:var(--navy);text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px;}
    .mdg-icon{width:22px;height:22px;border-radius:7px;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#fff;}
    .mdg-icon svg{width:12px;height:12px;}
    .mdg-icon.i-blue{background:var(--blue);}
    .mdg-icon.i-green{background:var(--green);}
    .mdg-icon.i-gold{background:var(--gold);}

    .mdg-field input[type=text],
    .mdg-field textarea,
    .mdg-field input[type=file]{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);
        transition:.15s ease;box-sizing:border-box;
    }
    .mdg-field input[type=text]:focus,
    .mdg-field textarea:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .mdg-hint{font-size:11px;color:var(--ink-soft);margin-top:6px;}

    .btn-remove-card{position:absolute;top:20px;right:22px;background:#FBEAEA;color:#C0392B;border:none;border-radius:7px;padding:7px 13px;cursor:pointer;font-size:12px;font-weight:700;transition:.15s ease;}
    .btn-remove-card:hover{background:#F5D5D5;}

    .btn-add-card{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:8px;padding:11px 20px;cursor:pointer;font-size:13px;font-weight:700;margin-bottom:10px;transition:.15s ease;}
    .btn-add-card:hover{background:var(--gold-soft);}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:30px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Textes Nationaux</div>
    <h1 class="mdg-title">Décrets et Arrêtés</h1>
    <p class="mdg-sub">Gère les décrets, arrêtés officiels et leurs documents PDF associables.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="background:#FBEAEA; border-left:4px solid #C0392B; color:#C0392B; padding:12px 18px; border-radius:6px; margin-bottom:22px; font-size:13.5px;">
            <strong>Erreur lors de la sauvegarde :</strong>
            <ul style="margin: 5px 0 0 18px; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('decrets.update') }}" enctype="multipart/form-data">
        @csrf

        <div id="decrets-list">
           @forelse($decrets as $i => $decret)
            <div class="card-block">
                {{-- data_get fonctionne à la fois sur un Objet ($decret->id) et sur un Array ($decret['id']) --}}
                <input type="hidden" name="id[]" value="{{ data_get($decret, 'id') }}">
                
                <div class="card-block-label">
                    <span class="card-num">{{ $i + 1 }}</span>
                    <span class="txt">Document {{ $i + 1 }}</span>
                </div>
                
                <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Retirer</button>

                <div class="mdg-field">
                    <div class="mdg-label">
                        <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>
                        Titre du Document
                    </div>
                    <input type="text" name="titre[]" value="{{ data_get($decret, 'titre') }}" placeholder="Ex: Décret n°2021-804" required>
                </div>

                <div class="mdg-field">
                    <div class="mdg-label">
                        <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                        Description
                    </div>
                    <textarea name="description[]" rows="2" placeholder="Ex: Portant organisation du SEMTAM" required>{{ data_get($decret, 'description') }}</textarea>
                </div>

                <div class="mdg-field">
                    <div class="mdg-label">
                        <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg></span>
                        Remplacer le fichier PDF (optionnel)
                    </div>
                    <input type="file" name="fichier[]" accept="application/pdf">
                    @if(data_get($decret, 'fichier_path'))
                        <div class="mdg-hint">Fichier actuel : <a href="{{ Storage::url(data_get($decret, 'fichier_path')) }}" target="_blank">Consulter le PDF</a></div>
                    @endif
                </div>
            </div>
        @empty
        @endforelse
        </div>

        <button type="button" class="btn-add-card" onclick="addDecret()">+ Ajouter un décret / arrêté</button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
function addDecret() {
    const list = document.getElementById('decrets-list');
    const num = list.querySelectorAll('.card-block').length + 1;

    const wrap = document.createElement('div');
    wrap.className = 'card-block';
    wrap.innerHTML = `
        <input type="hidden" name="id[]" value="">
        <div class="card-block-label">
            <span class="card-num">${num}</span>
            <span class="txt">Document ${num} (nouveau)</span>
        </div>
        <button type="button" class="btn-remove-card" onclick="this.parentElement.remove()">Annuler l'ajout</button>

        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 2h5l3 3v9H4z"/><path d="M9 2v3h3"/></svg></span>
                Titre du Document
            </div>
            <input type="text" name="titre[]" placeholder="Ex: Arrêté n°334" required>
        </div>

        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                Description
            </div>
            <textarea name="description[]" rows="2" placeholder="Ex: Relatif à l'activité de recrutement maritime." required></textarea>
        </div>

        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 1v9M4.5 6.5L8 10l3.5-3.5M2 12v2h12v-2"/></svg></span>
                Fichier PDF
            </div>
            <input type="file" name="fichier[]" accept="application/pdf" required>
            <div class="mdg-hint">Un fichier PDF est requis lors de la création</div>
        </div>
    `;
    list.appendChild(wrap);
}
</script>

@endsection