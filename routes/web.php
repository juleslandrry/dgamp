<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DgampController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\MotDgController;
use App\Http\Controllers\BiographieDgController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EnaController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\PartenaireController;


use App\Http\Controllers\FonctionPubliqueController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ServiceEnLigneController;
use App\Http\Controllers\PersonnelParamilitaireController;
use App\Http\Controllers\PersonnelInterministerielController;
use App\Http\Controllers\VieAssociativeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('index');
});*/

Route::get('/', [DgampController::class, 'home'])->name('accueildgamp');
Route::get('/ecrire_au_dg', [DgampController::class, 'ecrire_au_dg'])->name('ecrireaudg');

Route::get('/historique_dgam', [DgampController::class, 'historique_dgam'])->name('historiquedgam');
Route::get('/mission_et_objectif', [DgampController::class, 'mission_et_objectif'])->name('missionetobjectif');
Route::get('/organigrame_dgam', [DgampController::class, 'organigrame_dgam'])->name('organigramedgam');
Route::get('/lois_dgam', [DgampController::class, 'lois_dgam'])->name('loisdgam');
Route::get('/decret_dgam', [DgampController::class, 'decret_dgam'])->name('decretdgam');
Route::get('/arrêté_de_decision', [DgampController::class, 'arrêté_de_decision'])->name('arrêtédedecision');
Route::get('/convention_dgam', [DgampController::class, 'convention_dgam'])->name('conventiondgam');
Route::get('/accord_dgam', [DgampController::class, 'accord_dgam'])->name('accorddgam');
Route::get('/protocole_dgam', [DgampController::class, 'protocole_dgam'])->name('protocoledgam');

Route::get('/fonction_publique', [DgampController::class, 'fonction_publique'])->name('fonctionpublique');
Route::get('/galerie_img', [DgampController::class, 'galerie_img'])->name('galerie_img');
Route::get('/galerie_vidéo', [DgampController::class, 'galerie_vidéo'])->name('galerie_vidéo');

Route::get('/agrément_visa', [DgampController::class, 'agrément_visa'])->name('agrémentvisa');
Route::get('/immatriculation_navire', [DgampController::class, 'immatriculation_navire'])->name('immatriculationnavire');
Route::get('/visite_technique', [DgampController::class, 'visite_technique'])->name('visitetechnique');
Route::get('/permis_conduire', [DgampController::class, 'permis_conduire'])->name('permisconduire');
Route::get('/titres_maritimes', [DgampController::class, 'titres_maritimes'])->name('titresmaritimes');

Route::get('/personnel_militaire', [DgampController::class, 'personnel_militaire'])->name('personnelmilitaire');
Route::get('/personnel_interministériel', [DgampController::class, 'personnel_interministériel'])->name('personnelinterministériel');
Route::get('/fond_prévoyance', [DgampController::class, 'fond_prévoyance'])->name('fondprévoyance');
Route::get('/vie_social', [DgampController::class, 'vie_social'])->name('viesocial');
Route::get('/autre_association', [DgampController::class, 'autre_association'])->name('autreassociation');




Route::get('/communiqué', [DgampController::class, 'communiqué'])->name('communiqué');
Route::get('/actualité', [DgampController::class, 'actualité'])->name('actualité');
Route::get('/securité_maritime', [DgampController::class, 'securité_maritime'])->name('securitémaritime');
Route::get('/sureté_portuaire', [DgampController::class, 'sureté_portuaire'])->name('suretéportuaire');
Route::get('/santé_population_mer', [DgampController::class, 'santé_population_mer'])->name('santépopulationmer');
Route::get('/gestion_population_mer', [DgampController::class, 'gestion_population_mer'])->name('gestionpopulationmer');
Route::get('/plaisance_activité_nautique', [DgampController::class, 'plaisance_activité_nautique'])->name('plaisanceactiviténautique');
Route::get('/transport_fluvio_lagunaire', [DgampController::class, 'transport_fluvio_lagunaire'])->name('transportfluviolagunaire');
Route::get('/recouvrement', [DgampController::class, 'recouvrement'])->name('recouvrement');
Route::get('/coordination_sauvetage_maritime', [DgampController::class, 'coordination_sauvetage_maritime'])->name('coordinationsauvetagemaritime');
// Route::get('/agrément_visa', [DgampController::class, 'agrément_visa'])->name('agrémentvisa');
// Route::get('/immatriculation_navire', [DgampController::class, 'immatriculation_navire'])->name('immatriculationnavire');
// Route::get('/visite_technique', [DgampController::class, 'visite_technique'])->name('visitetechnique');
// Route::get('/permis_conduire', [DgampController::class, 'permis_conduire'])->name('permisconduire');
// Route::get('/titres_maritimes', [DgampController::class, 'titres_maritimes'])->name('titresmaritimes');
Route::get('/arrondissement_adiaké', [DgampController::class, 'arrondissement_adiaké'])->name('arrondissementadiaké');
Route::get('/arrondissement_san_pedro', [DgampController::class, 'arrondissement_san_pedro'])->name('arrondissementsanpedro');
Route::get('/arrondissement_grand_bassam', [DgampController::class, 'arrondissement_grand_bassam'])->name('arrondissementgrandbassam');
Route::get('/arrondissement_tabou', [DgampController::class, 'arrondissement_tabou'])->name('arrondissementtabou');
Route::get('/arrondissement_abidjan', [DgampController::class, 'arrondissement_abidjan'])->name('arrondissementabidjan');
Route::get('/arrondissement_jacqueville', [DgampController::class, 'arrondissement_jacqueville'])->name('arrondissementjacqueville');
Route::get('/arrondissement_sassandra', [DgampController::class, 'arrondissement_sassandra'])->name('arrondissementsassandra');
Route::get('/arrondissement_grand_lahou', [DgampController::class, 'arrondissement_grand_lahou'])->name('arrondissementgrandlahou');
Route::get('/arrondissement_bingerville', [DgampController::class, 'arrondissement_bingerville'])->name('arrondissementbingerville');
Route::get('/arrondissement_fresco', [DgampController::class, 'arrondissement_fresco'])->name('arrondissementfresco');
// Route::get('/personnel_militaire', [DgampController::class, 'personnel_militaire'])->name('personnelmilitaire');
// Route::get('/personnel_interministériel', [DgampController::class, 'personnel_interministériel'])->name('personnelinterministériel');
// Route::get('/fond_prévoyance', [DgampController::class, 'fond_prévoyance'])->name('fondprévoyance');
// Route::get('/vie_social', [DgampController::class, 'vie_social'])->name('viesocial');
// Route::get('/autre_association', [DgampController::class, 'autre_association'])->name('autreassociation');
Route::get('/opérateur', [DgampController::class, 'opérateur'])->name('opérateur');
Route::get('/partenaire', [DgampController::class, 'partenaire'])->name('partenaire');



//ROUTES ADOU

//Site principale
Route::get('/historique', [OrganisationController::class, 'historiqueSite'])->name('historiquedgam');
// Route::get('/historique_dgam', [DgampController::class, 'historique_dgam'])->name('historiquedgam');
Route::get('/mission_et_objectif', [DgampController::class, 'mission_et_objectif'])->name('missionetobjectif');
// Route::get('/organigrame_dgam', [DgampController::class, 'organigrame_dgam'])->name('organigramedgam');
Route::get('/organigramme_dgam', [OrganisationController::class, 'organigrammeSite'])->name('organigramedgam');

Route::get('/missions-objectifs', [OrganisationController::class, 'missionsObjectifs'])->name('missions.objectifs');

Route::get('/lois_dgam', [DocumentationController::class, 'showLois'])->name('loisdgam');
Route::get('/decret_dgam', [DocumentationController::class, 'showDecrets'])->name('decretdgam');
Route::get('/arrêté_de_decision', [DocumentationController::class, 'showArrete'])->name('arretededecision');
Route::get('/convention_dgam', [DocumentationController::class, 'showConventions'])->name('conventiondgam');
Route::get('/accord_dgam', [DocumentationController::class, 'showAccords'])->name('accorddgam');
Route::get('/protocole_dgam', [DocumentationController::class, 'showProtocoles'])->name('protocoledgam');
Route::get('/communiques', [CommunicationController::class, 'showCommunique'])->name('communiquesdgam');
Route::get('/actualites', [CommunicationController::class, 'showActualite'])->name('actualitesdgam');
Route::get('/activites/{slug}', [ActiviteController::class, 'showActivite'])->name('activitesdgam');
Route::get('/arrondissements/{slug}', [ArrondissementController::class, 'showArrondissement'])->name('arrondissements.show');
Route::get('/operateurs', [OperateurController::class, 'showOperateur'])->name('operateursdgam');
Route::get('/partenaires', [PartenaireController::class, 'showPartenaire'])->name('parteaniresdgam');


// Espace admin
Route::get('/admin', [AdminController::class, 'home'])->name('accueiladmin');


Route::get('/admin/historique',[OrganisationController::class, 'historique'])->name('admin.historique');
Route::post('/admin/historique',[OrganisationController::class, 'updateHistorique'])->name('admin.historique.update');

Route::get('/admin/missions',[OrganisationController::class, 'missions'])->name('admin.missions');
Route::post('/admin/missions',[OrganisationController::class, 'updateMissions'])->name('admin.missions.update');

Route::get('/admin/organigramme',[OrganisationController::class, 'organigramme'])->name('admin.organigramme');
Route::post('/admin/organigramme',[OrganisationController::class, 'updateOrganigramme'])->name('admin.organigramme.update');


Route::prefix('admin')->group(function () {
    Route::get('/lois-et-reglements',[DocumentationController::class, 'indexLois'])->name('lois.index');
    Route::post('/lois-et-reglements',[DocumentationController::class, 'updateLois'])->name('lois.update');

    Route::get('/decrets-et-arretes', [DocumentationController::class, 'indexDecrets'])->name('decrets.index');
    Route::post('/decrets-et-arretes', [DocumentationController::class, 'updateDecrets'])->name('decrets.update');

    Route::get('/arretes', [DocumentationController::class, 'indexArrete'])->name('arretes.index');
    Route::post('/arretes/update', [DocumentationController::class, 'updateArretes'])->name('arretes.update');

    Route::get('/conventions', [DocumentationController::class, 'editConventions'])->name('conventions.edit');
    Route::post('/conventions', [DocumentationController::class, 'updateConventions'])->name('conventions.update');

    Route::get('/accords', [DocumentationController::class, 'editAccords'])->name('accords.edit');
    Route::post('/accords', [DocumentationController::class, 'updateAccords'])->name('accords.update');

    Route::get('/protocoles', [DocumentationController::class, 'editProtocoles'])->name('protocoles.edit');
    Route::post('/protocoles', [DocumentationController::class, 'updateProtocoles'])->name('protocoles.update');

    Route::get('/communiques', [CommunicationController::class, 'indexCommunique'])->name('communiques.index');
    Route::post('/communiques', [CommunicationController::class, 'storeCommunique'])->name('communiques.store');
    Route::put('/communiques/{id}', [CommunicationController::class, 'updateCommunique'])->name('communiques.update');
    Route::delete('/communiques/{id}', [CommunicationController::class, 'destroyCommunique'])->name('communiques.destroy');

    Route::get('/actualites', [CommunicationController::class, 'indexActualite'])->name('actualites.index');
    Route::post('/actualites', [CommunicationController::class, 'storeActualite'])->name('actualites.store');
    Route::put('/actualites/{id}', [CommunicationController::class, 'updateActualite'])->name('actualites.update');
    Route::delete('/actualites/{id}', [CommunicationController::class, 'destroyActualite'])->name('actualites.destroy');

    Route::get('/activites', [ActiviteController::class, 'indexActivite'])->name('activites.index');
    
    // CRUD Activités
    Route::post('/activites', [ActiviteController::class, 'storeActivite'])->name('activites.store');
    Route::put('/activites/{activite}', [ActiviteController::class, 'updateActivite'])->name('activites.update');
    Route::delete('/activites/{activite}', [ActiviteController::class, 'destroyActivite'])->name('activites.destroy');

    // CRUD Réglementations
    Route::post('/activites/{activite}/reglementations', [ActiviteController::class, 'storeReglementation'])->name('activites.reglementations.store');
    Route::delete('/reglementations/{reglementation}', [ActiviteController::class, 'destroyReglementation'])->name('reglementations.destroy');

    Route::resource('arrondissements', ArrondissementController::class)->names('arrondissements')->except(['show']);
    Route::post('arrondissements/upload-image', [ArrondissementController::class, 'uploadImage'])->name('arrondissements.upload_image');

    Route::get('/operateur', [OperateurController::class, 'index'])->name('operateurs.index');
    Route::post('/operateur', [OperateurController::class, 'store'])->name('operateurs.store');
    Route::put('/operateur/{id}', [OperateurController::class, 'update'])->name('operateurs.update');
    Route::delete('/operateur/{id}', [OperateurController::class, 'destroy'])->name('operateurs.destroy');

    Route::get('/partenaires', [PartenaireController::class, 'index'])->name('partenaires.index');
    Route::post('/partenaires', [PartenaireController::class, 'store'])->name('partenaires.store');
    Route::put('/partenaires/{partenaire}', [PartenaireController::class, 'update'])->name('partenaires.update');
    Route::delete('/partenaires/{partenaire}', [PartenaireController::class, 'destroy'])->name('partenaires.destroy');

});






Route::get('/admin/visa', [AdminController::class, 'visa'])->name('visa');
Route::post('/admin/visa', [AdminController::class, 'visa_update'])->name('visa.update');




// Routes eliette
//site principale
Route::get('/mot_du_dg', [MotDgController::class, 'show'])->name('motdudg');
Route::get('/biographie_du_dg', [BiographieDgController::class, 'show'])->name('biographiedudg');
Route::get('/even_à_venir', [EvenementController::class, 'showAvenir'])->name('evenàvenir');
Route::get('/even_passé', [EvenementController::class, 'showPasses'])->name('evenpassé');
Route::get('/ena', [EnaController::class, 'show'])->name('ena');
Route::get('/fonction_publique', [FonctionPubliqueController::class, 'show'])->name('fonctionpublique');
Route::get('/galerie_img', [GalerieController::class, 'show'])->name('galerie_img');
Route::get('/galerie_vidéo', [VideoController::class, 'show'])->name('galerie_vidéo');
Route::get('/service/{slug}', [ServiceEnLigneController::class, 'show'])->name('service.show');
Route::get('/personnel_militaire', [PersonnelParamilitaireController::class, 'show'])->name('personnelmilitaire');
Route::get('/personnel_interministériel', [PersonnelInterministerielController::class, 'show'])->name('personnelinterministériel');
Route::get('/fond_prévoyance', [VieAssociativeController::class, 'showPrevoyance'])->name('fondprévoyance');
Route::get('/vie_social', [VieAssociativeController::class, 'showVieSociale'])->name('viesocial');
Route::get('/autre_association', [VieAssociativeController::class, 'showAutresAssociations'])->name('autreassociation');



// Admin
Route::get('/admin/mot_dg', [MotDgController::class, 'edit'])->name('motdg');
Route::post('/admin/mot_dg', [MotDgController::class, 'update'])->name('motdg.update');
Route::post('/admin/mot_dg/upload-image', [MotDgController::class, 'uploadImage'])->name('motdg.upload-image');
Route::get('/admin/biographie_dg', [BiographieDgController::class, 'edit'])->name('biodg');
Route::post('/admin/biographie_dg', [BiographieDgController::class, 'update'])->name('biodg.update');
Route::get('/admin/evenements', [EvenementController::class, 'edit'])->name('evenements');
Route::post('/admin/evenements/passes', [EvenementController::class, 'updatePasses'])->name('evenements.passes.update');
Route::post('/admin/evenements/avenir', [EvenementController::class, 'updateAvenir'])->name('evenements.avenir.update');
Route::get('/admin/ena', [EnaController::class, 'edit'])->name('admin.ena');
Route::post('/admin/ena', [EnaController::class, 'update'])->name('ena.update');
Route::get('/admin/fonction-publique', [FonctionPubliqueController::class, 'edit'])->name('fonction-publique');
Route::post('/admin/fonction-publique', [FonctionPubliqueController::class, 'update'])->name('fonction-publique.update');
Route::get('/admin/galerie', [GalerieController::class, 'edit'])->name('galerie');
Route::post('/admin/galerie', [GalerieController::class, 'update'])->name('galerie.update');

Route::get('/admin/videos', [VideoController::class, 'edit'])->name('videos');
Route::post('/admin/videos', [VideoController::class, 'update'])->name('videos.update');
Route::get('/admin/services-en-ligne', [ServiceEnLigneController::class, 'edit'])->name('services-en-ligne');
Route::post('/admin/services-en-ligne', [ServiceEnLigneController::class, 'update'])->name('services-en-ligne.update');
Route::delete('/admin/services-en-ligne/{id}', [ServiceEnLigneController::class, 'destroy'])->where('id', '[0-9]+')->name('services-en-ligne.destroy');
Route::delete('/admin/ena/{id}', [EnaController::class, 'destroy'])->where('id', '[0-9]+')->name('ena.destroy');

Route::delete('/admin/fonction-publique/{id}', [FonctionPubliqueController::class, 'destroy'])->where('id', '[0-9]+')->name('fonction-publique.destroy');
Route::get('/admin/personnel_paramilitaire', [PersonnelParamilitaireController::class, 'edit'])->name('admin.personnel-paramilitaire');
Route::post('/admin/personnel_paramilitaire', [PersonnelParamilitaireController::class, 'update'])->name('admin.personnel-paramilitaire.update');
Route::get('/admin/personnel_interministeriel', [PersonnelInterministerielController::class, 'edit'])->name('admin.personnel-interministeriel');
Route::post('/admin/personnel_interministeriel', [PersonnelInterministerielController::class, 'update'])->name('admin.personnel-interministeriel.update');
Route::get('/admin/vie-associative/{type}', [VieAssociativeController::class, 'edit'])->name('admin.vie-associative.edit');
Route::post('/admin/vie-associative/{type}', [VieAssociativeController::class, 'update'])->name('admin.vie-associative.update');
Route::post('/admin/vie-associative/{type}/cartes', [VieAssociativeController::class, 'updateCards'])->name('admin.vie-associative.cards.update');
Route::delete('/admin/vie-associative/{type}/cartes/{id}', [VieAssociativeController::class, 'destroyCard'])->where('id', '[0-9]+')->name('admin.vie-associative.cards.destroy');
