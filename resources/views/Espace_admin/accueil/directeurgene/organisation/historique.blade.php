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
        margin:0 0 26px;letter-spacing:-.01em;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}

    .mdg-field{margin-bottom:26px;min-width:0;}
    .mdg-label{display:flex;align-items:center;gap:9px;font-size:12.5px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.05em;margin-bottom:9px;}
    .mdg-icon{width:24px;height:24px;border-radius:7px;flex-shrink:0;display:flex;align-items:center;
        justify-content:center;color:#fff;}
    .mdg-icon svg{width:13px;height:13px;}
    .mdg-icon.i-blue{background:var(--blue);}
    .mdg-icon.i-orange{background:var(--orange);}
    .mdg-icon.i-green{background:var(--green);}
    .mdg-icon.i-gold{background:var(--gold);}
    .mdg-icon.i-navy{background:var(--navy);}

    .mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:12px 14px;font-size:14.5px;font-family:inherit;color:var(--ink);
        transition:.15s ease;resize:vertical;box-sizing:border-box;min-height:110px;line-height:1.7;
    }
    .mdg-field textarea:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}

    .mdg-error{color:#C0392B;font-size:11.5px;margin-top:5px;}

    .mdg-section-title{display:flex;align-items:center;gap:10px;font-size:16px;font-weight:700;
        color:var(--navy);margin:38px 0 18px;padding-bottom:10px;border-bottom:2px solid var(--gold);}

    .repeat-row{display:flex;gap:16px;align-items:flex-start;margin-bottom:14px;
        background:#FAF9F5;padding:16px;border-radius:10px;border:1.5px solid var(--line);}
    .repeat-num{width:26px;height:26px;border-radius:50%;background:var(--navy);color:#fff;
        display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;
        flex-shrink:0;margin-top:2px;}
    .repeat-fields{flex:1;display:grid;grid-template-columns:170px 1fr;gap:12px;min-width:0;}
    .repeat-row input,.repeat-row textarea{width:100%;border:1.5px solid var(--line);border-radius:7px;
        padding:9px 11px;font-size:13px;font-family:inherit;box-sizing:border-box;background:#fff;
        transition:.15s ease;}
    .repeat-row input:focus,.repeat-row textarea:focus{outline:none;border-color:var(--navy);}
    .repeat-row textarea{min-height:80px;resize:vertical;line-height:1.5;}
    .repeat-hint{font-size:11px;color:var(--ink-soft);margin-top:5px;}

    .btn-remove{background:#FBEAEA;color:#C0392B;border:none;border-radius:7px;
        padding:9px 13px;cursor:pointer;font-size:12px;font-weight:700;height:fit-content;
        flex-shrink:0;transition:.15s ease;}
    .btn-remove:hover{background:#F5D5D5;}

    .btn-add{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:8px;
        padding:10px 18px;cursor:pointer;font-size:12.5px;font-weight:700;margin-top:2px;
        transition:.15s ease;}
    .btn-add:hover{background:var(--gold-soft);}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:34px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;
        font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}

    @media (max-width: 640px){
        .repeat-fields{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Organisation</div>
    <h1 class="mdg-title">Historique</h1>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('historique.update') }}" id="histForm">
        @csrf

        <div class="mdg-field">
            <div class="mdg-label">
                <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>
                Texte d'introduction
            </div>
            <textarea name="intro">{{ old('intro', $intro) }}</textarea>
            @error('intro') <div class="mdg-error">{{ $message }}</div> @enderror
        </div>

        <div class="mdg-section-title">Chronologie</div>
        <div id="timeline-list">
            @foreach($timeline as $i => $item)
                <div class="repeat-row">
                    <div class="repeat-num">{{ $i + 1 }}</div>
                    <div class="repeat-fields">
                        <div>
                            <input type="text" name="annee[]" value="{{ $item['annee'] }}" placeholder="Ex: 1960 ou 4 septembre 2019">
                            <div class="repeat-hint">Année / date</div>
                        </div>
                        <div>
                            <textarea name="texte[]" placeholder="Description de l'événement">{{ $item['texte'] }}</textarea>
                            <div class="repeat-hint">Une ligne = un retour à la ligne affiché sur le site</div>
                        </div>
                    </div>
                    <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Retirer</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn-add" onclick="addRow()">+ Ajouter une étape</button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
    function addRow() {
        const list = document.getElementById('timeline-list');
        const num = list.children.length + 1;
        const wrap = document.createElement('div');
        wrap.className = 'repeat-row';
        wrap.innerHTML = `
            <div class="repeat-num">${num}</div>
            <div class="repeat-fields">
                <div>
                    <input type="text" name="annee[]" placeholder="Ex: 1960 ou 4 septembre 2019">
                    <div class="repeat-hint">Année / date</div>
                </div>
                <div>
                    <textarea name="texte[]" placeholder="Description de l'événement"></textarea>
                    <div class="repeat-hint">Une ligne = un retour à la ligne affiché sur le site</div>
                </div>
            </div>
            <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Retirer</button>
        `;
        list.appendChild(wrap);
    }
</script>

@endsection