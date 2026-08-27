@extends('Espace_admin.layout')
@section('content')

<style>
    :root{
        --navy:#0B2340; --blue:#1E7FB8; --orange:#E8720C; --green:#1F7A4D;
        --gold:#C9A227; --ink:#1C2733; --ink-soft:#66707B; --line:#E7E2D6;
        --red:#E74C3C; --pink:#EC407A; --dark:#37474F;
    }
    .mdg-wrap{max-width:1200px;margin:0 auto;padding:36px 24px 60px;}
    .mdg-title{font-size:22px;font-weight:800;color:var(--blue);text-align:center;
        letter-spacing:.03em;margin:0 0 30px;text-transform:uppercase;}

    /* Cartes du haut */
    .stat-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-bottom:34px;}
    .stat-card{border-radius:12px;padding:20px 22px;color:#fff;box-shadow:0 6px 18px rgba(0,0,0,.08);}
    .stat-card .label{font-size:14px;font-weight:600;opacity:.95;margin-bottom:14px;line-height:1.3;}
    .stat-card .value-row{display:flex;align-items:flex-end;justify-content:space-between;gap:10px;}
    .stat-card .value{font-size:32px;font-weight:800;line-height:1;}
    .stat-card .more{font-size:12.5px;font-weight:700;text-decoration:underline;color:#fff;
        background:none;border:none;cursor:pointer;opacity:.9;white-space:nowrap;}
    .stat-card .more:hover{opacity:1;}
    .card-green{background:linear-gradient(135deg,#1F7A4D,#26A465);}
    .card-orange{background:linear-gradient(135deg,#E8720C,#F5943D);}
    .card-pink{background:linear-gradient(135deg,#EC407A,#F06292);}
    .card-dark{background:linear-gradient(135deg,#37474F,#546E7A);}

    /* Section graphique */
    .panel{background:#fff;border:1.5px solid var(--line);border-radius:14px;padding:26px;
        margin-bottom:26px;box-shadow:0 3px 14px rgba(11,35,64,.04);}
    .panel-title{font-size:16px;font-weight:800;color:var(--blue);margin:0 0 20px;}

    /* Recherche par date */
    .date-filter{display:flex;align-items:flex-end;gap:16px;flex-wrap:wrap;margin-bottom:10px;}
    .date-field label{display:block;font-size:12px;font-weight:700;color:var(--navy);
        text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px;}
    .date-field input{border:1.5px solid var(--line);border-radius:8px;padding:9px 12px;font-size:13.5px;}
    .btn-rechercher{background:var(--red);color:#fff;border:none;border-radius:8px;
        padding:10px 22px;font-weight:700;font-size:13.5px;cursor:pointer;}
    .btn-rechercher:hover{background:#c0392b;}
    .btn-reset-filter{background:#EFEFEF;color:var(--ink-soft);border:none;border-radius:8px;
        padding:10px 18px;font-weight:700;font-size:13.5px;cursor:pointer;text-decoration:none;display:inline-block;}

    /* Table DataTables : quelques ajustements visuels */
    table.dataTable thead th{background:#FAF9F5;color:var(--navy);font-size:12px;
        text-transform:uppercase;letter-spacing:.03em;}
    .dt-buttons .btn, table.dataTable + .dt-buttons .dt-button{
        background:var(--navy) !important;color:#fff !important;border:none !important;
        border-radius:7px !important;font-size:12.5px !important;font-weight:700 !important;
        padding:8px 16px !important;margin-right:6px !important;}
    .dt-buttons .btn:hover{background:#123A63 !important;}
</style>

<div class="mdg-wrap">
    <h1 class="mdg-title">Statistiques du site web</h1>

    {{-- ===== CARTES ===== --}}
    <div class="stat-cards">
        <div class="stat-card card-green">
            <div class="label">Nombre de visiteurs en ligne</div>
            <div class="value-row">
                <span class="value">{{ $visiteursEnLigne }}</span>
            </div>
        </div>

        <div class="stat-card card-orange">
            <div class="label">Nombre de visiteurs sur le site</div>
            <div class="value-row">
                <span class="value">{{ number_format($totalVisiteurs, 0, ',', ' ') }}</span>
                <button type="button" class="more" onclick="document.getElementById('table-visites').scrollIntoView({behavior:'smooth'});">Voir plus</button>
            </div>
        </div>

        <div class="stat-card card-pink">
            <div class="label">Nombre d'articles d'actualités</div>
            <div class="value-row">
                <span class="value">{{ $totalArticles }}</span>
                <a href="{{ route('actualites.index') }}" class="more">Voir plus</a>
            </div>
        </div>

        <div class="stat-card card-dark">
            <div class="label">Nombre d'administrateurs</div>
            <div class="value-row">
                <span class="value">{{ $totalAdmins }}</span>
                <a href="{{ route('administrateurs.index') ?? '#' }}" class="more">Voir plus</a>
            </div>
        </div>
    </div>

    {{-- ===== GRAPHIQUE ===== --}}
    <div class="panel">
        <h2 class="panel-title">Évolution des visites (12 derniers mois)</h2>
        <canvas id="chartVisites" height="90"></canvas>
    </div>

    {{-- ===== RECHERCHE PAR DATE ===== --}}
    <div class="panel">
        <h2 class="panel-title">Recherche par date — {{ number_format($totalVisiteurs, 0, ',', ' ') }} visiteurs</h2>
        <form method="GET" action="{{ route('admin.statistique') }}" class="date-filter">
            <div class="date-field">
                <label>Début de période</label>
                <input type="date" name="debut" value="{{ $debut }}">
            </div>
            <div class="date-field">
                <label>Fin de période</label>
                <input type="date" name="fin" value="{{ $fin }}">
            </div>
            <button type="submit" class="btn-rechercher">Rechercher</button>
            @if($debut || $fin)
                <a href="{{ route('admin.statistique') }}" class="btn-reset-filter">Réinitialiser</a>
            @endif
        </form>
    </div>

    {{-- ===== TABLEAU ===== --}}
    <div class="panel" id="table-visites">
        <h2 class="panel-title">Détail des visites</h2>
        <table id="tableVisites" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Pays</th>
                    <th>Ville</th>
                    <th>Date de visite</th>
                    <th>Nombre de vues</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visites as $v)
                    <tr>
                        <td>{{ $v->pays }}</td>
                        <td>{{ $v->ville }}</td>
                        <td>{{ $v->date_visite->translatedFormat('d F Y') }}</td>
                        <td>{{ $v->vues }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Chart.js pour le graphique --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>

{{-- jQuery + DataTables + extensions d'export (Copy / CSV / Excel / PDF / Print) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===== Graphique =====
    new Chart(document.getElementById('chartVisites'), {
        type: 'bar',
        data: {
            labels: @json($labelsGraphique),
            datasets: [{
                label: 'Visites',
                data: @json($valeursGraphique),
                backgroundColor: '#1E7FB8',
                borderRadius: 6,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });

    // ===== Tableau exportable =====
    $('#tableVisites').DataTable({
        language: {
            search: "Search:",
            lengthMenu: "Afficher _MENU_ lignes",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ lignes",
            paginate: { previous: "Précédent", next: "Suivant" },
            zeroRecords: "Aucun résultat trouvé",
        },
        dom: 'Bfrtip',
        order: [[2, 'desc']],
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>

@endsection