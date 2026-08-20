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

    .mdg-wrap{max-width:1000px;margin:0 auto;padding:36px 24px 60px;}

    .mdg-crumb{font-size:11px;text-transform:uppercase;letter-spacing:.12em;color:var(--orange);
        font-weight:700;display:flex;align-items:center;gap:6px;margin-bottom:6px;}
    .mdg-crumb::before{content:"";width:14px;height:2px;background:var(--orange);border-radius:2px;}

    .mdg-title{font-family:'IBM Plex Sans',sans-serif;font-size:25px;font-weight:700;color:var(--navy);
        margin:0 0 26px;letter-spacing:-.01em;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}

    .mdg-layout{display:block;}
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:22px;}

    .mdg-field{margin-bottom:22px;min-width:0;}
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

    .mdg-field input[type=text],
    .mdg-field input[type=date],
    .mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:12px 14px;font-size:14.5px;font-family:inherit;color:var(--ink);
        transition:.15s ease;resize:vertical;box-sizing:border-box;
    }
    .mdg-field textarea{min-height:90px;line-height:1.6;}
    .mdg-field input[type=text]:focus,
    .mdg-field textarea:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}

    .mdg-error{color:#C0392B;font-size:11.5px;margin-top:5px;}

    /* Colonne photo */
    .mdg-photo-col{text-align:center;}
    .mdg-photo-preview{width:100%;aspect-ratio:1/1;object-fit:cover;border-radius:10px;
        border:2px solid var(--gold);box-shadow:0 6px 18px rgba(11,35,64,.15);margin-bottom:14px;}
    .mdg-file-btn{display:block;text-align:center;border:1.5px dashed var(--navy);border-radius:8px;
        padding:10px 12px;font-size:12.5px;color:var(--navy);cursor:pointer;font-weight:600;
        background:transparent;transition:.15s ease;}
    .mdg-file-btn:hover{background:var(--gold-soft);}
    .mdg-file-input{display:none;}
    .mdg-file-name{font-size:11px;color:var(--ink-soft);margin-top:6px;}

    /* Sections Parcours / Formation */
    .mdg-section-title{display:flex;align-items:center;gap:10px;font-size:16px;font-weight:700;
        color:var(--navy);margin:40px 0 18px;padding-bottom:10px;border-bottom:2px solid var(--gold);}

    .repeat-row{display:flex;gap:16px;align-items:flex-start;margin-bottom:14px;
        background:#FAF9F5;padding:16px;border-radius:10px;border:1.5px solid var(--line);}
    .repeat-num{width:26px;height:26px;border-radius:50%;background:var(--navy);color:#fff;
        display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;
        flex-shrink:0;margin-top:2px;}
    .repeat-fields{flex:1;display:grid;grid-template-columns:150px 1fr;gap:12px;min-width:0;}
    .repeat-row input,.repeat-row textarea{width:100%;border:1.5px solid var(--line);border-radius:7px;
        padding:9px 11px;font-size:13px;font-family:inherit;box-sizing:border-box;background:#fff;
        transition:.15s ease;}
    .repeat-row input:focus,.repeat-row textarea:focus{outline:none;border-color:var(--navy);}
    .repeat-row textarea{min-height:52px;resize:vertical;}

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

    @media (max-width: 720px){
        .mdg-layout{grid-template-columns:1fr;}
        .mdg-photo-col{order:-1;max-width:220px;margin:0 auto 10px;}
        .mdg-row2{grid-template-columns:1fr;}
        .repeat-fields{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM &nbsp;›&nbsp; Directeur Général</div>
    <h1 class="mdg-title">Biographie du DG</h1>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('biodg.update') }}" enctype="multipart/form-data" id="bioForm">
        @csrf

                <div class="mdg-layout">
            <div>
                <div class="mdg-row2">
                    <div class="mdg-field">
                        <div class="mdg-label">
                            <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.2"/><path d="M2.5 6.5h11M5 3v3.5M11 3v3.5"/></svg></span>
                            Date de naissance
                        </div>
                        <input type="date" name="date_naissance" value="{{ old('date_naissance', $date_naissance) }}">
                        @error('date_naissance') <div class="mdg-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="mdg-field">
                        <div class="mdg-label">
                            <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1.5s4 3.5 4 7a4 4 0 01-8 0c0-3.5 4-7 4-7z"/></svg></span>
                            Lieu de naissance
                        </div>
                        <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $lieu_naissance) }}" placeholder="Ex: Assingoukan (Bouaké)">
                        @error('lieu_naissance') <div class="mdg-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mdg-row2">
                    <div class="mdg-field">
                        <div class="mdg-label">
                            <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M8 1.5l5 2v4c0 3.6-2.2 5.9-5 6.7-2.8-.8-5-3.1-5-6.7v-4z"/></svg></span>
                            Corps
                        </div>
                        <input type="text" name="corps" value="{{ old('corps', $corps) }}">
                        @error('corps') <div class="mdg-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="mdg-field">
                        <div class="mdg-label">
                            <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 8l6-4.5L14 8l-6 4.5z"/><path d="M4.5 9.3V13c0 .6 1.6 1.2 3.5 1.2s3.5-.6 3.5-1.2V9.3"/></svg></span>
                            Grade / Classe
                        </div>
                        <input type="text" name="grade" value="{{ old('grade', $grade) }}">
                        @error('grade') <div class="mdg-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mdg-field">
                    <div class="mdg-label">
                        <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h12v7H6l-3 3v-3H2z"/></svg></span>
                        Fonction actuelle
                    </div>
                    <textarea name="fonction" style="min-height:70px;">{{ old('fonction', $fonction) }}</textarea>
                    @error('fonction') <div class="mdg-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        {{-- PARCOURS PROFESSIONNEL --}}
        <div class="mdg-section-title">Parcours Professionnel</div>
        <div id="timeline-list">
            @foreach($timeline as $i => $item)
                <div class="repeat-row">
                    <div class="repeat-num">{{ $i + 1 }}</div>
                    <div class="repeat-fields">
                        <input type="text" name="timeline_date[]" value="{{ $item['date'] }}" placeholder="Ex: 2012 – 2020">
                        <textarea name="timeline_texte[]" placeholder="Poste occupé">{{ $item['texte'] }}</textarea>
                    </div>
                    <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Retirer</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn-add" onclick="addTimelineRow()">+ Ajouter une étape</button>

        {{-- FORMATION --}}
        <div class="mdg-section-title">Formation</div>
        <div id="formation-list">
            @foreach($formation as $i => $item)
                <div class="repeat-row">
                    <div class="repeat-num">{{ $i + 1 }}</div>
                    <div class="repeat-fields">
                        <input type="text" name="formation_annee[]" value="{{ $item['annee'] }}" placeholder="Ex: 1999">
                        <textarea name="formation_texte[]" placeholder="Diplôme obtenu">{{ $item['texte'] }}</textarea>
                    </div>
                    <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Retirer</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn-add" onclick="addFormationRow()">+ Ajouter une formation</button>

        <div class="mdg-actions">
            <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer les modifications</button>
        </div>
    </form>
</div>

<script>
function addTimelineRow() {
    const list = document.getElementById('timeline-list');
    const num = list.children.length + 1;
    const wrap = document.createElement('div');
    wrap.className = 'repeat-row';
    wrap.innerHTML = `
        <div class="repeat-num">${num}</div>
        <div class="repeat-fields">
            <input type="text" name="timeline_date[]" placeholder="Ex: 2012 – 2020">
            <textarea name="timeline_texte[]" placeholder="Poste occupé"></textarea>
        </div>
        <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Retirer</button>
    `;
    list.appendChild(wrap);
}

function addFormationRow() {
    const list = document.getElementById('formation-list');
    const num = list.children.length + 1;
    const wrap = document.createElement('div');
    wrap.className = 'repeat-row';
    wrap.innerHTML = `
        <div class="repeat-num">${num}</div>
        <div class="repeat-fields">
            <input type="text" name="formation_annee[]" placeholder="Ex: 1999">
            <textarea name="formation_texte[]" placeholder="Diplôme obtenu"></textarea>
        </div>
        <button type="button" class="btn-remove" onclick="this.parentElement.remove()">Retirer</button>
    `;
    list.appendChild(wrap);
}
</script>

@endsection