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
    .mdg-sub{font-size:13px;color:var(--ink-soft);margin:0 0 22px;}

    .mdg-alert{background:#E5F5EC;border-left:4px solid #1F7A4D;color:#1F7A4D;padding:12px 18px;
        border-radius:6px;margin-bottom:22px;font-size:13.5px;}
    .mdg-alert.warn{background:#FBF3DD;border-left-color:var(--gold);color:#8A6D14;}

    /* Onglets — fond blanc forcé, bien visibles peu importe le layout parent */
    .tabs{
        display:flex;flex-wrap:wrap;gap:8px;margin-bottom:28px;
        background:#fff !important;
        padding:16px;
        border-radius:10px;
        border:1.5px solid var(--line);
    }
    .tab-btn{background:#fff;border:1.5px solid var(--line);color:var(--ink-soft);
        padding:9px 16px;border-radius:8px;font-size:12.5px;font-weight:700;cursor:pointer;transition:.15s ease;}
    .tab-btn:hover{border-color:var(--navy);color:var(--navy);}
    .tab-btn.active{background:var(--navy);color:#fff;border-color:var(--navy);}
    .tab-panel{display:none;}
    .tab-panel.active{display:block;}

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
    .mdg-field input[type=file],
    .mdg-field textarea{
        width:100%;border:1.5px solid var(--line);border-radius:9px;background:#fff;
        padding:11px 13px;font-size:14px;font-family:inherit;color:var(--ink);
        transition:.15s ease;box-sizing:border-box;
    }
    .mdg-field textarea{min-height:90px;resize:vertical;line-height:1.6;}
    .mdg-field input[type=text]:focus,
    .mdg-field textarea:focus{outline:none;border-color:var(--navy);box-shadow:0 0 0 3px rgba(11,35,64,.08);}
    .mdg-row2{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
    .mdg-hint{font-size:11px;color:var(--ink-soft);margin-top:6px;}
    .mdg-current{font-size:11.5px;color:var(--green);margin-top:6px;}
    .mdg-current a{color:var(--green);font-weight:600;}

    .btn-remove-card{position:absolute;top:20px;right:22px;background:#FBEAEA;color:#C0392B;
        border:none;border-radius:7px;padding:7px 13px;cursor:pointer;font-size:12px;font-weight:700;
        transition:.15s ease;}
    .btn-remove-card:hover{background:#F5D5D5;}

    .btn-add-card{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:8px;
        padding:11px 20px;cursor:pointer;font-size:13px;font-weight:700;margin-bottom:10px;transition:.15s ease;width:100%;}
    .btn-add-card:hover{background:var(--gold-soft);}

    .mdg-actions{display:flex;justify-content:flex-end;gap:12px;margin-top:30px;}
    .mdg-btn{border:none;border-radius:6px;padding:11px 24px;font-weight:700;cursor:pointer;
        font-size:13px;letter-spacing:.02em;transition:.15s ease;}
    .mdg-btn-save{background:linear-gradient(135deg,var(--gold),#DFAF3C);color:#fff;
        box-shadow:0 4px 12px rgba(201,162,39,.35);}
    .mdg-btn-save:hover{box-shadow:0 5px 16px rgba(201,162,39,.5);transform:translateY(-1px);}

    /* Tableaux statistiques */
    .table-editor{width:100%;border-collapse:collapse;margin-top:12px;}
    .table-editor th{background:var(--navy);color:var(--gold);padding:8px;font-size:12px;text-align:left;border-radius:4px 4px 0 0;}
    .table-editor td{padding:6px;border-bottom:1px solid var(--line);}
    .table-editor input{width:100%;border:1.5px solid var(--line);border-radius:6px;padding:6px 8px;font-size:13px;}
    .table-editor input.annee-input{background:var(--gold-soft);font-weight:700;}
    .table-editor tr.total-row input{background:#EEF3FA;font-weight:700;}
    .row-remove-btn{background:#FBEAEA;color:#C0392B;border:none;border-radius:5px;padding:5px 8px;font-size:11px;cursor:pointer;}
    .table-add-row{background:transparent;color:var(--navy);border:1.5px dashed var(--navy);border-radius:6px;
        padding:8px 16px;font-size:12px;font-weight:700;cursor:pointer;margin-top:10px;}
    .table-remove-btn{background:#FBEAEA;color:#C0392B;border:none;border-radius:7px;
        padding:7px 13px;font-size:12px;font-weight:700;cursor:pointer;float:right;}

    @media (max-width: 640px){
        .mdg-row2{grid-template-columns:1fr;}
    }
</style>

<div class="mdg-wrap">
    <div class="mdg-crumb">Connaître la DGAM</div>
    <h1 class="mdg-title">Nos Activités</h1>
    <p class="mdg-sub">Choisis une section ci-dessous, puis modifie son contenu.</p>

    @if(session('success'))
        <div class="mdg-alert">{{ session('success') }}</div>
    @endif

    <div class="tabs">
        @foreach($sections as $key => $s)
            <button type="button" class="tab-btn @if($loop->first) active @endif" onclick="switchTab('{{ $key }}', event)">{{ $s['label'] }}</button>
        @endforeach
    </div>

    @foreach($sections as $key => $s)
        <div id="tab-{{ $key }}" class="tab-panel @if($loop->first) active @endif">

            @if(!$s['ok'])
                <div class="mdg-alert warn">⚠️ Le fichier n'a pas pu être détecté (chemin à corriger côté contrôleur, ou fichier manquant).</div>
            @endif

            <form method="POST" action="{{ route('activites-nos.update', $key) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="main_type" value="{{ $s['main_type'] }}">

                {{-- ===== ÉTIQUETTE + TITRE ===== --}}
                <div class="card-block">
                    <div class="card-block-label">
                        <span class="card-num">1</span>
                        <span class="txt">Étiquette & Titre</span>
                    </div>

                    <div class="mdg-row2">
                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-orange"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 2h5v5L6 15 2 11z"/><circle cx="11" cy="5" r="1"/></svg></span>
                                Étiquette (badge)
                            </div>
                            <input type="text" name="badge" value="{{ $s['badge'] }}">
                        </div>
                        <div class="mdg-field">
                            <div class="mdg-label">
                                <span class="mdg-icon i-navy"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h10M3 8h10M3 12h6"/></svg></span>
                                Titre
                            </div>
                            <input type="text" name="titre" value="{{ $s['titre'] }}">
                        </div>
                    </div>
                </div>

                {{-- ===== PHOTO ===== --}}
                <div class="card-block">
                    <div class="card-block-label">
                        <span class="card-num">2</span>
                        <span class="txt">Photo</span>
                    </div>

                    <div class="mdg-field">
                        <div class="mdg-label">
                            <span class="mdg-icon i-blue"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="12" height="10" rx="1.5"/><circle cx="6" cy="7" r="1.3"/><path d="M14 11l-3.5-3.5L6 12"/></svg></span>
                            Image
                        </div>
                        @if($s['image'])
                            <div class="mdg-current" style="margin-bottom:8px;">
                                <img src="{{ asset($s['image']) }}" style="width:64px;height:64px;object-fit:cover;border-radius:8px;vertical-align:middle;margin-right:8px;">
                                Photo actuelle
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*">
                        <input type="hidden" name="image_actuelle" value="{{ $s['image'] }}">
                    </div>
                </div>

                {{-- ===== CONTENU PRINCIPAL ===== --}}
                <div class="card-block">
                    <div class="card-block-label">
                        <span class="card-num">3</span>
                        <span class="txt">@if($s['main_type'] === 'liste') Liste des points @else Texte principal @endif</span>
                    </div>

                    @if($s['main_type'] === 'liste')
                        <div id="liste-{{ $key }}">
                            @foreach($s['liste'] as $i => $item)
                                <div class="mdg-field" style="display:flex;gap:10px;align-items:flex-start;">
                                    <input type="text" name="liste[]" value="{{ $item }}" style="flex:1;">
                                    <button type="button" class="btn-remove-card" style="position:static;flex-shrink:0;" onclick="this.parentElement.remove()">✕</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-add-card" onclick="addListeItem('{{ $key }}')">+ Ajouter un point</button>
                    @else
                        <div class="mdg-field">
                            <textarea name="paragraphe">{{ $s['paragraphe'] }}</textarea>
                        </div>
                    @endif
                </div>

                {{-- ===== TEXTE DÉTAILLÉ ===== --}}
                <div class="card-block">
                    <div class="card-block-label">
                        <span class="card-num">4</span>
                        <span class="txt">Texte détaillé ("Lire la suite")</span>
                    </div>
                    <div class="mdg-field">
                        <div class="mdg-label">
                            <span class="mdg-icon i-green"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h9v10H2z"/><path d="M11 5h3v8h-2"/><path d="M4 6h5M4 8h5M4 10h3"/></svg></span>
                            Contenu détaillé
                        </div>
                        <textarea name="extra">{{ $s['extra'] }}</textarea>
                    </div>
                </div>

                {{-- ===== TABLEAUX ===== --}}
                <div class="card-block">
                    <div class="card-block-label">
                        <span class="card-num">5</span>
                        <span class="txt">Tableaux statistiques (optionnels)</span>
                    </div>

                    <div id="tables-{{ $key }}">
                        @foreach($s['tables'] as $ti => $table)
                            <div class="table-block" style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px dashed var(--line);">
                                <button type="button" class="table-remove-btn" onclick="this.closest('.table-block').remove()">✕ Retirer ce tableau</button>
                                <div class="mdg-field">
                                    <div class="mdg-label">
                                        <span class="mdg-icon i-gold"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="12" height="12" rx="1.5"/><path d="M2 6h12M6 6v8"/></svg></span>
                                        Titre du tableau
                                    </div>
                                    <input type="text" name="table_titre[]" value="{{ $table['titre'] }}">
                                </div>

                                <table class="table-editor">
                                    <thead>
                                        <tr>
                                            <th>Cause</th>
                                            <th><input type="text" class="annee-input" name="table_annees[{{ $ti }}][]" value="{{ $table['annees'][0] }}"></th>
                                            <th><input type="text" class="annee-input" name="table_annees[{{ $ti }}][]" value="{{ $table['annees'][1] }}"></th>
                                            <th><input type="text" class="annee-input" name="table_annees[{{ $ti }}][]" value="{{ $table['annees'][2] }}"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($table['rows'] as $row)
                                            <tr>
                                                <td><input type="text" name="table_cause[{{ $ti }}][]" value="{{ $row['cause'] }}"></td>
                                                <td><input type="text" name="table_v1[{{ $ti }}][]" value="{{ $row['v1'] }}"></td>
                                                <td><input type="text" name="table_v2[{{ $ti }}][]" value="{{ $row['v2'] }}"></td>
                                                <td><input type="text" name="table_v3[{{ $ti }}][]" value="{{ $row['v3'] }}"></td>
                                                <td><button type="button" class="row-remove-btn" onclick="this.closest('tr').remove()">✕</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td><strong>Total</strong></td>
                                            <td><input type="text" name="table_total[{{ $ti }}][]" value="{{ $table['total'][0] }}"></td>
                                            <td><input type="text" name="table_total[{{ $ti }}][]" value="{{ $table['total'][1] }}"></td>
                                            <td><input type="text" name="table_total[{{ $ti }}][]" value="{{ $table['total'][2] }}"></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <button type="button" class="table-add-row" onclick="addTableRow(this, {{ $ti }})">＋ Ajouter une ligne</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-add-card" onclick="addNewTable('{{ $key }}')">+ Ajouter un nouveau tableau</button>
                </div>

                <div class="mdg-actions">
                    <button type="submit" class="mdg-btn mdg-btn-save">Enregistrer {{ $s['label'] }}</button>
                </div>
            </form>
        </div>
    @endforeach
</div>

<script>
let newTableIndex = 1000;

function switchTab(key, event) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + key).classList.add('active');
    event.target.classList.add('active');
}

function addListeItem(key) {
    const list = document.getElementById('liste-' + key);
    const div = document.createElement('div');
    div.className = 'mdg-field';
    div.style = 'display:flex;gap:10px;align-items:flex-start;';
    div.innerHTML = `
        <input type="text" name="liste[]" placeholder="Nouveau point" style="flex:1;">
        <button type="button" class="btn-remove-card" style="position:static;flex-shrink:0;" onclick="this.parentElement.remove()">✕</button>
    `;
    list.appendChild(div);
}

function addTableRow(btn, tableIndex) {
    const tbody = btn.closest('.table-block').querySelector('tbody');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><input type="text" name="table_cause[${tableIndex}][]" placeholder="Cause"></td>
        <td><input type="text" name="table_v1[${tableIndex}][]" placeholder="0"></td>
        <td><input type="text" name="table_v2[${tableIndex}][]" placeholder="0"></td>
        <td><input type="text" name="table_v3[${tableIndex}][]" placeholder="0"></td>
        <td><button type="button" class="row-remove-btn" onclick="this.closest('tr').remove()">✕</button></td>
    `;
    tbody.appendChild(tr);
}

function addNewTable(key) {
    const container = document.getElementById('tables-' + key);
    const idx = newTableIndex++;
    const div = document.createElement('div');
    div.className = 'table-block';
    div.style = 'margin-bottom:20px;padding-bottom:16px;border-bottom:1px dashed var(--line);';
    div.innerHTML = `
        <button type="button" class="table-remove-btn" onclick="this.closest('.table-block').remove()">✕ Retirer ce tableau</button>
        <div class="mdg-field">
            <div class="mdg-label">Titre du tableau</div>
            <input type="text" name="table_titre[]" placeholder="Ex: Nouvelles statistiques">
        </div>
        <table class="table-editor">
            <thead>
                <tr>
                    <th>Cause</th>
                    <th><input type="text" class="annee-input" name="table_annees[${idx}][]" placeholder="Année"></th>
                    <th><input type="text" class="annee-input" name="table_annees[${idx}][]" placeholder="Année"></th>
                    <th><input type="text" class="annee-input" name="table_annees[${idx}][]" placeholder="Année"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr class="total-row">
                    <td><strong>Total</strong></td>
                    <td><input type="text" name="table_total[${idx}][]"></td>
                    <td><input type="text" name="table_total[${idx}][]"></td>
                    <td><input type="text" name="table_total[${idx}][]"></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="table-add-row" onclick="addTableRow(this, ${idx})">＋ Ajouter une ligne</button>
    `;
    container.appendChild(div);
}
</script>

@endsection