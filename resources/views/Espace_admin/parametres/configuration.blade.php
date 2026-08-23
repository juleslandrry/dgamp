@extends('Espace_admin.layout')
@section('content')

<div class="admin-page-container">

    <div class="admin-page-header">
        <div>
            <h1 class="admin-title">Paramètres d'Apparence & Contact</h1>
            <p class="admin-subtitle">Gérez les coordonnées, liens sociaux et éléments visuels officiels de l'établissement.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <span><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
            <button class="close-alert" onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
    @endif

    <form action="{{ route('parametre.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="settings-grid">

            <!-- Carte Coordonnées -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="card-title"><i class="fas fa-address-book icon-header"></i> Coordonnées de Contact</h3>
                </div>
                <div class="admin-card-body">
                    <div class="form-group-custom">
                        <label>Téléphone / Contact Site</label>
                        <input type="text" name="telephone" class="input-custom" placeholder="Ex: 27 22 40 80 35" value="{{ old('telephone', $setting->telephone) }}">
                    </div>

                    <div class="form-group-custom">
                        <label>Adresse E-mail Officielle</label>
                        <input type="email" name="email" class="input-custom" placeholder="Ex: info@dgamp.ci" value="{{ old('email', $setting->email) }}">
                    </div>

                    <div class="form-group-custom">
                        <label>Lien d'intégration Google Maps (Attribut src du iframe)</label>
                        <textarea name="lien_maps" class="input-custom" rows="3" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('lien_maps', $setting->lien_maps) }}</textarea>
                        <small style="color: #718096; font-size: 0.78rem;">Copiez uniquement l'URL contenue dans l'attribut <code>src="..."</code> du code d'intégration Google Maps.</small>
                    </div>

                    <div class="form-group-custom">
                        <label>Boîte Postale</label>
                        <input type="text" name="boite_postale" class="input-custom" placeholder="Ex: BP V 67 Abidjan" value="{{ old('boite_postale', $setting->boite_postale) }}">
                    </div>

                    <div class="form-group-custom">
                        <label>Situation Géographique</label>
                        <input type="text" name="adresse" class="input-custom" placeholder="Ex: Abidjan, Deux Plateaux Aghien" value="{{ old('adresse', $setting->adresse) }}">
                    </div>
                </div>
            </div>

            <!-- Carte Réseaux Sociaux -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3 class="card-title"><i class="fas fa-share-alt icon-header"></i> Réseaux Sociaux</h3>
                </div>
                <div class="admin-card-body">
                    <div class="form-group-custom">
                        <label><i class="fab fa-facebook text-facebook"></i> Facebook (URL)</label>
                        <input type="url" name="facebook" class="input-custom" placeholder="https://facebook.com/..." value="{{ old('facebook', $setting->facebook) }}">
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fab fa-twitter text-twitter"></i> Twitter / X (URL)</label>
                        <input type="url" name="twitter" class="input-custom" placeholder="https://twitter.com/..." value="{{ old('twitter', $setting->twitter) }}">
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fab fa-youtube text-youtube"></i> YouTube (URL)</label>
                        <input type="url" name="youtube" class="input-custom" placeholder="https://youtube.com/..." value="{{ old('youtube', $setting->youtube) }}">
                    </div>

                    <div class="form-group-custom">
                        <label><i class="fab fa-linkedin text-linkedin"></i> LinkedIn (URL)</label>
                        <input type="url" name="linkedin" class="input-custom" placeholder="https://linkedin.com/in/..." value="{{ old('linkedin', $setting->linkedin) }}">
                    </div>
                </div>
            </div>

            <!-- Carte Logos & Branding -->
            <div class="admin-card full-width">
                <div class="admin-card-header">
                    <h3 class="card-title"><i class="fas fa-images icon-header"></i> Logotypes & Visuels Officiels</h3>
                </div>
                <div class="admin-card-body">
                    <div class="logos-grid">

                        <!-- Logo Principal -->
                        <div class="logo-upload-box">
                            <label class="logo-label">Logo Principal</label>
                            <div class="preview-area">
                                @if($setting->logo_principal)
                                    <img src="{{ asset('storage/' . $setting->logo_principal) }}" alt="Logo Principal">
                                @else
                                    <div class="no-preview"><i class="fas fa-image"></i> Pas d'image</div>
                                @endif
                            </div>
                            <input type="file" name="logo_principal" class="input-file-custom" accept="image/*">
                        </div>

                        <!-- Logo Connexion -->
                        <div class="logo-upload-box">
                            <label class="logo-label">Logo de Connexion (Admin/Portail)</label>
                            <div class="preview-area">
                                @if($setting->logo_connexion)
                                    <img src="{{ asset('storage/' . $setting->logo_connexion) }}" alt="Logo Connexion">
                                @else
                                    <div class="no-preview"><i class="fas fa-image"></i> Pas d'image</div>
                                @endif
                            </div>
                            <input type="file" name="logo_connexion" class="input-file-custom" accept="image/*">
                        </div>

                        <!-- Favicon -->
                        <div class="logo-upload-box">
                            <label class="logo-label">Favicon (Icône de navigateur)</label>
                            <div class="preview-area">
                                @if($setting->favicon)
                                    <img src="{{ asset('storage/' . $setting->favicon) }}" alt="Favicon" style="max-height: 48px;">
                                @else
                                    <div class="no-preview"><i class="fas fa-image"></i> Pas d'image</div>
                                @endif
                            </div>
                            <input type="file" name="favicon" class="input-file-custom" accept="image/*">
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="form-actions-sticky">
            <button type="submit" class="btn-custom btn-primary-custom">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<style>
    .admin-page-container { padding: 25px; font-family: 'Inter', system-ui, sans-serif; color: #2d3748; }
    .admin-page-header { margin-bottom: 25px; }
    .admin-title { font-size: 1.6rem; font-weight: 700; color: #1a202c; margin: 0 0 5px 0; }
    .admin-subtitle { color: #718096; font-size: 0.9rem; margin: 0; }

    .alert-custom { padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .alert-success-custom { background: #c6f6d5; color: #22543d; border: 1px solid #9ae6b4; }
    .close-alert { background: none; border: none; font-size: 1.2rem; cursor: pointer; color: inherit; }

    .settings-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 30px; }
    .full-width { grid-column: span 2; }

    .admin-card { background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; overflow: hidden; }
    .admin-card-header { padding: 18px 24px; border-bottom: 1px solid #edf2f7; background: #f8fafc; }
    .card-title { font-size: 1.05rem; font-weight: 700; margin: 0; color: #1a202c; display: flex; align-items: center; gap: 10px; }
    .icon-header { color: #1361b5; }

    .admin-card-body { padding: 20px 24px; }
    .form-group-custom { margin-bottom: 18px; }
    .form-group-custom label { display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 6px; color: #4a5568; }

    .input-custom { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 0.9rem; outline: none; transition: 0.2s; box-sizing: border-box; }
    .input-custom:focus { border-color: #1361b5; box-shadow: 0 0 0 3px rgba(19, 97, 181, 0.15); }

    .text-facebook { color: #1877f2; }
    .text-twitter { color: #1da1f2; }
    .text-youtube { color: #ff0000; }
    .text-linkedin { color: #0a66c2; }

    .logos-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .logo-upload-box { background: #f8fafc; border: 1px dashed #cbd5e0; border-radius: 10px; padding: 20px; text-align: center; }
    .logo-label { font-weight: 700; font-size: 0.85rem; color: #2d3748; display: block; margin-bottom: 12px; }
    .preview-area { height: 110px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 8px; border: 1px solid #edf2f7; margin-bottom: 12px; padding: 10px; }
    .preview-area img { max-height: 100%; max-width: 100%; object-fit: contain; }
    .no-preview { color: #a0aec0; font-size: 0.85rem; display: flex; align-items: center; gap: 6px; }
    .input-file-custom { font-size: 0.8rem; width: 100%; color: #4a5568; }

    .form-actions-sticky { position: sticky; bottom: 20px; background: white; padding: 15px 24px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; display: flex; justify-content: flex-end; }
    .btn-custom { padding: 12px 24px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; }
    .btn-primary-custom { background: #1361b5; color: white; }
    .btn-primary-custom:hover { background: #0e4b8e; }

    @media (max-width: 992px) {
        .settings-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
        .logos-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection
