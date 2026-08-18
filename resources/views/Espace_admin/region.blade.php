@extends('Espace_admin.layout')
@section('content')

<style>
    .acc-wrap{max-width:1100px;margin:30px auto;padding:0 15px;}
    .acc-header{display:flex;align-items:center;gap:16px;margin-bottom:28px;}
    .acc-header-icon{width:52px;height:52px;border-radius:14px;
        background:linear-gradient(135deg,#003366,#0a4d8c);
        display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;}
    .acc-header h2{margin:0;font-size:21px;font-weight:800;color:#003366;}
    .acc-header p{margin:2px 0 0;font-size:13px;color:#777;}

    .acc-alert{background:#eaf7ef;border-left:4px solid #1e7d4b;color:#1e6b3f;
        padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;}

    .acc-search-bar{margin-bottom:24px;}
    .acc-search-bar input[type=text]{width:100%;border:1px solid #e2e6ea;border-radius:10px;
        padding:12px 16px;font-size:14px;font-family:inherit;}
    .acc-search-bar input:focus{outline:none;border-color:#003366;}

    .acc-table-wrap{background:#fff;border:1px solid #e8e8ec;border-radius:14px;overflow:hidden;
        box-shadow:0 2px 10px rgba(0,0,0,.04);}
    table.acc-table{width:100%;border-collapse:collapse;}
    table.acc-table th{background:#003366;color:#d4af37;padding:12px 16px;font-size:12px;
        text-transform:uppercase;letter-spacing:.5px;text-align:left;}
    table.acc-table td{padding:12px 16px;border-bottom:1px solid #eee;font-size:14px;vertical-align:middle;}
    table.acc-table tr:last-child td{border-bottom:none;}
    table.acc-table img{width:56px;height:56px;object-fit:cover;border-radius:8px;}
    .acc-btn-edit{background:#eef3fa;color:#003366;border:none;border-radius:8px;
        padding:7px 14px;font-size:12px;font-weight:700;cursor:pointer;}
    .acc-empty{padding:50px;text-align:center;color:#999;}

    /* ===== Modal ===== */
    .acc-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);
        z-index:1000;align-items:flex-start;justify-content:center;padding:30px 20px;overflow-y:auto;}
    .acc-modal-overlay.active{display:flex;}
    .acc-modal{background:#f4f5f7;border-radius:16px;max-width:900px;width:100%;
        padding:0;position:relative;}
    .acc-modal-inner{padding:26px 28px 28px;}
    .acc-modal-topbar{position:sticky;top:0;background:#003366;color:#fff;padding:16px 24px;
        border-radius:16px 16px 0 0;display:flex;align-items:center;justify-content:space-between;z-index:2;}
    .acc-modal-topbar h3{margin:0;font-size:17px;font-weight:800;}
    .acc-modal-close{background:rgba(255,255,255,.15);border:none;color:#fff;
        width:30px;height:30px;border-radius:50%;font-size:16px;cursor:pointer;}

    .acc-section{background:#fff;border:1px solid #e8e8ec;border-radius:14px;
        padding:20px 22px;margin-bottom:16px;}
    .acc-section-title{font-size:13px;font-weight:800;color:#003366;text-transform:uppercase;
        letter-spacing:.5px;margin-bottom:14px;border-bottom:2px solid #d4af37;padding-bottom:8px;}
    .acc-subtitle{font-size:11.5px;font-weight:700;color:#e68a00;text-transform:uppercase;
        letter-spacing:.5px;margin:16px 0 8px;}

    .acc-fields{display:grid;grid-template-columns:1fr;gap:14px;margin-bottom:14px;}
    .acc-field label{display:block;font-size:11px;font-weight:700;color:#e68a00;
        text-transform:uppercase;letter-spacing:.6px;margin-bottom:6px;}
    .acc-field input[type=text]{width:100%;border:none;border-bottom:2px solid #e2e6ea;
        padding:8px 2px;font-size:14px;font-family:inherit;background:transparent;}
    .acc-field input:focus{outline:none;border-bottom-color:#003366;}
    .acc-field textarea{width:100%;border:1px solid #e2e6ea;border-radius:8px;
        padding:10px 12px;font-size:14px;font-family:inherit;min-height:90px;resize:vertical;}
    .acc-field textarea:focus{outline:none;border-color:#003366;}

    .file-zone{background:#f7f8fa;border:1px dashed #c8cdd3;border-radius:10px;
        padding:14px 16px;display:flex;align-items:center;gap:14px;flex-wrap:wrap;}
    .file-zone img{width:60px;height:60px;object-fit:cover;border-radius:8px;}

    .liste-row{display:flex;gap:10px;align-items:center;margin-bottom:8px;}
    .liste-row input{flex:1;border:1px solid #e2e6ea;border-radius:6px;padding:8px 10px;font-size:13px;}
    .liste-remove{background:#fbeaea;color:#c0392b;border:none;border-radius:6px;
        padding:6px 10px;font-size:12px;cursor:pointer;}
    .liste-add{background:#eef3fa;color:#003366;border:1px dashed #003366;border-radius:6px;
        padding:8px 14px;font-size:12px;font-weight:700;cursor:pointer;margin-top:6px;}

    .table-editor{width:100%;border-collapse:collapse;margin-top:10px;}
    .table-editor th{background:#003366;color:#d4af37;padding:8px;font-size:12px;text-align:left;}
    .table-editor td{padding:6px;border-bottom:1px solid #eee;}
    .table-editor input{width:100%;border:1px solid #e2e6ea;border-radius:5px;padding:6px 8px;font-size:13px;}
    .table-editor input.col-input{background:#fffbe6;font-weight:700;}
    .table-editor tr.total-row input{background:#eef3fa;font-weight:700;}
    .row-remove-btn{background:#fbeaea;color:#c0392b;border:none;border-radius:5px;
        padding:5px 8px;font-size:11px;cursor:pointer;}
    .table-add-row{background:#eef3fa;color:#003366;border:1px dashed #003366;border-radius:6px;
        padding:7px 14px;font-size:12px;font-weight:700;cursor:pointer;margin-top:10px;}

    .acc-submit-bar{display:flex;justify-content:flex-end;gap:12px;padding-top:6px;}
    .acc-submit{background:#d4af37;color:#003366;border:none;border-radius:10px;
        padding:13px 30px;font-weight:800;font-size:14px;cursor:pointer;}
    .acc-submit:hover{background:#c49f2e;}
    .acc-cancel{background:#eee;color:#555;border:none;border-radius:10px;
        padding:13px 22px;font-weight:700;font-size:13px;cursor:pointer;}
</style>

<div class="acc-wrap">
    <div class="acc-header">
        <div class="acc-header-icon">🗺️</div>
        <div>
            <h2>Arrondissements Maritimes</h2>
            <p>10 sections fixes — recherche puis modifie le contenu d'un arrondissement</p>
        </div>
    </div>

    @if(session('success'))
        <div class="acc-alert">✓ {{ session('success') }}</div>
    @endif

    <div class="acc-search-bar">
        <input type="text" id="arrSearch" placeholder="Rechercher un arrondissement par nom...">
    </div>

    <div class="acc-table-wrap">
        <table class="acc-table">
            <thead>
                <tr><th>Image</th><th>Arrondissement</th><th>Action</th></tr>
            </thead>
            <tbody id="arrTableBody">
                @forelse($arrondissements as $arr)
                    <tr class="arr-row" data-search="{{ strtolower($arr->nom) }}">
                        <td>
                            @if($arr->image)
                                <img src="{{ asset($arr->image) }}" alt="{{ $arr->nom }}">
                            @endif
                        </td>
                        <td>{{ $arr->nom }}</td>
                        <td>
                            <button type="button" class="acc-btn-edit" onclick='ouvrirModal(@json($arr))'>Modifier</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="acc-empty">Aucun arrondissement trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="noResults" class="acc-empty" style="display:none;">Aucun arrondissement ne correspond à ta recherche.</div>
</div>

{{-- ===== MODAL DE MODIFICATION (contient tout : texte, listes, tableaux) ===== --}}
<div class="acc-modal-overlay" id="arrModalOverlay">
    <div class="acc-modal">
        <div class="acc-modal-topbar">
            <h3 id="arrModalTitle">Modifier l'arrondissement</h3>
            <button type="button" class="acc-modal-close" onclick="fermerModal()">✕</button>
        </div>

        <div class="acc-modal-inner">
            <form method="POST" action="" enctype="multipart/form-data" id="arrForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                {{-- EN-TÊTE --}}
                <div class="acc-section">
                    <div class="acc-section-title">En-tête</div>
                    <div class="acc-fields">
                        <div class="acc-field">
                            <label>Nom de l'arrondissement</label>
                            <input type="text" name="nom" id="f_nom">
                        </div>
                    </div>
                    <div class="file-zone">
                        <img id="f_image_preview" src="" style="display:none;">
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#666;text-transform:uppercase;">Photo</label><br>
                            <input type="file" name="image" accept="image/*">
                        </div>
                    </div>
                </div>

                {{-- I. FONCTIONNEMENT / ORGANISATION --}}
                <div class="acc-section">
                    <div class="acc-section-title">I. Fonctionnement et Organisation</div>

                    <div class="acc-subtitle">A. Fonctionnement (texte)</div>
                    <div class="acc-field"><textarea name="fonctionnement" id="f_fonctionnement"></textarea></div>

                    <div class="acc-subtitle">B. Organisation — Liste des services</div>
                    <div id="services-list"></div>
                    <button type="button" class="liste-add" onclick="addListeItem('services-list','services[]','Ex: Un secrétariat')">＋ Ajouter un service</button>

                    <div class="acc-subtitle">Antennes / Stations annexes</div>
                    <div id="annexes-list"></div>
                    <button type="button" class="liste-add" onclick="addListeItem('annexes-list','annexes[]','Ex: Antenne Maritime de...')">＋ Ajouter une annexe</button>
                </div>

                {{-- II. ACTIVITÉS --}}
                <div class="acc-section">
                    <div class="acc-section-title">II. Les Activités</div>
                    <div class="acc-subtitle">Texte d'introduction</div>
                    <div class="acc-field" style="margin-bottom:14px;"><textarea name="activites_intro" id="f_activites_intro" style="min-height:70px;"></textarea></div>

                    <div class="acc-subtitle">Liste des activités</div>
                    <div id="activites-list"></div>
                    <button type="button" class="liste-add" onclick="addListeItem('activites-list','activites[]','Ex: La police balnéaire...')">＋ Ajouter une activité</button>
                </div>

                {{-- III. PARTENAIRES --}}
                <div class="acc-section">
                    <div class="acc-section-title">III. Les Partenaires</div>
                    <div id="partenaires-list"></div>
                    <button type="button" class="liste-add" onclick="addListeItem('partenaires-list','partenaires[]','Ex: Les consignataires...')">＋ Ajouter un partenaire</button>
                </div>

                {{-- IV. MOYENS HUMAINS --}}
                <div class="acc-section">
                    <div class="acc-section-title">IV. Moyens — Plan humain</div>
                    <table class="table-editor">
                        <thead>
                            <tr>
                                <th>Personnel</th>
                                <th><input type="text" class="col-input" name="humain_col[]" id="f_col1"></th>
                                <th><input type="text" class="col-input" name="humain_col[]" id="f_col2"></th>
                                <th><input type="text" class="col-input" name="humain_col[]" id="f_col3"></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="humain-body"></tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td><strong>Effectif total</strong></td>
                                <td><input type="text" name="humain_total[]" id="f_total1"></td>
                                <td><input type="text" name="humain_total[]" id="f_total2"></td>
                                <td><input type="text" name="humain_total[]" id="f_total3"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="button" class="table-add-row" onclick="addTableRow('humain-body', ['humain_label[]','humain_v1[]','humain_v2[]','humain_v3[]'])">＋ Ajouter une ligne</button>
                </div>

                {{-- IV. MOYENS MATÉRIELS --}}
                <div class="acc-section">
                    <div class="acc-section-title">IV. Moyens — Plan matériel</div>
                    <table class="table-editor">
                        <thead>
                            <tr><th>N°</th><th>Type d'engin</th><th>Usage</th><th>Marque</th><th>Date</th><th>Immatriculation</th><th></th></tr>
                        </thead>
                        <tbody id="materiel-body"></tbody>
                    </table>
                    <button type="button" class="table-add-row" onclick="addTableRow('materiel-body', ['materiel_num[]','materiel_type[]','materiel_usage[]','materiel_marque[]','materiel_date[]','materiel_immat[]'])">＋ Ajouter un engin</button>
                </div>

                <div class="acc-submit-bar">
                    <button type="button" class="acc-cancel" onclick="fermerModal()">Annuler</button>
                    <button type="submit" class="acc-submit">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const overlay = document.getElementById('arrModalOverlay');
const form    = document.getElementById('arrForm');
const title   = document.getElementById('arrModalTitle');
const preview = document.getElementById('f_image_preview');

function addListeItem(listId, inputName, placeholder, value = '') {
    const list = document.getElementById(listId);
    const row = document.createElement('div');
    row.className = 'liste-row';
    row.innerHTML = `
        <input type="text" name="${inputName}" value="${value.replace(/"/g,'&quot;')}" placeholder="${placeholder}">
        <button type="button" class="liste-remove" onclick="this.parentElement.remove()">✕</button>
    `;
    list.appendChild(row);
}

function addTableRow(bodyId, inputNames, values = []) {
    const tbody = document.getElementById(bodyId);
    const tr = document.createElement('tr');
    let cells = inputNames.map((name, i) => {
        const v = (values[i] ?? '').toString().replace(/"/g,'&quot;');
        return `<td><input type="text" name="${name}" value="${v}"></td>`;
    }).join('');
    cells += `<td><button type="button" class="row-remove-btn" onclick="this.closest('tr').remove()">✕</button></td>`;
    tr.innerHTML = cells;
    tbody.appendChild(tr);
}

function viderListes() {
    ['services-list','annexes-list','activites-list','partenaires-list'].forEach(id => {
        document.getElementById(id).innerHTML = '';
    });
    document.getElementById('humain-body').innerHTML = '';
    document.getElementById('materiel-body').innerHTML = '';
}

function ouvrirModal(arr) {
    viderListes();
    preview.style.display = 'none';

    title.innerText = 'Modifier : ' + arr.nom;
    // Adapte cette URL à ta vraie route de mise à jour
    form.action = "{{ url('espace-admin/arrondissements') }}/" + arr.id;

    document.getElementById('f_nom').value = arr.nom || '';
    document.getElementById('f_fonctionnement').value = arr.fonctionnement || '';
    document.getElementById('f_activites_intro').value = arr.activites_intro || '';

    if (arr.image) {
        preview.src = "{{ asset('') }}" + arr.image;
        preview.style.display = 'block';
    }

    (arr.services || []).forEach(s => addListeItem('services-list', 'services[]', '', s));
    (arr.annexes || []).forEach(s => addListeItem('annexes-list', 'annexes[]', '', s));
    (arr.activites || []).forEach(s => addListeItem('activites-list', 'activites[]', '', s));
    (arr.partenaires || []).forEach(s => addListeItem('partenaires-list', 'partenaires[]', '', s));

    const cols = arr.humain_cols || [];
    document.getElementById('f_col1').value = cols[0] || '';
    document.getElementById('f_col2').value = cols[1] || '';
    document.getElementById('f_col3').value = cols[2] || '';

    const totals = arr.humain_total || [];
    document.getElementById('f_total1').value = totals[0] || '';
    document.getElementById('f_total2').value = totals[1] || '';
    document.getElementById('f_total3').value = totals[2] || '';

    (arr.humain_rows || []).forEach(row => {
        addTableRow('humain-body', ['humain_label[]','humain_v1[]','humain_v2[]','humain_v3[]'],
            [row.label, row.v1, row.v2, row.v3]);
    });

    (arr.materiel_rows || []).forEach(row => {
        addTableRow('materiel-body', ['materiel_num[]','materiel_type[]','materiel_usage[]','materiel_marque[]','materiel_date[]','materiel_immat[]'],
            [row.num, row.type, row.usage, row.marque, row.date, row.immat]);
    });

    overlay.classList.add('active');
}

function fermerModal() {
    overlay.classList.remove('active');
}

overlay.addEventListener('click', (e) => { if (e.target === overlay) fermerModal(); });

document.getElementById('arrSearch').addEventListener('input', function() {
    const val = this.value.toLowerCase();
    const rows = document.querySelectorAll('.arr-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const match = row.dataset.search.includes(val);
        row.style.display = match ? '' : 'none';
        if (match) visibleCount++;
    });

    document.getElementById('noResults').style.display = visibleCount === 0 ? 'block' : 'none';
});
</script>

@endsection
