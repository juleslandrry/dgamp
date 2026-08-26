@extends('Espace_admin.layout')
@section('title', 'Administrateurs')

@section('content')
<!-- Bootstrap Icons au cas où il ne soit pas chargé dans le layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .admins-page { padding: 1.75rem; background-color: #f8fafc; min-height: 100vh; }

    .admins-header { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; margin-bottom:1.5rem; flex-wrap:wrap; }
    .admins-header h1 { font-size:1.6rem; font-weight:700; color:#1e2a3a; margin:0 0 .25rem; }
    .admins-header p { color:#7c8798; margin:0; font-size:.92rem; }

    .btn-primary-lg { display:inline-flex; align-items:center; gap:.5rem; background:#2563eb; color:#fff; border:none; padding:.7rem 1.25rem; border-radius:10px; font-weight:600; font-size:.92rem; cursor:pointer; transition:.15s; box-shadow:0 4px 10px rgba(37,99,235,.25); text-decoration:none; }
    .btn-primary-lg:hover { background:#1d4ed8; color:#fff; transform:translateY(-1px); }
    .btn-danger-lg { display:inline-flex; align-items:center; gap:.5rem; background:#e11d48; color:#fff; border:none; padding:.65rem 1.15rem; border-radius:10px; font-weight:600; font-size:.9rem; cursor:pointer; }
    .btn-danger-lg:hover { background:#be123c; }
    .btn-ghost { background:#f1f3f7; color:#4b5563; border:none; padding:.65rem 1.15rem; border-radius:10px; font-weight:600; font-size:.9rem; cursor:pointer; }
    .btn-ghost:hover { background:#e5e7eb; }

    .admins-alert { display:flex; align-items:center; gap:.65rem; padding:.9rem 1.1rem; border-radius:10px; margin-bottom:1.25rem; font-size:.92rem; }
    .admins-alert--success { background:#ecfdf5; color:#065f46; border:1px solid #a7f3d0; }
    .admins-alert--danger { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }
    .admins-alert__close { margin-left:auto; background:none; border:none; font-size:1.1rem; cursor:pointer; color:inherit; }

    .admins-card { background:#fff; border-radius:14px; box-shadow:0 2px 12px rgba(18,38,63,.06); border:1px solid #eef0f4; overflow:hidden; }
    .admins-card__toolbar { display:flex; align-items:center; justify-content:space-between; gap:1rem; padding:1.1rem 1.25rem; border-bottom:1px solid #eef0f4; flex-wrap:wrap; }

    .admins-search { position:relative; display:flex; align-items:center; background:#f6f7fb; border-radius:10px; padding:.55rem .9rem; min-width:280px; border:1px solid #e5e7eb; }
    .admins-search i { color:#9aa4b2; margin-right:.5rem; }
    .admins-search input { border:none; background:transparent; outline:none; font-size:.9rem; width:100%; }
    .admins-search__clear { color:#9aa4b2; text-decoration:none; font-size:1.1rem; padding-left:.4rem; }

    .admins-count { color:#7c8798; font-size:.85rem; font-weight:500; white-space:nowrap; }

    .admins-table-wrap { overflow-x:auto; }
    .admins-table { width:100%; border-collapse:collapse; }
    .admins-table thead th { text-align:left; font-size:.75rem; text-transform:uppercase; letter-spacing:.04em; color:#9aa4b2; font-weight:700; padding:.85rem 1.25rem; background:#fafbfc; border-bottom:1px solid #eef0f4; }
    .admins-table tbody td { padding:.95rem 1.25rem; border-bottom:1px solid #f2f3f6; font-size:.9rem; color:#374151; vertical-align:middle; }
    .admins-table tbody tr:last-child td { border-bottom:none; }
    .admins-table tbody tr:hover { background:#fafbff; }

    .admins-identity { display:flex; align-items:center; gap:.65rem; }
    .admins-avatar { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#2563eb,#1e40af); color:#fff; display:flex; align-items:center; justify-content:center; font-size:.78rem; font-weight:700; flex-shrink:0; }
    .admins-name { font-weight:600; color:#1e2a3a; }

    .admins-badge--role { display:inline-block; background:#eef2ff; color:#4338ca; padding:.3rem .65rem; border-radius:20px; font-size:.78rem; font-weight:600; }

    .admins-status { display:inline-flex; align-items:center; gap:.4rem; font-size:.83rem; font-weight:600; padding:.3rem .65rem .3rem .5rem; border-radius:20px; }
    .admins-status__dot { width:7px; height:7px; border-radius:50%; }
    .admins-status--actif { background:#ecfdf5; color:#047857; }
    .admins-status--actif .admins-status__dot { background:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,.18); }
    .admins-status--inactif { background:#f3f4f6; color:#6b7280; }
    .admins-status--inactif .admins-status__dot { background:#9ca3af; }

    .admins-icon-btn { width:34px; height:34px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; color:#6b7280; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; margin-left:.4rem; transition:.15s; }
    .admins-icon-btn--edit:hover { background:#eff6ff; border-color:#bfdbfe; color:#2563eb; }
    .admins-icon-btn--delete:hover { background:#fef2f2; border-color:#fecaca; color:#e11d48; }

    .admins-empty { text-align:center; padding:2.75rem 1rem; color:#9aa4b2; }
    .admins-empty i { font-size:2.2rem; display:block; margin-bottom:.6rem; }

    .admins-pagination { padding:1rem 1.25rem; display:flex; justify-content:flex-end; }

    .admins-modal { border-radius:16px; border:none; overflow:hidden; }
    .admins-modal .modal-header { border-bottom:1px solid #f0f1f4; padding:1.15rem 1.4rem; }
    .admins-modal .modal-title { font-weight:700; font-size:1.05rem; color:#1e2a3a; display:flex; align-items:center; }
    .admins-modal .modal-body { padding:1.4rem; }
    .admins-modal .modal-footer { border-top:1px solid #f0f1f4; padding:1.1rem 1.4rem; }

    .admins-field { margin-bottom:1rem; }
    .admins-field label { display:block; font-size:.83rem; font-weight:600; color:#374151; margin-bottom:.35rem; }
    .admins-field input, .admins-field select { width:100%; padding:.65rem .85rem; border:1px solid #e2e5eb; border-radius:9px; font-size:.9rem; outline:none; transition:.15s; }
    .admins-field input:focus, .admins-field select:focus { border-color:#93c5fd; box-shadow:0 0 0 3px rgba(37,99,235,.12); }
    .admins-field-row { display:grid; grid-template-columns:1fr 1fr; gap:.9rem; }

    .admins-modal--danger .modal-body.admins-modal__confirm { text-align:center; padding:2rem 1.5rem 1rem; }
    .admins-modal__icon { width:56px; height:56px; border-radius:50%; background:#fef2f2; color:#e11d48; font-size:1.5rem; display:flex; align-items:center; justify-content:center; margin:0 auto .9rem; }
    .admins-modal__confirm h5 { font-weight:700; color:#1e2a3a; margin-bottom:.4rem; }
    .admins-modal__confirm p { color:#7c8798; font-size:.9rem; }
    .admins-modal__confirm-footer { justify-content:center; }

    @media (max-width: 576px) {
        .admins-field-row { grid-template-columns:1fr; }
        .admins-card__toolbar { flex-direction:column; align-items:stretch; }
        .admins-search { min-width:0; }
    }
</style>

<div class="admins-page">

    {{-- ===================== EN-TÊTE ===================== --}}
    <div class="admins-header">
        <div>
            <h1>Administrateurs</h1>
            <p>Gérez les comptes ayant accès à l'espace d'administration.</p>
        </div>
        <button type="button" class="btn-primary-lg" data-bs-toggle="modal" data-bs-target="#modalAjouter">
            <i class="bi bi-plus-lg"></i> Ajouter un administrateur
        </button>
    </div>

    {{-- ===================== ALERTES ===================== --}}
    @if (session('succes'))
        <div class="admins-alert admins-alert--success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('succes') }}</span>
            <button type="button" class="admins-alert__close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if (session('erreur'))
        <div class="admins-alert admins-alert--danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ session('erreur') }}</span>
            <button type="button" class="admins-alert__close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="admins-alert admins-alert--danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
                <strong>Impossible d'enregistrer :</strong>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $erreur)
                        <li>{{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- ===================== CARTE / TABLEAU ===================== --}}
    <div class="admins-card">

        <div class="admins-card__toolbar">
            <form method="GET" class="admins-search">
                <i class="bi bi-search"></i>
                <input type="text" name="q" value="{{ $recherche ?? '' }}" placeholder="Rechercher un nom, un email, un titre...">
                @if(!empty($recherche))
                    <a href="{{ route('administrateurs.index') }}" class="admins-search__clear" title="Effacer">&times;</a>
                @endif
            </form>
            <span class="admins-count">{{ $administrateurs->total() }} administrateur(s)</span>
        </div>

        <div class="admins-table-wrap">
            <table class="admins-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($administrateurs as $admin)
                        <tr>
                            <td>
                                <div class="admins-identity">
                                    <span class="admins-avatar">{{ $admin->initiales }}</span>
                                    <span class="admins-name">{{ $admin->nom }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $admin->email }}</td>
                            <td><span class="admins-badge admins-badge--role">{{ $admin->titre }}</span></td>
                            <td>
                                <span class="admins-status admins-status--{{ $admin->statut }}">
                                    <span class="admins-status__dot"></span>
                                    {{ $admin->statut_label }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button type="button"
                                        class="admins-icon-btn admins-icon-btn--edit"
                                        title="Modifier"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalModifier"
                                        data-id="{{ $admin->id }}"
                                        data-nom="{{ $admin->nom }}"
                                        data-email="{{ $admin->email }}"
                                        data-titre="{{ $admin->titre }}"
                                        data-statut="{{ $admin->statut }}"
                                        data-action="{{ route('administrateurs.update', $admin) }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button type="button"
                                        class="admins-icon-btn admins-icon-btn--delete"
                                        title="Supprimer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalSupprimer"
                                        data-nom="{{ $admin->nom }}"
                                        data-action="{{ route('administrateurs.destroy', $admin) }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="admins-empty">
                                    <i class="bi bi-people"></i>
                                    <p>Aucun administrateur trouvé.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($administrateurs->hasPages())
            <div class="admins-pagination">
                {{ $administrateurs->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ===================== MODALES (INCHANGÉES) ===================== --}}
<div class="modal fade" id="modalAjouter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admins-modal">
            <form method="POST" action="{{ route('administrateurs.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-person-plus-fill me-2"></i>Ajouter un administrateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="admins-field">
                        <label for="add_nom">Nom complet</label>
                        <input type="text" id="add_nom" name="nom" value="{{ old('nom') }}" placeholder="Ex : Kouamé Hurbain" required>
                    </div>
                    <div class="admins-field">
                        <label for="add_email">Adresse email</label>
                        <input type="email" id="add_email" name="email" value="{{ old('email') }}" placeholder="nom@dgamp.ci" required>
                    </div>
                    <div class="admins-field">
                        <label for="add_titre">Titre / rôle</label>
                        <input type="text" id="add_titre" name="titre" value="{{ old('titre', 'Administrateur') }}" placeholder="Administrateur" required>
                    </div>
                    <div class="admins-field-row">
                        <div class="admins-field">
                            <label for="add_password">Mot de passe</label>
                            <input type="password" id="add_password" name="password" placeholder="8 caractères minimum" required>
                        </div>
                        <div class="admins-field">
                            <label for="add_password_confirmation">Confirmation</label>
                            <input type="password" id="add_password_confirmation" name="password_confirmation" placeholder="Retapez le mot de passe" required>
                        </div>
                    </div>
                    <div class="admins-field">
                        <label for="add_statut">Statut</label>
                        <select id="add_statut" name="statut" required>
                            <option value="actif" @selected(old('statut') === 'actif')>En ligne</option>
                            <option value="inactif" @selected(old('statut', 'inactif') === 'inactif')>Hors ligne</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-ghost" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-primary-lg"><i class="bi bi-check-lg"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalModifier" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admins-modal">
            <form method="POST" id="formModifier" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Modifier l'administrateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="admins-field">
                        <label for="edit_nom">Nom complet</label>
                        <input type="text" id="edit_nom" name="nom" required>
                    </div>
                    <div class="admins-field">
                        <label for="edit_email">Adresse email</label>
                        <input type="email" id="edit_email" name="email" required>
                    </div>
                    <div class="admins-field">
                        <label for="edit_titre">Titre / rôle</label>
                        <input type="text" id="edit_titre" name="titre" required>
                    </div>
                    <div class="admins-field-row">
                        <div class="admins-field">
                            <label for="edit_password">Nouveau mot de passe</label>
                            <input type="password" id="edit_password" name="password" placeholder="Laisser vide pour ne pas changer">
                        </div>
                        <div class="admins-field">
                            <label for="edit_password_confirmation">Confirmation</label>
                            <input type="password" id="edit_password_confirmation" name="password_confirmation" placeholder="Retapez si modifié">
                        </div>
                    </div>
                    <div class="admins-field">
                        <label for="edit_statut">Statut</label>
                        <select id="edit_statut" name="statut" required>
                            <option value="actif">En ligne</option>
                            <option value="inactif">Hors ligne</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-ghost" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-primary-lg"><i class="bi bi-check-lg"></i> Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSupprimer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admins-modal admins-modal--danger">
            <form method="POST" id="formSupprimer" action="">
                @csrf
                @method('DELETE')
                <div class="modal-body admins-modal__confirm">
                    <div class="admins-modal__icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                    <h5>Supprimer cet administrateur ?</h5>
                    <p>Vous êtes sur le point de supprimer <strong id="delete_nom"></strong>. Cette action est irréversible.</p>
                </div>
                <div class="modal-footer admins-modal__confirm-footer">
                    <button type="button" class="btn-ghost" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-danger-lg"><i class="bi bi-trash-fill"></i> Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalModifier = document.getElementById('modalModifier');
        if(modalModifier) {
            modalModifier.addEventListener('show.bs.modal', function (event) {
                const bouton = event.relatedTarget;
                const form = document.getElementById('formModifier');

                form.action = bouton.getAttribute('data-action');
                document.getElementById('edit_nom').value = bouton.getAttribute('data-nom');
                document.getElementById('edit_email').value = bouton.getAttribute('data-email');
                document.getElementById('edit_titre').value = bouton.getAttribute('data-titre');
                document.getElementById('edit_statut').value = bouton.getAttribute('data-statut');
                document.getElementById('edit_password').value = '';
                document.getElementById('edit_password_confirmation').value = '';
            });
        }

        const modalSupprimer = document.getElementById('modalSupprimer');
        if(modalSupprimer) {
            modalSupprimer.addEventListener('show.bs.modal', function (event) {
                const bouton = event.relatedTarget;
                document.getElementById('formSupprimer').action = bouton.getAttribute('data-action');
                document.getElementById('delete_nom').textContent = bouton.getAttribute('data-nom');
            });
        }
    });
</script>
@endsection