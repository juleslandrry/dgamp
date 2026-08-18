<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DgampController;
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
Route::get('/mot_du_dg', [DgampController::class, 'mot_du_dg'])->name('motdudg');
Route::get('/biographie_du_dg', [DgampController::class, 'biographie_du_dg'])->name('biographiedudg');
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
Route::get('/even_à_venir', [DgampController::class, 'even_à_venir'])->name('evenàvenir');
Route::get('/even_passé', [DgampController::class, 'even_passé'])->name('evenpassé');
Route::get('/ena', [DgampController::class, 'ena'])->name('ena');
Route::get('/fonction_publique', [DgampController::class, 'fonction_publique'])->name('fonctionpublique');
Route::get('/galerie_img', [DgampController::class, 'galerie_img'])->name('galerie_img');
Route::get('/galerie_vidéo', [DgampController::class, 'galerie_vidéo'])->name('galerie_vidéo');
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
Route::get('/agrément_visa', [DgampController::class, 'agrément_visa'])->name('agrémentvisa');
Route::get('/immatriculation_navire', [DgampController::class, 'immatriculation_navire'])->name('immatriculationnavire');
Route::get('/visite_technique', [DgampController::class, 'visite_technique'])->name('visitetechnique');
Route::get('/permis_conduire', [DgampController::class, 'permis_conduire'])->name('permisconduire');
Route::get('/titres_maritimes', [DgampController::class, 'titres_maritimes'])->name('titresmaritimes');
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
Route::get('/personnel_militaire', [DgampController::class, 'personnel_militaire'])->name('personnelmilitaire');
Route::get('/personnel_interministériel', [DgampController::class, 'personnel_interministériel'])->name('personnelinterministériel');
Route::get('/fond_prévoyance', [DgampController::class, 'fond_prévoyance'])->name('fondprévoyance');
Route::get('/vie_social', [DgampController::class, 'vie_social'])->name('viesocial');
Route::get('/autre_association', [DgampController::class, 'autre_association'])->name('autreassociation');
Route::get('/opérateur', [DgampController::class, 'opérateur'])->name('opérateur');
Route::get('/partenaire', [DgampController::class, 'partenaire'])->name('partenaire');


// Espace admin


Route::get('/admin', [AdminController::class, 'home'])->name('accueiladmin');
Route::get('/admin/mot_dg', [AdminController::class, 'mot_dg'])->name('motdg');
Route::post('/admin/mot_dg', [AdminController::class, 'mot_dg_update'])->name('motdg.update');

Route::get('/admin/biographie_dg', [AdminController::class, 'bio_dg'])->name('biodg');
Route::post('/admin/biographie_dg', [AdminController::class, 'bio_dg_update'])->name('biodg.update');

Route::get('/admin/historique', [AdminController::class, 'historique'])->name('historique');
Route::post('/admin/historique', [AdminController::class, 'historique_update'])->name('historique.update');

Route::get('/admin/missions', [AdminController::class, 'missions'])->name('missions');
Route::post('/admin/missions', [AdminController::class, 'missions_update'])->name('missions.update');

Route::get('/admin/organigramme', [AdminController::class, 'organigramme'])->name('organigramme');
Route::post('/admin/organigramme', [AdminController::class, 'organigramme_update'])->name('organigramme.update');

Route::get('/admin/lois', [AdminController::class, 'lois'])->name('lois');
Route::post('/admin/lois', [AdminController::class, 'lois_update'])->name('lois.update');

Route::get('/admin/decrets', [AdminController::class, 'decrets'])->name('decrets');
Route::post('/admin/decrets', [AdminController::class, 'decrets_update'])->name('decrets.update');

Route::get('/admin/arretes', [AdminController::class, 'arretes'])->name('arretes');
Route::post('/admin/arretes', [AdminController::class, 'arretes_update'])->name('arretes.update');

Route::get('/admin/accords', [AdminController::class, 'accords'])->name('accords');
Route::post('/admin/accords', [AdminController::class, 'accords_update'])->name('accords.update');

Route::get('/admin/conventions', [AdminController::class, 'conventions'])->name('conventions');
Route::post('/admin/conventions', [AdminController::class, 'conventions_update'])->name('conventions.update');

Route::get('/admin/protocoles', [AdminController::class, 'protocoles'])->name('protocoles');
Route::post('/admin/protocoles', [AdminController::class, 'protocoles_update'])->name('protocoles.update');

Route::get('/admin/evenements', [AdminController::class, 'evenements'])->name('evenements');
Route::post('/admin/evenements/passes', [AdminController::class, 'evenements_passes_update'])->name('evenements.passes.update');
Route::post('/admin/evenements/avenir', [AdminController::class, 'evenements_avenir_update'])->name('evenements.avenir.update');

Route::get('/admin/ena', [AdminController::class, 'ena'])->name('ena');
Route::post('/admin/ena', [AdminController::class, 'ena_update'])->name('ena.update');

Route::get('/admin/fonction-publique', [AdminController::class, 'fonctionPublique'])->name('fonction-publique');
Route::post('/admin/fonction-publique', [AdminController::class, 'fonctionPublique_update'])->name('fonction-publique.update');

Route::get('/admin/galerie', [AdminController::class, 'galerie'])->name('galerie');
Route::post('/admin/galerie', [AdminController::class, 'galerie_update'])->name('galerie.update');

Route::get('/admin/videos', [AdminController::class, 'videos'])->name('videos');
Route::post('/admin/videos', [AdminController::class, 'videos_update'])->name('videos.update');

Route::get('/admin/actualites', [AdminController::class, 'actualites'])->name('actualites');
Route::post('/admin/actualites', [AdminController::class, 'actualites_update'])->name('actualites.update');

Route::get('/admin/communiques', [AdminController::class, 'communiques'])->name('communiques');
Route::post('/admin/communiques', [AdminController::class, 'communiques_update'])->name('communiques.update');

Route::get('/admin/activites-nos', [AdminController::class, 'activites'])->name('activites-nos');
Route::post('/admin/activites-nos/{section}', [AdminController::class, 'activites_update'])->name('activites-nos.update');

Route::get('/admin/visa', [AdminController::class, 'visa'])->name('visa');
Route::post('/admin/visa', [AdminController::class, 'visa_update'])->name('visa.update');

Route::get('/admin/services-en-ligne', [AdminController::class, 'servicesEnLigne'])->name('services-en-ligne');
Route::post('/admin/services-en-ligne', [AdminController::class, 'servicesEnLigne_update'])->name('services-en-ligne.update');