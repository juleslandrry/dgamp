@extends('Espace_admin.layout')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="admin-page-container">
    
    <div class="admin-page-header">
        <h1 class="admin-title">Gestion des Partenaires</h1>
        <button class="btn-custom btn-primary-custom" onclick="openModal('addModal')">
            <i class="fas fa-plus"></i> Ajouter un Partenaire
        </button>
    </div>

    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <span>{{ session('success') }}</span>
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif

    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="card-title">Liste des Partenaires</h3>
            <form action="{{ route('partenaires.index') }}" method="GET" class="search-form-admin">
                <input type="text" name="search" class="input-custom search-input" placeholder="Rechercher..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn-custom btn-secondary-custom"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="admin-card-body">
            <div class="table-responsive-admin">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th style="width: 100px;">Logo</th>
                            <th>Nom du Partenaire</th>
                            <th>Type de Partenariat</th>
                            <th style="width: 120px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partenaires as $key => $partenaire)
                            <tr>
                                <td>{{ $partenaires->firstItem() + $key }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="{{ $partenaire->nom }}" class="partenaire-logo-preview">
                                </td>
                                <td><strong>{{ $partenaire->nom }}</strong></td>
                                <td>{{ $partenaire->type ?? '-' }}</td>
                                <td style="text-align: center;">
                                    <div class="action-buttons">
                                        <button type="button" class="btn-icon btn-edit" onclick="openModal('editModal{{ $partenaire->id }}')" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('partenaires.destroy', $partenaire->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-delete" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Édition -->
                            <div class="modal-overlay" id="editModal{{ $partenaire->id }}">
                                <div class="modal-custom">
                                    <div class="modal-header-custom">
                                        <h4>Modifier le Partenaire</h4>
                                        <span class="close-modal" onclick="closeModal('editModal{{ $partenaire->id }}')">&times;</span>
                                    </div>
                                    <form action="{{ route('partenaires.update', $partenaire->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body-custom">
                                            <div class="form-group-custom">
                                                <label>Nom de l'entreprise</label>
                                                <input type="text" name="nom" class="input-custom" value="{{ $partenaire->nom }}" required>
                                            </div>
                                            <div class="form-group-custom">
                                                <label>Type de Partenariat (Facultatif)</label>
                                                <input type="text" name="type" class="input-custom" value="{{ $partenaire->type }}">
                                            </div>
                                            <div class="form-group-custom">
                                                <label>Changer le Logo (Facultatif)</label>
                                                <input type="file" name="logo" class="input-custom" accept="image/*">
                                                <div class="mt-2">
                                                    <small>Logo actuel :</small><br>
                                                    <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="Logo" style="height: 40px; margin-top: 5px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer-custom">
                                            <button type="button" class="btn-custom btn-secondary-custom" onclick="closeModal('editModal{{ $partenaire->id }}')">Annuler</button>
                                            <button type="submit" class="btn-custom btn-primary-custom">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-table">Aucun partenaire trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper-admin">
                {{ $partenaires->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Ajout -->
<div class="modal-overlay" id="addModal">
    <div class="modal-custom">
        <div class="modal-header-custom">
            <h4>Nouveau Partenaire</h4>
            <span class="close-modal" onclick="closeModal('addModal')">&times;</span>
        </div>
        <form action="{{ route('partenaires.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body-custom">
                <div class="form-group-custom">
                    <label>Nom de l'entreprise</label>
                    <input type="text" name="nom" class="input-custom" placeholder="Ex: ARSTM" required>
                </div>
                <div class="form-group-custom">
                    <label>Type de Partenariat (Facultatif)</label>
                    <input type="text" name="type" class="input-custom" placeholder="Ex: Formation Maritime">
                </div>
                <div class="form-group-custom">
                    <label>Logo de l'entreprise</label>
                    <input type="file" name="logo" class="input-custom" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-custom btn-secondary-custom" onclick="closeModal('addModal')">Annuler</button>
                <button type="submit" class="btn-custom btn-primary-custom">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<style>
    .admin-page-container { padding: 25px; font-family: 'Inter', system-ui, sans-serif; color: #2d3748; }
    .admin-page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .admin-title { font-size: 1.6rem; font-weight: 700; color: #1a202c; margin: 0; }
    .btn-custom { padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; }
    .btn-primary-custom { background: #1361b5; color: white; }
    .btn-primary-custom:hover { background: #0e4b8e; }
    .btn-secondary-custom { background: #edf2f7; color: #4a5568; }
    .btn-secondary-custom:hover { background: #e2e8f0; }
    .action-buttons { display: flex; gap: 8px; justify-content: center; }
    .btn-icon { width: 34px; height: 34px; border-radius: 6px; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s; }
    .btn-edit { background: #ebf8ff; color: #3182ce; }
    .btn-edit:hover { background: #bee3f8; }
    .btn-delete { background: #fff5f5; color: #e53e3e; }
    .btn-delete:hover { background: #fed7d7; }
    .alert-custom { padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .alert-success-custom { background: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; }
    .close-alert { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: inherit; }
    .admin-card { background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; overflow: hidden; }
    .admin-card-header { padding: 20px 24px; border-bottom: 1px solid #edf2f7; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; }
    .card-title { font-size: 1.1rem; font-weight: 700; margin: 0; color: #2d3748; }
    .search-form-admin { display: flex; gap: 8px; }
    .input-custom { padding: 9px 14px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 0.9rem; outline: none; width: 100%; transition: 0.2s; }
    .input-custom:focus { border-color: #1361b5; box-shadow: 0 0 0 3px rgba(19, 97, 181, 0.15); }
    .search-input { width: 220px; }
    .admin-card-body { padding: 20px 24px; }
    .table-responsive-admin { overflow-x: auto; }
    .table-custom { width: 100%; border-collapse: collapse; text-align: left; }
    .table-custom th { background: #f7fafc; padding: 12px 16px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: #718096; border-bottom: 2px solid #edf2f7; }
    .table-custom td { padding: 14px 16px; border-bottom: 1px solid #edf2f7; font-size: 0.92rem; color: #4a5568; vertical-align: middle; }
    .table-custom tbody tr:hover { background: #f8fafc; }
    .empty-table { text-align: center; padding: 30px !important; color: #a0aec0; }
    .partenaire-logo-preview { height: 40px; width: 60px; object-fit: contain; background: #f7fafc; border: 1px solid #e2e8f0; padding: 3px; border-radius: 6px; }
    .modal-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(3px); display: none; align-items: center; justify-content: center; z-index: 9999; }
    .modal-overlay.active { display: flex; }
    .modal-custom { background: white; width: 100%; max-width: 500px; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); overflow: hidden; }
    .modal-header-custom { padding: 18px 24px; background: #f8fafc; border-bottom: 1px solid #edf2f7; display: flex; justify-content: space-between; align-items: center; }
    .modal-header-custom h4 { margin: 0; font-size: 1.1rem; color: #1a202c; }
    .close-modal { font-size: 1.5rem; cursor: pointer; color: #a0aec0; }
    .modal-body-custom { padding: 20px 24px; }
    .form-group-custom { margin-bottom: 16px; }
    .form-group-custom label { display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 6px; color: #4a5568; }
    .modal-footer-custom { padding: 16px 24px; background: #f8fafc; border-top: 1px solid #edf2f7; display: flex; justify-content: flex-end; gap: 10px; }
    .pagination-wrapper-admin { margin-top: 20px; }
</style>

<script>
    function openModal(id) { document.getElementById(id).classList.add('active'); }
    function closeModal(id) { document.getElementById(id).classList.remove('active'); }
</script>
@endsection