@extends('template')

@section('layout')

<div class="operators-site-container">
    <div class="global-overlay-op"></div>

    <div class="container content-z">
        <div class="op-header text-center">
            <h1 class="text-white">Liste des Opérateurs</h1>
            <p class="lead text-white">Consultez la liste des entreprises et acteurs agréés par la DGAMP.</p>

            <div class="search-wrapper-center mt-4">
                <form action="{{ route('operateurs.index') }}" method="GET" class="search-container-op">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher une entreprise ou une activité..." onchange="this.form.submit()">
                </form>
            </div>
        </div>

        <section class="table-section">
            <div class="table-responsive-op shadow-lg">
                <table class="op-table">
                    <thead>
                        <tr>
                            <th>Raison Sociale</th>
                            <th>Activités</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($operateurs as $operateur)
                            <tr class="op-row">
                                <td><strong>{{ $operateur->raison_sociale }}</strong></td>
                                <td>{{ $operateur->activite }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="padding: 30px; text-align: center; color: #666;">
                                    Aucun opérateur trouvé pour cette recherche.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-container">
                {{ $operateurs->appends(['search' => $search])->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
</div>

<style>
    .operators-site-container {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-image: url("{{ asset('assets/images/image33.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding-bottom: 100px;
    }

    .global-overlay-op {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.8) 0%, rgba(10, 10, 10, 0.85) 100%);
        z-index: 1;
    }

    .content-z { position: relative; z-index: 2; }

    .op-header { padding: 100px 0 40px; }
    .op-header h1 { font-size: 3rem; font-weight: 800; text-transform: uppercase; }

    .search-wrapper-center { display: flex; justify-content: center; width: 100%; }
    .search-container-op { width: 100%; max-width: 500px; }
    .search-container-op input {
        width: 100%;
        padding: 12px 25px;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        outline: none;
        transition: 0.3s;
        text-align: center;
    }
    .search-container-op input:focus { background: rgba(255, 255, 255, 0.2); border-color: #e37419; }

    .table-responsive-op { border-radius: 15px; overflow: hidden; }
    .op-table { width: 100%; border-collapse: collapse; background: white; }
    .op-table thead { background: #3b82c4; color: white; }
    .op-table th, .op-table td { padding: 18px 25px; text-align: left; }
    .op-table td { border-bottom: 1px solid #eee; color: #333; }
    .op-row:hover { background: #f8f9fa; }

    .pagination-container { display: flex; justify-content: center; margin-top: 40px; }
    .pagination-container .pagination .page-item .page-link {
        color: #333;
        border-radius: 8px;
        margin: 0 4px;
        font-weight: 700;
    }
    .pagination-container .pagination .page-item.active .page-link {
        background-color: #e37419;
        border-color: #e37419;
        color: white;
    }

    @media (max-width: 768px) {
        .op-header h1 { font-size: 2.2rem; }
    }
</style>

@endsection