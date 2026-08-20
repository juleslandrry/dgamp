<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // protected string $motDgViewPath; // 
    // protected string $bioDgViewPath;
    protected string $historiqueViewPath;
    protected string $missionsViewPath;
    protected string $organigrammeViewPath;
    protected string $loisViewPath;
    protected string $decretsViewPath;
    protected string $arretesViewPath;
    protected string $accordsViewPath;
    protected string $conventionsViewPath;
    protected string $protocolesViewPath;
    protected string $evenementsPassesViewPath;
    protected string $evenementsAvenirViewPath;
    protected string $enaViewPath;
    protected string $fonctionPubliqueViewPath;
    protected string $galerieViewPath;
    protected string $videosViewPath;
    protected string $actualitesViewPath;
    protected string $communiquesViewPath;
    protected string $sauvetageViewPath;
    protected string $visaViewPath;

    // 👉 Ajoute cette propriété à côté des autres
    protected string $servicesEnLigneViewPath;

    // 👉 Liste des 6 services connus (doit correspondre aux clés de $solMeta dans la vue publique)
    protected array $servicesEnLigneNoms = [
        'Agréments et visas',
        'Autorisations',
        'Immatriculations des navires',
        'Livrets et titres maritimes',
        'Permis de conduire des navires',
        'Visite technique des navires',
    ];

    // 👉 Config de toutes les sections "Nos Activités"
    protected array $activitesSections = [
        'sauvetage' => [
            'label' => 'Coordination de Sauvetage Maritime',
            'path'  => 'accueil/apropos/activite/coordination-sauvetage-maritime.blade.php',
        ],
        'population-mer' => [
            'label' => 'Gestion des Populations en Mer',
            'path'  => 'accueil/apropos/activite/gestion-population-mer.blade.php',
        ],
        'plaisance' => [
            'label' => 'Plaisance & Activité Nautique',
            'path'  => 'accueil/apropos/activite/plaisance-activité-nautique.blade.php',
        ],
        'recouvrement' => [
            'label' => 'Recouvrement',
            'path'  => 'accueil/apropos/activite/recouvrement.blade.php',
        ],
        'sante-mer' => [
            'label' => 'Santé en Mer',
            'path'  => 'accueil/apropos/activite/santé-population-mer.blade.php',
        ],
        'securite-maritime' => [
            'label' => 'Sécurité Maritime',
            'path'  => 'accueil/apropos/activite/securité-maritime.blade.php',
        ],
        'surete-portuaire' => [
            'label' => 'Sûreté Portuaire',
            'path'  => 'accueil/apropos/activite/sureté-portuaire.blade.php',
        ],
        'transport-fluvio' => [
            'label' => 'Transport Fluvio-Lagunaire',
            'path'  => 'accueil/apropos/activite/transport-fluvio-lagunaire.blade.php',
        ],
    ];

    public function __construct()
    {
        // $this->motDgViewPath = resource_path('views/accueil/apropos/direction-general/mot-du-dg.blade.php'); // 🔴 déplacé vers MotDgController
        $this->bioDgViewPath = resource_path('views/accueil/apropos/direction-general/biographie-du-dg.blade.php');
        // $this->historiqueViewPath = resource_path('views/accueil/apropos/organisation/historique-dgam.blade.php');
        $this->missionsViewPath   = resource_path('views/accueil/apropos/organisation/mission-et-objectif.blade.php');
        $this->organigrammeViewPath = resource_path('views/accueil/apropos/organisation/organigrame-dgam.blade.php');
        $this->loisViewPath         = resource_path('views/accueil/apropos/documentation/textes-nationaux/lois-dgam.blade.php');
        $this->decretsViewPath      = resource_path('views/accueil/apropos/documentation/textes-nationaux/decret-dgam.blade.php');
        $this->arretesViewPath      = resource_path('views/accueil/apropos/documentation/textes-nationaux/arrêtés-de-decision.blade.php');
        $this->accordsViewPath      = resource_path('views/accueil/apropos/documentation/textes-nationaux/textes-internationaux/accord-dgam.blade.php');
        $this->conventionsViewPath  = resource_path('views/accueil/apropos/documentation/textes-nationaux/textes-internationaux/convention-dgam.blade.php');
        $this->protocolesViewPath   = resource_path('views/accueil/apropos/documentation/textes-nationaux/textes-internationaux/protocole-dgam.blade.php');
        $this->evenementsPassesViewPath = resource_path('views/accueil/agenda/even-à-venir.blade.php');
        $this->evenementsAvenirViewPath  = resource_path('views/accueil/agenda/even-passé.blade.php');
        $this->enaViewPath = resource_path('views/accueil/recrutement/ena.blade.php');
        $this->fonctionPubliqueViewPath = resource_path('views/accueil/recrutement/fonction-publique.blade.php');
        $this->galerieViewPath = resource_path('views/multimedia/galerie-img.blade.php');
        $this->videosViewPath = resource_path('views/multimedia/galerie-vidéo.blade.php');
        $this->actualitesViewPath = resource_path('views/actualité.blade.php');
        $this->communiquesViewPath = resource_path('views/communiqué.blade.php');
        $this->sauvetageViewPath = resource_path('views/activité/coordination-sauvetage-maritime.blade.php');
        $this->visaViewPath = resource_path('views/service-en-ligne\agrément-visa.blade.php');

        // 👉 Cette affectation était placée par erreur en dehors du constructeur : elle est maintenant ici
        $this->servicesEnLigneViewPath = resource_path('views/service-en-ligne/agrément-visa.blade.php');
    }

    public function home()
    {
        return view('Espace_admin.dashboard');
    }

    // ===================================================================
    //  MOT DU DG — déplacé vers MotDgController (base de données)
    // ===================================================================

    /*
    public function mot_dg()
    {
        if (!File::exists($this->motDgViewPath)) {
            abort(404, 'Fichier Mot du DG introuvable : ' . $this->motDgViewPath);
        }

        $content = File::get($this->motDgViewPath);

        preg_match('/<h3 style="font-weight:bold;">(.*?)<\/h3>/s', $content, $mNom);
        preg_match('/<img src="([^"]*)" class="dg-img">/s', $content, $mImg);
        preg_match('/<p class="text">(.*?)<\/p>/s', $content, $mTexte);
        preg_match('/<p class="signature">\s*(.*?)<br>\s*(.*?)\s*<\/p>/s', $content, $mSign);

        $data = [
            'nom_dg'   => trim($mNom[1] ?? ''),
            'photo'    => trim($mImg[1] ?? ''),
            'texte_dg' => trim(str_replace(['<br>', '<br/>', '<br />'], "\n", $mTexte[1] ?? '')),
            'titre_dg' => trim($mSign[2] ?? ''),
        ];

        return view('Espace_admin.accueil.directeurgene.mot_dg', $data);
    }

    public function mot_dg_update(Request $request)
    {
        $request->validate([
            'nom_dg'   => 'required|string|max:255',
            'titre_dg' => 'required|string|max:255',
            'texte_dg' => 'required|string',
            'photo'    => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $content = File::get($this->motDgViewPath);

        $content = preg_replace_callback(
            '/(<h3 style="font-weight:bold;">).*?(<\/h3>)/s',
            fn($m) => $m[1] . e($request->nom_dg) . $m[2],
            $content
        );

        $texteFormatted = nl2br(e($request->texte_dg));
        $content = preg_replace_callback(
            '/(<p class="text">).*?(<\/p>)/s',
            fn($m) => $m[1] . "\n" . $texteFormatted . "\n" . $m[2],
            $content
        );

        $content = preg_replace_callback(
            '/(<p class="signature">\s*).*?<br>\s*.*?(\s*<\/p>)/s',
            fn($m) => $m[1] . e($request->nom_dg) . '<br>' . "\n" . e($request->titre_dg) . $m[2],
            $content
        );

        if ($request->hasFile('photo')) {
            $filename = 'dg_' . time() . '.' . $request->file('photo')->extension();
            $request->file('photo')->move(public_path('assets/images'), $filename);

            $content = preg_replace_callback(
                '/(<img src=")[^"]*(" class="dg-img">)/s',
                fn($m) => $m[1] . 'assets/images/' . $filename . $m[2],
                $content
            );
        }

        File::put($this->motDgViewPath, $content);

        return redirect()
            ->route('motdg')
            ->with('success', 'Le Mot du Directeur Général a été mis à jour avec succès.');
    }
    */

    // ===================================================================
    //  BIOGRAPHIE DU DG
    // ===================================================================

    // public function bio_dg()
    // {
    //     if (!File::exists($this->bioDgViewPath)) {
    //         abort(404, 'Fichier Biographie DG introuvable : ' . $this->bioDgViewPath);
    //     }

    //     $content = File::get($this->bioDgViewPath);

    //     preg_match('/<p><span>Nom\s*:<\/span>\s*(.*?)<\/p>/su', $content, $mNom);
    //     preg_match('/<p><span>Prénoms\s*:<\/span>\s*(.*?)<\/p>/su', $content, $mPrenoms);
    //     preg_match('/<p><span>Naissance\s*:<\/span>\s*(.*?)<\/p>/su', $content, $mNaissance);
    //     preg_match('/<p><span>Corps\s*:<\/span>\s*(.*?)<\/p>/su', $content, $mCorps);
    //     preg_match('/<p><span>Grade \/ Classe\s*:<\/span>\s*(.*?)<\/p>/su', $content, $mGrade);
    //     preg_match('/<strong>Fonction actuelle\s*:<\/strong><br>\s*(.*?)\s*<\/div>/su', $content, $mFonction);
    //     preg_match('/<img src="([^"]*)" alt="Portrait DG"/', $content, $mImg);

    //     preg_match_all('/<div class="timeline-box">\s*<span class="date-badge">(.*?)<\/span>\s*<p>(.*?)<\/p>\s*<\/div>/su', $content, $mTimeline, PREG_SET_ORDER);
    //     preg_match_all('/<div class="edu-item">\s*<h5>(.*?)<\/h5>\s*<p>(.*?)<\/p>\s*<\/div>/su', $content, $mEdu, PREG_SET_ORDER);

    //     $timeline = array_map(fn($m) => ['date' => trim($m[1]), 'texte' => trim($m[2])], $mTimeline);
    //     $formation = array_map(fn($m) => ['annee' => trim($m[1]), 'texte' => trim($m[2])], $mEdu);

    //     $data = [
    //         'nom'       => trim($mNom[1] ?? ''),
    //         'prenoms'   => trim($mPrenoms[1] ?? ''),
    //         'naissance' => trim($mNaissance[1] ?? ''),
    //         'corps'     => trim($mCorps[1] ?? ''),
    //         'grade'     => trim($mGrade[1] ?? ''),
    //         'fonction'  => trim($mFonction[1] ?? ''),
    //         'photo'     => trim($mImg[1] ?? ''),
    //         'timeline'  => $timeline,
    //         'formation' => $formation,
    //     ];

    //     return view('Espace_admin.accueil.directeurgene.biographie', $data);
    // }

    // public function bio_dg_update(Request $request)
    // {
    //     $request->validate([
    //         'nom'                 => 'required|string|max:255',
    //         'prenoms'             => 'required|string|max:255',
    //         'naissance'           => 'required|string|max:255',
    //         'corps'               => 'required|string|max:255',
    //         'grade'               => 'required|string|max:255',
    //         'fonction'            => 'required|string',
    //         'photo'               => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
    //         'timeline_date'       => 'required|array',
    //         'timeline_date.*'     => 'required|string|max:100',
    //         'timeline_texte'      => 'required|array',
    //         'timeline_texte.*'    => 'required|string',
    //         'formation_annee'     => 'required|array',
    //         'formation_annee.*'   => 'required|string|max:20',
    //         'formation_texte'     => 'required|array',
    //         'formation_texte.*'   => 'required|string',
    //     ]);

    //     $content = File::get($this->bioDgViewPath);

    //     $simpleFields = [
    //         'Nom'       => $request->nom,
    //         'Prénoms'   => $request->prenoms,
    //         'Naissance' => $request->naissance,
    //         'Corps'     => $request->corps,
    //     ];
    //     foreach ($simpleFields as $label => $value) {
    //         $content = preg_replace_callback(
    //             '/(<p><span>' . preg_quote($label, '/') . '\s*:<\/span>\s*).*?(<\/p>)/su',
    //             fn($m) => $m[1] . e($value) . $m[2],
    //             $content
    //         );
    //     }

    //     $content = preg_replace_callback(
    //         '/(<p><span>Grade \/ Classe\s*:<\/span>\s*).*?(<\/p>)/su',
    //         fn($m) => $m[1] . e($request->grade) . $m[2],
    //         $content
    //     );

    //     $content = preg_replace_callback(
    //         '/(<strong>Fonction actuelle\s*:<\/strong><br>\s*).*?(\s*<\/div>)/su',
    //         fn($m) => $m[1] . e($request->fonction) . $m[2],
    //         $content
    //     );

    //     if ($request->hasFile('photo')) {
    //         $filename = 'dg_bio_' . time() . '.' . $request->file('photo')->extension();
    //         $request->file('photo')->move(public_path('assets/images'), $filename);

    //         $content = preg_replace_callback(
    //             '/(<img src=")[^"]*(" alt="Portrait DG")/',
    //             fn($m) => $m[1] . 'assets/images/' . $filename . $m[2],
    //             $content
    //         );
    //     }

    //     $timelineHtml = '';
    //     foreach ($request->timeline_date as $i => $date) {
    //         $texte = $request->timeline_texte[$i] ?? '';
    //         $timelineHtml .= "                    <div class=\"timeline-box\">\n";
    //         $timelineHtml .= "                        <span class=\"date-badge\">" . e($date) . "</span>\n";
    //         $timelineHtml .= "                        <p>" . e($texte) . "</p>\n";
    //         $timelineHtml .= "                    </div>\n";
    //     }
    //     $content = preg_replace_callback(
    //         '/(<div class="custom-timeline">\s*).*?(\s*<\/div>\s*<\/div>\s*<div class="col-md-5">)/su',
    //         fn($m) => $m[1] . "\n" . $timelineHtml . $m[2],
    //         $content
    //     );

    //     $formationHtml = '';
    //     foreach ($request->formation_annee as $i => $annee) {
    //         $texte = $request->formation_texte[$i] ?? '';
    //         $formationHtml .= "                    <div class=\"edu-item\">\n";
    //         $formationHtml .= "                        <h5>" . e($annee) . "</h5>\n";
    //         $formationHtml .= "                        <p>" . e($texte) . "</p>\n";
    //         $formationHtml .= "                    </div>\n";
    //     }
    //     $content = preg_replace_callback(
    //         '/(<div class="edu-card">\s*).*?(\s*<\/div>\s*<\/div>\s*<\/div>\s*<\/section>)/su',
    //         fn($m) => $m[1] . "\n" . $formationHtml . $m[2],
    //         $content
    //     );

    //     File::put($this->bioDgViewPath, $content);

    //     return redirect()
    //         ->route('biodg')
    //         ->with('success', 'La biographie du Directeur Général a été mise à jour avec succès.');
    // }

    // ===================================================================
    //  HISTORIQUE
    // ===================================================================

    // public function historique()
    // {
    //     if (!File::exists($this->historiqueViewPath)) {
    //         abort(404, 'Fichier Historique introuvable : ' . $this->historiqueViewPath);
    //     }

    //     $content = File::get($this->historiqueViewPath);

    //     preg_match('/<p class="intro">\s*(.*?)\s*<\/p>/su', $content, $mIntro);

    //     preg_match_all(
    //         '/<div class="timeline-item">\s*<span class="year">\s*(.*?)\s*<\/span>\s*<p>\s*(.*?)\s*<\/p>\s*<\/div>/su',
    //         $content,
    //         $mItems,
    //         PREG_SET_ORDER
    //     );

    //     $timeline = array_map(function ($m) {
    //         $texte = str_replace(['<br>', '<br/>', '<br />'], "\n", $m[2]);
    //         $texte = preg_replace('/[ \t]*\n[ \t]*/', "\n", trim($texte));
    //         return ['annee' => trim($m[1]), 'texte' => $texte];
    //     }, $mItems);

    //     $data = [
    //         'intro'    => trim($mIntro[1] ?? ''),
    //         'timeline' => $timeline,
    //     ];

    //     return view('Espace_admin.accueil.directeurgene.organisation.historique', $data);
    // }

    // public function historique_update(Request $request)
    // {
    //     $request->validate([
    //         'intro'              => 'required|string',
    //         'annee'              => 'required|array',
    //         'annee.*'            => 'required|string|max:100',
    //         'texte'              => 'required|array',
    //         'texte.*'            => 'required|string',
    //     ]);

    //     $content = File::get($this->historiqueViewPath);

    //     $content = preg_replace_callback(
    //         '/(<p class="intro">\s*).*?(\s*<\/p>)/su',
    //         fn($m) => $m[1] . "\n" . e($request->intro) . "\n" . $m[2],
    //         $content
    //     );

    //     $timelineHtml = '';
    //     foreach ($request->annee as $i => $annee) {
    //         $texteRaw = $request->texte[$i] ?? '';
    //         $texteFormatted = nl2br(e($texteRaw));

    //         $timelineHtml .= "<div class=\"timeline-item\">\n";
    //         $timelineHtml .= "<span class=\"year\">" . e($annee) . "</span>\n";
    //         $timelineHtml .= "<p>" . $texteFormatted . "</p>\n";
    //         $timelineHtml .= "</div>\n\n";
    //     }

    //     $content = preg_replace_callback(
    //         '/(<div class="timeline">\s*).*?(\s*<\/div>\s*<\/div>\s*<\/div>\s*<\/section>)/su',
    //         fn($m) => $m[1] . "\n" . $timelineHtml . $m[2],
    //         $content
    //     );

    //     File::put($this->historiqueViewPath, $content);

    //     return redirect()
    //         ->route('historique')
    //         ->with('success', 'La page Historique a été mise à jour avec succès.');
    // }

    // ===================================================================
    //  MISSIONS & OBJECTIFS
    // ===================================================================

    public function missions()
    {
        if (!File::exists($this->missionsViewPath)) {
            abort(404, 'Fichier Missions introuvable : ' . $this->missionsViewPath);
        }

        $content = File::get($this->missionsViewPath);

        preg_match_all(
            '/<div class="mission-block">\s*<h2 class="section-subtitle">(.*?)<\/h2>\s*<div class="mission-grid">(.*?)<\/div>\s*<\/div>/su',
            $content,
            $mBlocks,
            PREG_SET_ORDER
        );

        $blocks = [];
        foreach ($mBlocks as $block) {
            preg_match_all(
                '/<div class="mission-card">\s*<div class="card-inner">\s*<div class="card-front"><h3>(.*?)<\/h3><\/div>\s*<div class="card-back"><p>(.*?)<\/p><\/div>\s*<\/div>\s*<\/div>/su',
                $block[2],
                $mCards,
                PREG_SET_ORDER
            );
            $cards = array_map(fn($c) => ['titre' => trim($c[1]), 'texte' => trim($c[2])], $mCards);
            $blocks[] = ['titre_section' => trim($block[1]), 'cards' => $cards];
        }

        $missionsCards  = $blocks[0]['cards'] ?? [];
        $objectifsCards = $blocks[1]['cards'] ?? [];

        $detectionOk = count($missionsCards) > 0 && count($objectifsCards) > 0;

        if (empty($missionsCards))  $missionsCards  = [['titre' => '', 'texte' => '']];
        if (empty($objectifsCards)) $objectifsCards = [['titre' => '', 'texte' => '']];

        $data = [
            'missions_titre'  => $blocks[0]['titre_section'] ?? 'Nos Missions',
            'missions_cards'  => $missionsCards,
            'objectifs_titre' => $blocks[1]['titre_section'] ?? 'Nos Objectifs',
            'objectifs_cards' => $objectifsCards,
            'detection_ok'    => $detectionOk,
        ];

        return view('Espace_admin.accueil.directeurgene.organisation.mission_et_objectif', $data);
    }

    public function missions_update(Request $request)
    {
        $request->validate([
            'missions_titre'          => 'required|string|max:255',
            'objectifs_titre'         => 'required|string|max:255',
            'missions_card_titre'     => 'required|array',
            'missions_card_titre.*'   => 'required|string|max:255',
            'missions_card_texte'     => 'required|array',
            'missions_card_texte.*'   => 'required|string',
            'objectifs_card_titre'    => 'required|array',
            'objectifs_card_titre.*'  => 'required|string|max:255',
            'objectifs_card_texte'    => 'required|array',
            'objectifs_card_texte.*'  => 'required|string',
        ]);

        $content = File::get($this->missionsViewPath);

        $buildGrid = function (array $titres, array $textes) {
            $html = '';
            foreach ($titres as $i => $titre) {
                $texte = $textes[$i] ?? '';
                $html .= "                    <div class=\"mission-card\">\n";
                $html .= "                        <div class=\"card-inner\">\n";
                $html .= "                            <div class=\"card-front\"><h3>" . e($titre) . "</h3></div>\n";
                $html .= "                            <div class=\"card-back\"><p>" . e($texte) . "</p></div>\n";
                $html .= "                        </div>\n";
                $html .= "                    </div>\n";
            }
            return $html;
        };

        $missionsGrid  = $buildGrid($request->missions_card_titre, $request->missions_card_texte);
        $objectifsGrid = $buildGrid($request->objectifs_card_titre, $request->objectifs_card_texte);

        $content = preg_replace_callback(
            '/(<h2 class="section-subtitle">)Nos Missions(<\/h2>\s*<div class="mission-grid">).*?(\s*<\/div>\s*<\/div>)/su',
            fn($m) => $m[1] . e($request->missions_titre) . $m[2] . "\n" . $missionsGrid . $m[3],
            $content
        );

        $content = preg_replace_callback(
            '/(<h2 class="section-subtitle">)Nos Objectifs(<\/h2>\s*<div class="mission-grid">).*?(\s*<\/div>\s*<\/div>)/su',
            fn($m) => $m[1] . e($request->objectifs_titre) . $m[2] . "\n" . $objectifsGrid . $m[3],
            $content
        );

        File::put($this->missionsViewPath, $content);

        return redirect()
            ->route('missions')
            ->with('success', 'La page Missions & Objectifs a été mise à jour avec succès.');
    }

    // ===================================================================
    //  ORGANIGRAMME
    // ===================================================================

    public function organigramme()
    {
        if (!File::exists($this->organigrammeViewPath)) {
            abort(404, 'Fichier Organigramme introuvable : ' . $this->organigrammeViewPath);
        }

        $content = File::get($this->organigrammeViewPath);

        preg_match('/<div class="box directeur">(.*?)<\/div>/su', $content, $mDirecteur);

        preg_match_all(
            '/<div class="box (?:sg|dpt)">(.*?)<\/div>\s*<ul>\s*<li><div class="box service">(.*?)<\/div><\/li>\s*<li><div class="box service">(.*?)<\/div><\/li>\s*<\/ul>/su',
            $content,
            $mDepts,
            PREG_SET_ORDER
        );
        $departements = array_map(fn($d) => [
            'nom'       => trim($d[1]),
            'service1'  => trim($d[2]),
            'service2'  => trim($d[3]),
        ], $mDepts);

        preg_match_all(
            '/<div class="pdf-item">\s*<p>(.*?)<\/p>\s*<a href="(.*?)" class="btn-pdf">(.*?)<\/a>\s*<\/div>/su',
            $content,
            $mPdfs,
            PREG_SET_ORDER
        );
        $pdfs = array_map(fn($p) => [
            'titre'    => trim($p[1]),
            'lien'     => trim($p[2]),
            'bouton'   => trim($p[3]),
        ], $mPdfs);

        if (empty($pdfs)) $pdfs = [['titre' => '', 'lien' => '#', 'bouton' => 'Voir le PDF']];

        $data = [
            'directeur_titre' => trim($mDirecteur[1] ?? 'Directeur Général'),
            'departements'    => $departements,
            'pdfs'            => $pdfs,
            'detection_ok'    => count($departements) > 0,
        ];

        return view('Espace_admin.accueil.directeurgene.organisation.organigrame', $data);
    }

    public function organigramme_update(Request $request)
    {
        $request->validate([
            'directeur_titre'   => 'required|string|max:255',
            'dept_nom'          => 'required|array',
            'dept_nom.*'        => 'required|string|max:255',
            'dept_service1'     => 'required|array',
            'dept_service1.*'   => 'required|string|max:255',
            'dept_service2'     => 'required|array',
            'dept_service2.*'   => 'required|string|max:255',
            'pdf_titre'         => 'required|array',
            'pdf_titre.*'       => 'required|string|max:255',
            'pdf_lien'          => 'required|array',
            'pdf_lien.*'        => 'nullable|string|max:500',
            'pdf_bouton'        => 'required|array',
            'pdf_bouton.*'      => 'required|string|max:100',
        ]);

        $content = File::get($this->organigrammeViewPath);

        $content = preg_replace_callback(
            '/(<div class="box directeur">).*?(<\/div>)/su',
            fn($m) => $m[1] . e($request->directeur_titre) . $m[2],
            $content
        );

        $index = 0;
        $deptNoms     = $request->dept_nom;
        $deptService1 = $request->dept_service1;
        $deptService2 = $request->dept_service2;

        $content = preg_replace_callback(
            '/(<div class="box (?:sg|dpt)">).*?(<\/div>\s*<ul>\s*<li><div class="box service">).*?(<\/div><\/li>\s*<li><div class="box service">).*?(<\/div><\/li>\s*<\/ul>)/su',
            function ($m) use ($deptNoms, $deptService1, $deptService2, &$index) {
                $nom = $deptNoms[$index] ?? '';
                $s1  = $deptService1[$index] ?? '';
                $s2  = $deptService2[$index] ?? '';
                $index++;
                return $m[1] . e($nom) . $m[2] . e($s1) . $m[3] . e($s2) . $m[4];
            },
            $content
        );

        $pdfHtml = '';
        foreach ($request->pdf_titre as $i => $titre) {
            $lien   = $request->pdf_lien[$i]   ?? '#';
            $bouton = $request->pdf_bouton[$i] ?? 'Voir le PDF';
            $pdfHtml .= "            <div class=\"pdf-item\">\n";
            $pdfHtml .= "                <p>" . e($titre) . "</p>\n";
            $pdfHtml .= "                <a href=\"" . e($lien) . "\" class=\"btn-pdf\">" . e($bouton) . "</a>\n";
            $pdfHtml .= "            </div>\n";
        }
        $content = preg_replace_callback(
            '/(<div class="pdf-list">\s*).*?(\s*<\/div>\s*<\/div>\s*<\/section>)/su',
            fn($m) => $m[1] . "\n" . $pdfHtml . $m[2],
            $content
        );

        File::put($this->organigrammeViewPath, $content);

        return redirect()
            ->route('organigramme')
            ->with('success', "L'organigramme a été mis à jour avec succès.");
    }

    // ===================================================================
    //  LOIS
    // ===================================================================

    public function lois()
    {
        if (!File::exists($this->loisViewPath)) {
            abort(404, 'Fichier Lois introuvable : ' . $this->loisViewPath);
        }

        $content = File::get($this->loisViewPath);

        preg_match_all(
            '/<tr class="law-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" class="btn-download-law"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $lois = array_map(fn($r) => [
            'mots_cles' => trim($r[1]),
            'reference' => trim($r[2]),
            'intitule'  => trim($r[3]),
            'lien'      => trim($r[4]),
        ], $mRows);

        if (empty($lois)) {
            $lois = [['mots_cles' => '', 'reference' => '', 'intitule' => '', 'lien' => '']];
        }

        $data = [
            'lois'         => $lois,
            'detection_ok' => count($lois) > 0 && $lois[0]['reference'] !== '',
        ];

        return view('Espace_admin.texte_nationnaux.lois', $data);
    }

    public function lois_update(Request $request)
    {
        $request->validate([
            'reference'       => 'required|array',
            'reference.*'     => 'required|string|max:255',
            'intitule'        => 'required|array',
            'intitule.*'      => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'loi_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = $request->mots_cles[$i] ?? strtolower($reference . ' ' . $intitule);
            $lien     = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"law-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($reference) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($intitule) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" class=\"btn-download-law\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->loisViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="lawBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->loisViewPath, $content);

        return redirect()
            ->route('lois')
            ->with('success', 'La page Lois et Règlements a été mise à jour avec succès.');
    }

    // ===================================================================
    //  DÉCRETS
    // ===================================================================

    public function decrets()
    {
        if (!File::exists($this->decretsViewPath)) {
            abort(404, 'Fichier Décrets introuvable : ' . $this->decretsViewPath);
        }

        $content = File::get($this->decretsViewPath);

        preg_match_all(
            '/<tr class="doc-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" download class="btn-download"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $decrets = array_map(fn($r) => [
            'mots_cles' => trim($r[1]),
            'titre'     => trim($r[2]),
            'description' => trim($r[3]),
            'lien'      => trim($r[4]),
        ], $mRows);

        if (empty($decrets)) {
            $decrets = [['mots_cles' => '', 'titre' => '', 'description' => '', 'lien' => '']];
        }

        $data = [
            'decrets'      => $decrets,
            'detection_ok' => count($decrets) > 0 && $decrets[0]['titre'] !== '',
        ];

        return view('Espace_admin.texte_nationnaux.decret', $data);
    }

    public function decrets_update(Request $request)
    {
        $request->validate([
            'titre'           => 'required|array',
            'titre.*'         => 'required|string|max:255',
            'description'     => 'required|array',
            'description.*'   => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'decret_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $description = $request->description[$i] ?? '';
            $motsCles    = $request->mots_cles[$i] ?? strtolower($titre . ' ' . $description);
            $lien        = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"doc-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($titre) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($description) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" download class=\"btn-download\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->decretsViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="decreeBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->decretsViewPath, $content);

        return redirect()
            ->route('decrets')
            ->with('success', 'La page Décrets & Arrêtés a été mise à jour avec succès.');
    }

    // ===================================================================
    //  ARRÊTÉS
    // ===================================================================

    public function arretes()
    {
        if (!File::exists($this->arretesViewPath)) {
            abort(404, 'Fichier Arrêtés introuvable : ' . $this->arretesViewPath);
        }

        $content = File::get($this->arretesViewPath);

        preg_match_all(
            '/<tr class="doc-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" download class="btn-download"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $arretes = array_map(fn($r) => [
            'mots_cles'   => trim($r[1]),
            'titre'       => trim($r[2]),
            'description' => trim($r[3]),
            'lien'        => trim($r[4]),
        ], $mRows);

        if (empty($arretes)) {
            $arretes = [['mots_cles' => '', 'titre' => '', 'description' => '', 'lien' => '']];
        }

        $data = [
            'arretes'      => $arretes,
            'detection_ok' => count($arretes) > 0 && $arretes[0]['titre'] !== '',
        ];

        return view('Espace_admin.texte_nationnaux.arrêté', $data);
    }

    public function arretes_update(Request $request)
    {
        $request->validate([
            'titre'           => 'required|array',
            'titre.*'         => 'required|string|max:255',
            'description'     => 'required|array',
            'description.*'   => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'arrete_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $description = $request->description[$i] ?? '';
            $motsCles    = $request->mots_cles[$i] ?? strtolower($titre . ' ' . $description);
            $lien        = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"doc-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($titre) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($description) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" download class=\"btn-download\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->arretesViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="arrestBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->arretesViewPath, $content);

        return redirect()
            ->route('arretes')
            ->with('success', 'La page Arrêtés de Décision a été mise à jour avec succès.');
    }

    // ===================================================================
    //  ACCORDS
    // ===================================================================

    public function accords()
    {
        if (!File::exists($this->accordsViewPath)) {
            abort(404, 'Fichier Accords introuvable : ' . $this->accordsViewPath);
        }

        $content = File::get($this->accordsViewPath);

        preg_match_all(
            '/<tr class="law-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" class="btn-download-law"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $accords = array_map(fn($r) => [
            'mots_cles' => trim($r[1]),
            'reference' => trim($r[2]),
            'intitule'  => trim($r[3]),
            'lien'      => trim($r[4]),
        ], $mRows);

        if (empty($accords)) {
            $accords = [['mots_cles' => '', 'reference' => '', 'intitule' => '', 'lien' => '']];
        }

        $data = [
            'accords'      => $accords,
            'detection_ok' => count($accords) > 0 && $accords[0]['reference'] !== '',
        ];

        return view('Espace_admin.texte_internationnaux.accord', $data);
    }

    public function accords_update(Request $request)
    {
        $request->validate([
            'reference'       => 'required|array',
            'reference.*'     => 'required|string|max:255',
            'intitule'        => 'required|array',
            'intitule.*'      => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'accord_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = $request->mots_cles[$i] ?? strtolower($reference . ' ' . $intitule);
            $lien     = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"law-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($reference) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($intitule) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" class=\"btn-download-law\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->accordsViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="lawBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->accordsViewPath, $content);

        return redirect()
            ->route('accords')
            ->with('success', 'La page Accords DGAM a été mise à jour avec succès.');
    }

    // ===================================================================
    //  CONVENTIONS
    // ===================================================================

    public function conventions()
    {
        if (!File::exists($this->conventionsViewPath)) {
            abort(404, 'Fichier Conventions introuvable : ' . $this->conventionsViewPath);
        }

        $content = File::get($this->conventionsViewPath);

        preg_match_all(
            '/<tr class="doc-row" data-title="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td><span class="badge-pdf">(.*?)<\/span><\/td>\s*<td class="text-right"><a href="(.*?)" class="btn-download" download="(.*?)">\s*📥 Télécharger\s*<\/a><\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $conventions = array_map(fn($r) => [
            'mots_cles'     => trim($r[1]),
            'titre'         => trim($r[2]),
            'description'   => trim($r[3]),
            'format'        => trim($r[4]),
            'lien'          => trim($r[5]),
            'nom_fichier'   => trim($r[6]),
        ], $mRows);

        if (empty($conventions)) {
            $conventions = [['mots_cles' => '', 'titre' => '', 'description' => '', 'format' => 'PDF', 'lien' => '', 'nom_fichier' => '']];
        }

        $data = [
            'conventions'  => $conventions,
            'detection_ok' => count($conventions) > 0 && $conventions[0]['titre'] !== '',
        ];

        return view('Espace_admin.texte_internationnaux.convention', $data);
    }

    public function conventions_update(Request $request)
    {
        $request->validate([
            'titre'           => 'required|array',
            'titre.*'         => 'required|string|max:255',
            'description'     => 'required|array',
            'description.*'   => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'format'          => 'required|array',
            'format.*'        => 'required|string|max:20',
            'nom_fichier'     => 'required|array',
            'nom_fichier.*'   => 'required|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'convention_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $description = $request->description[$i] ?? '';
            $motsCles    = $request->mots_cles[$i] ?? strtolower($titre);
            $format      = $request->format[$i] ?? 'PDF';
            $nomFichier  = $request->nom_fichier[$i] ?? 'document.pdf';
            $lien        = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"doc-row\" data-title=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($titre) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($description) . "</td>\n";
            $rowsHtml .= "                        <td><span class=\"badge-pdf\">" . e($format) . "</span></td>\n";
            $rowsHtml .= "                        <td class=\"text-right\"><a href=\"" . e($lien) . "\" class=\"btn-download\" download=\"" . e($nomFichier) . "\">📥 Télécharger</a></td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->conventionsViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="docBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->conventionsViewPath, $content);

        return redirect()
            ->route('conventions')
            ->with('success', 'La page Convention DGAM a été mise à jour avec succès.');
    }

    // ===================================================================
    //  PROTOCOLES
    // ===================================================================

    public function protocoles()
    {
        if (!File::exists($this->protocolesViewPath)) {
            abort(404, 'Fichier Protocoles introuvable : ' . $this->protocolesViewPath);
        }

        $content = File::get($this->protocolesViewPath);

        preg_match_all(
            '/<tr class="law-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" class="btn-download-law"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $protocoles = array_map(fn($r) => [
            'mots_cles' => trim($r[1]),
            'reference' => trim($r[2]),
            'intitule'  => trim($r[3]),
            'lien'      => trim($r[4]),
        ], $mRows);

        if (empty($protocoles)) {
            $protocoles = [['mots_cles' => '', 'reference' => '', 'intitule' => '', 'lien' => '']];
        }

        $data = [
            'protocoles'   => $protocoles,
            'detection_ok' => count($mRows) > 0,
        ];

        return view('Espace_admin.texte_internationnaux.protocole', $data);
    }

    public function protocoles_update(Request $request)
    {
        $request->validate([
            'reference'       => 'required|array',
            'reference.*'     => 'required|string|max:255',
            'intitule'        => 'required|array',
            'intitule.*'      => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'protocole_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = $request->mots_cles[$i] ?? strtolower($reference . ' ' . $intitule);
            $lien     = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"law-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($reference) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($intitule) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" class=\"btn-download-law\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->protocolesViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="lawBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->protocolesViewPath, $content);

        return redirect()
            ->route('protocoles')
            ->with('success', 'La page Protocole DGAM a été mise à jour avec succès.');
    }

    // ===================================================================
    //  ÉVÉNEMENTS
    // ===================================================================

    public function evenements()
    {
        $passes = [];
        $passesOk = false;
        if (File::exists($this->evenementsPassesViewPath)) {
            $content = File::get($this->evenementsPassesViewPath);
            preg_match_all(
                '/<div class="event-card" data-category="(.*?)">\s*<div class="event-image">\s*<img src="(.*?)" alt="(.*?)">\s*<div class="event-date">(.*?)<\/div>\s*<\/div>\s*<div class="event-content">\s*<h3>(.*?)<\/h3>\s*<p>(.*?)<\/p>\s*<span class="event-tag">(.*?)<\/span>\s*<\/div>\s*<\/div>/su',
                $content,
                $mPasses,
                PREG_SET_ORDER
            );
            $passes = array_map(fn($m) => [
                'categorie'  => trim($m[1]),
                'image'      => trim($m[2]),
                'alt'        => trim($m[3]),
                'date'       => trim($m[4]),
                'titre'      => trim($m[5]),
                'description'=> trim($m[6]),
                'tag'        => trim($m[7]),
            ], $mPasses);
            $passesOk = count($passes) > 0;
        }
        if (empty($passes)) {
            $passes = [['categorie' => '', 'image' => '', 'alt' => '', 'date' => '', 'titre' => '', 'description' => '', 'tag' => '']];
        }

        $avenir = [];
        $avenirOk = false;
        if (File::exists($this->evenementsAvenirViewPath)) {
            $content = File::get($this->evenementsAvenirViewPath);
            preg_match_all(
                '/<div class="event-card" data-category="(.*?)">\s*<div class="event-date">\s*<span class="day">(.*?)<\/span>\s*<span class="month">(.*?)<\/span>\s*<\/div>\s*<div class="event-body">\s*<span class="category-tag">(.*?)<\/span>\s*<h3>(.*?)<\/h3>\s*<p><i class="fas fa-map-marker-alt"><\/i>\s*(.*?)<\/p>\s*<p><i class="far fa-clock"><\/i>\s*(.*?)<\/p>\s*<a href="(.*?)" class="btn-more">Détails<\/a>\s*<\/div>\s*<\/div>/su',
                $content,
                $mAvenir,
                PREG_SET_ORDER
            );
            $avenir = array_map(fn($m) => [
                'categorie'   => trim($m[1]),
                'jour'        => trim($m[2]),
                'mois'        => trim($m[3]),
                'tag'         => trim($m[4]),
                'titre'       => trim($m[5]),
                'lieu'        => trim($m[6]),
                'horaire'     => trim($m[7]),
                'lien'        => trim($m[8]),
            ], $mAvenir);
            $avenirOk = count($avenir) > 0;
        }
        if (empty($avenir)) {
            $avenir = [['categorie' => '', 'jour' => '', 'mois' => '', 'tag' => '', 'titre' => '', 'lieu' => '', 'horaire' => '', 'lien' => '#']];
        }

        return view('Espace_admin.évenement', [
            'passes'     => $passes,
            'passes_ok'  => $passesOk,
            'avenir'     => $avenir,
            'avenir_ok'  => $avenirOk,
        ]);
    }

    public function evenements_passes_update(Request $request)
    {
        $request->validate([
            'categorie'    => 'required|array',
            'categorie.*'  => 'required|string|max:100',
            'titre'        => 'required|array',
            'titre.*'      => 'required|string|max:255',
            'description'  => 'required|array',
            'description.*'=> 'required|string',
            'date'         => 'required|array',
            'date.*'       => 'required|string|max:100',
            'tag'          => 'required|array',
            'tag.*'        => 'required|string|max:100',
            'image_actuelle' => 'required|array',
            'image'        => 'nullable|array',
            'image.*'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $images = $request->image_actuelle;
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $i => $file) {
                if ($file) {
                    $filename = 'event_passe_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $images[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $cardsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $cat   = $request->categorie[$i]   ?? '';
            $desc  = $request->description[$i] ?? '';
            $date  = $request->date[$i]        ?? '';
            $tag   = $request->tag[$i]         ?? '';
            $image = $images[$i]               ?? '';

            $cardsHtml .= "            <div class=\"event-card\" data-category=\"" . e($cat) . "\">\n";
            $cardsHtml .= "                <div class=\"event-image\">\n";
            $cardsHtml .= "                    <img src=\"" . e($image) . "\" alt=\"" . e($titre) . "\">\n";
            $cardsHtml .= "                    <div class=\"event-date\">" . e($date) . "</div>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "                <div class=\"event-content\">\n";
            $cardsHtml .= "                    <h3>" . e($titre) . "</h3>\n";
            $cardsHtml .= "                    <p>" . e($desc) . "</p>\n";
            $cardsHtml .= "                    <span class=\"event-tag\">" . e($tag) . "</span>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "            </div>\n\n";
        }

        $content = File::get($this->evenementsPassesViewPath);
        $content = preg_replace_callback(
            '/(<div class="events-grid" id="eventsGrid">\s*).*?(\s*<\/div>\s*<\/div>\s*<\/section>)/su',
            fn($m) => $m[1] . "\n" . $cardsHtml . $m[2],
            $content
        );
        File::put($this->evenementsPassesViewPath, $content);

        return redirect()
            ->route('evenements')
            ->with('success', 'Les événements passés ont été mis à jour avec succès.');
    }

    public function evenements_avenir_update(Request $request)
    {
        $request->validate([
            'categorie'  => 'required|array',
            'categorie.*'=> 'required|string|max:100',
            'jour'       => 'required|array',
            'jour.*'     => 'required|string|max:10',
            'mois'       => 'required|array',
            'mois.*'     => 'required|string|max:20',
            'tag'        => 'required|array',
            'tag.*'      => 'required|string|max:100',
            'titre'      => 'required|array',
            'titre.*'    => 'required|string|max:255',
            'lieu'       => 'required|array',
            'lieu.*'     => 'required|string|max:255',
            'horaire'    => 'required|array',
            'horaire.*'  => 'required|string|max:100',
            'lien'       => 'nullable|array',
            'lien.*'     => 'nullable|string|max:500',
        ]);

        $cardsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $cat     = $request->categorie[$i] ?? '';
            $jour    = $request->jour[$i]      ?? '';
            $mois    = $request->mois[$i]      ?? '';
            $tag     = $request->tag[$i]       ?? '';
            $lieu    = $request->lieu[$i]      ?? '';
            $horaire = $request->horaire[$i]   ?? '';
            $lien    = $request->lien[$i]      ?? '#';

            $cardsHtml .= "            <div class=\"event-card\" data-category=\"" . e($cat) . "\">\n";
            $cardsHtml .= "                <div class=\"event-date\">\n";
            $cardsHtml .= "                    <span class=\"day\">" . e($jour) . "</span>\n";
            $cardsHtml .= "                    <span class=\"month\">" . e($mois) . "</span>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "                <div class=\"event-body\">\n";
            $cardsHtml .= "                    <span class=\"category-tag\">" . e($tag) . "</span>\n";
            $cardsHtml .= "                    <h3>" . e($titre) . "</h3>\n";
            $cardsHtml .= "                    <p><i class=\"fas fa-map-marker-alt\"></i> " . e($lieu) . "</p>\n";
            $cardsHtml .= "                    <p><i class=\"far fa-clock\"></i> " . e($horaire) . "</p>\n";
            $cardsHtml .= "                    <a href=\"" . e($lien) . "\" class=\"btn-more\">Détails</a>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "            </div>\n\n";
        }

        $content = File::get($this->evenementsAvenirViewPath);
        $content = preg_replace_callback(
            '/(<div class="events-grid" id="eventsGrid">\s*).*?(\s*<\/div>\s*<\/div>\s*<\/section>)/su',
            fn($m) => $m[1] . "\n" . $cardsHtml . $m[2],
            $content
        );
        File::put($this->evenementsAvenirViewPath, $content);

        return redirect()
            ->route('evenements')
            ->with('success', 'Les événements à venir ont été mis à jour avec succès.');
    }

    // ===================================================================
    //  ENA
    // ===================================================================

    public function ena()
    {
        if (!File::exists($this->enaViewPath)) {
            abort(404, 'Fichier ENA introuvable : ' . $this->enaViewPath);
        }

        $content = File::get($this->enaViewPath);

        preg_match_all(
            '/<tr class="law-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" class="btn-download-law"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $ena = array_map(fn($r) => [
            'mots_cles' => trim($r[1]),
            'reference' => trim($r[2]),
            'intitule'  => trim($r[3]),
            'lien'      => trim($r[4]),
        ], $mRows);

        if (empty($ena)) {
            $ena = [['mots_cles' => '', 'reference' => '', 'intitule' => '', 'lien' => '']];
        }

        $data = [
            'ena'          => $ena,
            'detection_ok' => count($ena) > 0 && $ena[0]['reference'] !== '',
        ];

        return view('Espace_admin.recrutement.ena', $data);
    }

    public function ena_update(Request $request)
    {
        $request->validate([
            'reference'       => 'required|array',
            'reference.*'     => 'required|string|max:255',
            'intitule'        => 'required|array',
            'intitule.*'      => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'ena_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = $request->mots_cles[$i] ?? strtolower($reference . ' ' . $intitule);
            $lien     = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"law-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($reference) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($intitule) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" class=\"btn-download-law\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->enaViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="lawBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->enaViewPath, $content);

        return redirect()
            ->route('ena')
            ->with('success', 'La page ENA a été mise à jour avec succès.');
    }

    // ===================================================================
    //  FONCTION PUBLIQUE
    // ===================================================================

    public function fonctionPublique()
    {
        if (!File::exists($this->fonctionPubliqueViewPath)) {
            abort(404, 'Fichier Fonction Publique introuvable : ' . $this->fonctionPubliqueViewPath);
        }

        $content = File::get($this->fonctionPubliqueViewPath);

        preg_match_all(
            '/<tr class="law-row" data-search="(.*?)">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td>\s*<a href="(.*?)" class="btn-download-law"[^>]*>\s*📥 Télécharger\s*<\/a>\s*<\/td>\s*<\/tr>/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $documents = array_map(fn($r) => [
            'mots_cles' => trim($r[1]),
            'reference' => trim($r[2]),
            'intitule'  => trim($r[3]),
            'lien'      => trim($r[4]),
        ], $mRows);

        if (empty($documents)) {
            $documents = [['mots_cles' => '', 'reference' => '', 'intitule' => '', 'lien' => '']];
        }

        $data = [
            'documents'    => $documents,
            'detection_ok' => count($mRows) > 0,
        ];

        return view('Espace_admin.recrutement.fonction_publique', $data);
    }

    public function fonctionPublique_update(Request $request)
    {
        $request->validate([
            'reference'       => 'required|array',
            'reference.*'     => 'required|string|max:255',
            'intitule'        => 'required|array',
            'intitule.*'      => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'fonction_publique_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = $request->mots_cles[$i] ?? strtolower($reference . ' ' . $intitule);
            $lien     = $liens[$i] ?? '#';

            $rowsHtml .= "                    <tr class=\"law-row\" data-search=\"" . e($motsCles) . "\">\n";
            $rowsHtml .= "                        <td><strong>" . e($reference) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($intitule) . "</td>\n";
            $rowsHtml .= "                        <td>\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" class=\"btn-download-law\" target=\"_blank\">\n";
            $rowsHtml .= "                                📥 Télécharger\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->fonctionPubliqueViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="lawBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->fonctionPubliqueViewPath, $content);

        return redirect()
            ->route('fonction-publique')
            ->with('success', 'La page Fonction Publique a été mise à jour avec succès.');
    }

    // ===================================================================
    //  GALERIE PHOTOS
    // ===================================================================

    public function galerie()
    {
        if (!File::exists($this->galerieViewPath)) {
            abort(404, 'Fichier Galerie introuvable : ' . $this->galerieViewPath);
        }

        $content = File::get($this->galerieViewPath);

        preg_match_all(
            '/<div class="album-card" onclick="openAlbum\(\'(.*?)\',\s*\'(.*?)\',\s*\'(.*?)\'\)">\s*<div class="album-cover">\s*<img src="(.*?)" alt="Couverture">\s*<div class="album-badge">(.*?)<\/div>\s*<\/div>\s*<div class="album-info">\s*<h3>(.*?)<\/h3>\s*<p>(.*?)<\/p>\s*<\/div>\s*<\/div>/su',
            $content,
            $mCards,
            PREG_SET_ORDER
        );

        preg_match('/const albumData = \{(.*?)\};/su', $content, $mData);
        $photosParAlbum = [];
        if (!empty($mData[1])) {
            preg_match_all(
                "/'([\\w-]+)':\\s*\\[(.*?)\\]/su",
                $mData[1],
                $mAlbumsPhotos,
                PREG_SET_ORDER
            );
            foreach ($mAlbumsPhotos as $a) {
                $id = $a[1];
                preg_match_all("/'(.*?)'/", $a[2], $mPhotos);
                $photosParAlbum[$id] = $mPhotos[1] ?? [];
            }
        }

        $albums = array_map(function ($c) use ($photosParAlbum) {
            $id = trim($c[1]);
            return [
                'id'         => $id,
                'popup_titre'=> trim($c[2]),
                'popup_sous' => trim($c[3]),
                'cover'      => trim($c[4]),
                'badge'      => trim($c[5]),
                'titre'      => trim($c[6]),
                'date'       => trim($c[7]),
                'photos'     => $photosParAlbum[$id] ?? [],
            ];
        }, $mCards);

        if (empty($albums)) {
            $albums = [[
                'id' => '', 'popup_titre' => '', 'popup_sous' => '', 'cover' => '',
                'badge' => '', 'titre' => '', 'date' => '', 'photos' => [],
            ]];
        }

        $data = [
            'albums'       => $albums,
            'detection_ok' => count($mCards) > 0,
        ];

        return view('Espace_admin.multimedia.image', $data);
    }

    public function galerie_update(Request $request)
    {
        $request->validate([
            'album_id'          => 'required|array',
            'album_id.*'        => 'required|string|max:100|alpha_dash',
            'titre'             => 'required|array',
            'titre.*'           => 'required|string|max:500',
            'date'              => 'required|array',
            'date.*'            => 'required|string|max:100',
            'popup_titre'       => 'required|array',
            'popup_titre.*'     => 'required|string|max:255',
            'popup_sous'        => 'required|array',
            'popup_sous.*'      => 'required|string|max:255',
            'cover_actuelle'    => 'required|array',
            'cover'             => 'nullable|array',
            'cover.*'           => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'photos_actuelles'  => 'required|array',
            'nouvelles_photos'  => 'nullable|array',
            'nouvelles_photos.*'=> 'nullable|array',
            'nouvelles_photos.*.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $covers = $request->cover_actuelle;
        if ($request->hasFile('cover')) {
            foreach ($request->file('cover') as $i => $file) {
                if ($file) {
                    $filename = 'album_cover_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $covers[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $cardsHtml = '';
        $albumDataJs = '';

        foreach ($request->album_id as $i => $albumId) {
            $titre       = $request->titre[$i] ?? '';
            $date        = $request->date[$i] ?? '';
            $popupTitre  = $request->popup_titre[$i] ?? '';
            $popupSous   = $request->popup_sous[$i] ?? '';
            $badge       = ($request->badge[$i] ?? '0') . ' Photos';
            $cover       = $covers[$i] ?? '';

            $photosExistantes = json_decode($request->photos_actuelles[$i] ?? '[]', true) ?: [];

            $nouvellesPhotos = [];
            if ($request->hasFile("nouvelles_photos.$i")) {
                foreach ($request->file("nouvelles_photos")[$i] ?? [] as $j => $file) {
                    if ($file) {
                        $filename = 'album_photo_' . time() . '_' . $i . '_' . $j . '.' . $file->extension();
                        $file->move(public_path('assets/images'), $filename);
                        $nouvellesPhotos[] = 'assets/images/' . $filename;
                    }
                }
            }

            $toutesPhotos = array_merge($photosExistantes, $nouvellesPhotos);

            $cardsHtml .= "        <div class=\"album-card\" onclick=\"openAlbum('" . e($albumId) . "', '" . e($popupTitre) . "', '" . e($popupSous) . "')\">\n";
            $cardsHtml .= "            <div class=\"album-cover\">\n";
            $cardsHtml .= "                <img src=\"" . e($cover) . "\" alt=\"Couverture\">\n";
            $cardsHtml .= "                <div class=\"album-badge\">" . e($badge) . "</div>\n";
            $cardsHtml .= "            </div>\n";
            $cardsHtml .= "            <div class=\"album-info\">\n";
            $cardsHtml .= "                <h3>" . e($titre) . "</h3>\n";
            $cardsHtml .= "                <p>" . e($date) . "</p>\n";
            $cardsHtml .= "            </div>\n";
            $cardsHtml .= "        </div>\n\n";

            $photosJs = implode(', ', array_map(fn($p) => "'" . addslashes($p) . "'", $toutesPhotos));
            $albumDataJs .= "    '" . addslashes($albumId) . "': [" . $photosJs . "],\n";
        }

        $content = File::get($this->galerieViewPath);

        $content = preg_replace_callback(
            '/(<div id="albumsGrid" class="album-grid">\s*).*?(\s*<\/div>\s*<div id="photosView")/su',
            fn($m) => $m[1] . "\n" . $cardsHtml . $m[2],
            $content
        );

        $content = preg_replace_callback(
            '/(const albumData = \{\s*).*?(\s*\};)/su',
            fn($m) => $m[1] . "\n" . $albumDataJs . $m[2],
            $content
        );

        File::put($this->galerieViewPath, $content);

        return redirect()
            ->route('galerie')
            ->with('success', 'La galerie a été mise à jour avec succès.');
    }

    // ===================================================================
    //  VIDÉOS
    // ===================================================================

    public function videos()
    {
        if (!File::exists($this->videosViewPath)) {
            abort(404, 'Fichier Vidéos introuvable : ' . $this->videosViewPath);
        }

        $content = File::get($this->videosViewPath);

        preg_match('/<div class="gallery-grid" id="videoGrid">(.*?)<\/div>\s*<\/div>\s*<div class="pagination-container">/su', $content, $mGrid);
        $gridContent = $mGrid[1] ?? '';

        $chunks = preg_split('/(?=<div class="video-card-v2">)/', $gridContent);

        $videos = [];
        foreach ($chunks as $chunk) {
            if (!str_contains($chunk, 'video-card-v2')) continue;

            preg_match('/src="(.*?)"/', $chunk, $mSrc);
            preg_match('/<h3>(.*?)<\/h3>/su', $chunk, $mTitre);

            if (!empty($mSrc[1])) {
                $videos[] = [
                    'url'   => trim($mSrc[1]),
                    'titre' => trim($mTitre[1] ?? ''),
                ];
            }
        }

        if (empty($videos)) {
            $videos = [['url' => '', 'titre' => '']];
        }

        $data = [
            'videos'       => $videos,
            'detection_ok' => count($videos) > 0 && $videos[0]['url'] !== '',
        ];

        return view('Espace_admin.multimedia.video', $data);
    }

    public function videos_update(Request $request)
    {
        $request->validate([
            'url'       => 'required|array',
            'url.*'     => 'required|string|max:500',
            'titre'     => 'required|array',
            'titre.*'   => 'required|string|max:500',
        ]);

        $cardsHtml = '';
        foreach ($request->url as $i => $url) {
            $titre = $request->titre[$i] ?? '';

            $cardsHtml .= "            <div class=\"video-card-v2\">\n";
            $cardsHtml .= "                <div class=\"video-preview\">\n";
            $cardsHtml .= "                    <iframe width=\"100%\" height=\"100%\" src=\"" . e($url) . "\" allowfullscreen></iframe>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "                <div class=\"video-details\">\n";
            $cardsHtml .= "                    <h3>" . e($titre) . "</h3>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "            </div>\n\n";
        }

        $content = File::get($this->videosViewPath);

        $content = preg_replace_callback(
            '/(<div class="gallery-grid" id="videoGrid">\s*).*?(\s*<\/div>\s*<\/div>\s*<div class="pagination-container">)/su',
            fn($m) => $m[1] . "\n" . $cardsHtml . $m[2],
            $content
        );

        File::put($this->videosViewPath, $content);

        return redirect()
            ->route('videos')
            ->with('success', 'La page Vidéos a été mise à jour avec succès.');
    }

    // ===================================================================
    //  ACTUALITÉS
    // ===================================================================

    public function actualites()
    {
        if (!File::exists($this->actualitesViewPath)) {
            abort(404, 'Fichier Actualités introuvable : ' . $this->actualitesViewPath);
        }

        $content = File::get($this->actualitesViewPath);

        preg_match_all(
            '/<article class="news-card">\s*<div class="news-image">\s*<img src="(.*?)"\s*alt="(.*?)">\s*<span class="news-date">(.*?)<\/span>\s*<\/div>\s*<div class="news-body">\s*<span class="news-category">(.*?)<\/span>\s*<h3 class="news-card-title">\s*(.*?)<\/h3>\s*<p class="news-excerpt">(.*?)<\/p>\s*<a href="(.*?)" class="btn-read-more">Lire la suite/su',
            $content,
            $mArticles,
            PREG_SET_ORDER
        );

        $articles = array_map(fn($a) => [
            'image'      => trim($a[1]),
            'alt'        => trim($a[2]),
            'date'       => trim($a[3]),
            'categorie'  => trim($a[4]),
            'titre'      => trim($a[5]),
            'extrait'    => trim($a[6]),
            'lien'       => trim($a[7]),
        ], $mArticles);

        if (empty($articles)) {
            $articles = [['image' => '', 'alt' => '', 'date' => '', 'categorie' => '', 'titre' => '', 'extrait' => '', 'lien' => '#']];
        }

        $data = [
            'articles'     => $articles,
            'detection_ok' => count($articles) > 0 && $articles[0]['titre'] !== '',
        ];

        return view('Espace_admin.communication.actualité', $data);
    }

    public function actualites_update(Request $request)
    {
        $request->validate([
            'titre'             => 'required|array',
            'titre.*'           => 'required|string|max:500',
            'extrait'           => 'required|array',
            'extrait.*'         => 'required|string',
            'date'              => 'required|array',
            'date.*'            => 'required|string|max:100',
            'categorie'         => 'required|array',
            'categorie.*'       => 'required|string|max:100',
            'lien'              => 'nullable|array',
            'lien.*'            => 'nullable|string|max:500',
            'image_actuelle'    => 'required|array',
            'image'             => 'nullable|array',
            'image.*'           => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $images = $request->image_actuelle;
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $i => $file) {
                if ($file) {
                    $filename = 'actu_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $images[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $cardsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $extrait   = $request->extrait[$i]   ?? '';
            $date      = $request->date[$i]      ?? '';
            $categorie = $request->categorie[$i] ?? '';
            $lien      = $request->lien[$i]      ?? '#';
            $image     = $images[$i]             ?? '';

            $cardsHtml .= "            <article class=\"news-card\">\n";
            $cardsHtml .= "                <div class=\"news-image\">\n";
            $cardsHtml .= "                    <img src=\"" . e($image) . "\" alt=\"" . e($titre) . "\">\n";
            $cardsHtml .= "                    <span class=\"news-date\">" . e($date) . "</span>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "                <div class=\"news-body\">\n";
            $cardsHtml .= "                    <span class=\"news-category\">" . e($categorie) . "</span>\n";
            $cardsHtml .= "                    <h3 class=\"news-card-title\"> " . e($titre) . "</h3>\n";
            $cardsHtml .= "                    <p class=\"news-excerpt\">" . e($extrait) . "</p>\n";
            $cardsHtml .= "                    <a href=\"" . e($lien) . "\" class=\"btn-read-more\">Lire la suite <span>→</span></a>\n";
            $cardsHtml .= "                </div>\n";
            $cardsHtml .= "            </article>\n\n";
        }

        $content = File::get($this->actualitesViewPath);

        $content = preg_replace_callback(
            '/(<div class="news-grid" id="newsContainer">\s*).*?(\s*<\/div>\s*<div id="noResults")/su',
            fn($m) => $m[1] . "\n" . $cardsHtml . $m[2],
            $content
        );

        File::put($this->actualitesViewPath, $content);

        return redirect()
            ->route('actualites')
            ->with('success', 'Les actualités ont été mises à jour avec succès.');
    }

    // ===================================================================
    //  COMMUNIQUÉS
    // ===================================================================

    public function communiques()
    {
        if (!File::exists($this->communiquesViewPath)) {
            abort(404, 'Fichier Communiqués introuvable : ' . $this->communiquesViewPath);
        }

        $content = File::get($this->communiquesViewPath);

        preg_match_all(
            '/<tr class="doc-row">\s*<td><strong>(.*?)<\/strong><\/td>\s*<td>(.*?)<\/td>\s*<td><span class="badge-pdf">(.*?)<\/span><\/td>\s*<td class="text-right">\s*<a href="(.*?)" class="btn-download"[^>]*>\s*Télécharger/su',
            $content,
            $mRows,
            PREG_SET_ORDER
        );

        $communiques = array_map(fn($r) => [
            'titre'       => trim($r[1]),
            'description' => trim($r[2]),
            'format'      => trim($r[3]),
            'lien'        => trim($r[4]),
        ], $mRows);

        if (empty($communiques)) {
            $communiques = [['titre' => '', 'description' => '', 'format' => 'PDF', 'lien' => '#']];
        }

        $data = [
            'communiques'  => $communiques,
            'detection_ok' => count($communiques) > 0 && $communiques[0]['titre'] !== '',
        ];

        return view('Espace_admin.communication.communiqué', $data);
    }

    public function communiques_update(Request $request)
    {
        $request->validate([
            'titre'           => 'required|array',
            'titre.*'         => 'required|string|max:500',
            'description'     => 'required|array',
            'description.*'   => 'required|string|max:500',
            'format'          => 'required|array',
            'format.*'        => 'required|string|max:20',
            'lien'            => 'required|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien;

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'communique_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $rowsHtml = '';
        foreach ($request->titre as $i => $titre) {
            $description = $request->description[$i] ?? '';
            $format      = $request->format[$i]      ?? 'PDF';
            $lien        = $liens[$i]                 ?? '#';

            $rowsHtml .= "                    <tr class=\"doc-row\">\n";
            $rowsHtml .= "                        <td><strong>" . e($titre) . "</strong></td>\n";
            $rowsHtml .= "                        <td>" . e($description) . "</td>\n";
            $rowsHtml .= "                        <td><span class=\"badge-pdf\">" . e($format) . "</span></td>\n";
            $rowsHtml .= "                        <td class=\"text-right\">\n";
            $rowsHtml .= "                            <a href=\"" . e($lien) . "\" class=\"btn-download\" download>\n";
            $rowsHtml .= "                                Télécharger <span class=\"download-icon\">📥</span>\n";
            $rowsHtml .= "                            </a>\n";
            $rowsHtml .= "                        </td>\n";
            $rowsHtml .= "                    </tr>\n\n";
        }

        $content = File::get($this->communiquesViewPath);

        $content = preg_replace_callback(
            '/(<tbody id="docBody">\s*).*?(\s*<\/tbody>)/su',
            fn($m) => $m[1] . "\n" . $rowsHtml . $m[2],
            $content
        );

        File::put($this->communiquesViewPath, $content);

        return redirect()
            ->route('communiques')
            ->with('success', 'La page Communiqué DGAMP a été mise à jour avec succès.');
    }

    // ===================================================================
    //  NOS ACTIVITÉS (8 sections regroupées, avec onglets)
    // ===================================================================

    public function activites()
    {
        $sections = [];

        foreach ($this->activitesSections as $key => $config) {
            $fullPath = resource_path('views/' . $config['path']);
            $exists   = File::exists($fullPath);

            $data = [
                'key'       => $key,
                'label'     => $config['label'],
                'main_type' => 'paragraphe',
                'image'     => '',
                'badge'     => '',
                'titre'     => '',
                'liste'     => [],
                'paragraphe'=> '',
                'extra'     => '',
                'tables'    => [],
                'ok'        => false,
            ];

            if ($exists) {
                $content = File::get($fullPath);

                preg_match('/<img src="\{\{ asset\(\'(.*?)\'\) \}\}" alt="[^"]*" id="parallax-img-surete">/', $content, $mImg);
                preg_match('/<span class="law-ref">(.*?)<\/span>/su', $content, $mBadge);
                preg_match('/<h2>(.*?)<\/h2>/su', $content, $mTitre);

                $data['image'] = trim($mImg[1] ?? '');
                $data['badge'] = trim($mBadge[1] ?? '');
                $data['titre'] = trim($mTitre[1] ?? '');

                if (preg_match('/<ul class="main-list">(.*?)<\/ul>/su', $content, $mUl)) {
                    $data['main_type'] = 'liste';
                    preg_match_all('/<li>(.*?)<\/li>/su', $mUl[1], $mLi);
                    $data['liste'] = array_map('trim', $mLi[1] ?? []);
                } elseif (preg_match('/<p class="main-text">(.*?)<\/p>/su', $content, $mP)) {
                    $data['main_type']  = 'paragraphe';
                    $data['paragraphe'] = trim($mP[1]);
                }

                preg_match('/<div class="article-highlight">\s*<p>\s*(.*?)\s*<\/p>/su', $content, $mExtra);
                $data['extra'] = trim(str_replace(['<br>', '<br/>', '<br />'], "\n", $mExtra[1] ?? ''));

                preg_match_all(
                    '/<h4 class="table-title"[^>]*>(.*?)<\/h4>\s*<div class="table-responsive">\s*<table class="custom-sar-table">\s*<thead>\s*<tr>\s*<th>Cause<\/th>\s*<th>(.*?)<\/th>\s*<th>(.*?)<\/th>\s*<th>(.*?)<\/th>\s*<\/tr>\s*<\/thead>\s*<tbody>(.*?)<\/tbody>\s*<tfoot>\s*<tr class="row-total"><td>Total<\/td><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><\/tr>/su',
                    $content,
                    $mTables,
                    PREG_SET_ORDER
                );

                foreach ($mTables as $t) {
                    preg_match_all(
                        '/<tr(?:\s+class="row-others")?><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><\/tr>/su',
                        $t[5],
                        $mRows,
                        PREG_SET_ORDER
                    );
                    $rows = array_map(fn($r) => [
                        'cause' => trim($r[1]),
                        'v1'    => trim($r[2]),
                        'v2'    => trim($r[3]),
                        'v3'    => trim($r[4]),
                    ], $mRows);

                    $data['tables'][] = [
                        'titre'  => trim($t[1]),
                        'annees' => [trim($t[2]), trim($t[3]), trim($t[4])],
                        'rows'   => $rows,
                        'total'  => [trim($t[6]), trim($t[7]), trim($t[8])],
                    ];
                }

                $data['ok'] = !empty($data['titre']);
            }

            $sections[$key] = $data;
        }

        return view('Espace_admin.activité', ['sections' => $sections]);
    }

    public function activites_update(Request $request, string $section)
    {
        if (!isset($this->activitesSections[$section])) {
            abort(404, 'Section inconnue : ' . $section);
        }

        $config   = $this->activitesSections[$section];
        $fullPath = resource_path('views/' . $config['path']);
        $mainType = $request->input('main_type', 'paragraphe');

        $rules = [
            'badge'          => 'required|string|max:255',
            'titre'          => 'required|string|max:255',
            'extra'          => 'required|string',
            'image'          => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'image_actuelle' => 'required|string',
        ];

        if ($mainType === 'liste') {
            $rules['liste']   = 'required|array';
            $rules['liste.*'] = 'required|string';
        } else {
            $rules['paragraphe'] = 'required|string';
        }

        $request->validate($rules);

        $image = $request->image_actuelle;
        if ($request->hasFile('image')) {
            $filename = $section . '_' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('assets/images'), $filename);
            $image = 'assets/images/' . $filename;
        }

        $content = File::get($fullPath);

        $content = preg_replace(
            '/(<img src="\{\{ asset\(\').*?(\'\) \}\}" alt="[^"]*" id="parallax-img-surete">)/',
            '${1}' . addslashes($image) . '${2}',
            $content
        );

        $content = preg_replace_callback(
            '/(<span class="law-ref">).*?(<\/span>)/su',
            fn($m) => $m[1] . e($request->badge) . $m[2],
            $content
        );
        $content = preg_replace_callback(
            '/(<h2>).*?(<\/h2>)/su',
            fn($m) => $m[1] . e($request->titre) . $m[2],
            $content
        );

        if ($mainType === 'liste') {
            $listeHtml = '';
            foreach ($request->liste as $item) {
                $listeHtml .= "                        <li>" . e($item) . "</li>\n";
            }
            $content = preg_replace_callback(
                '/(<ul class="main-list">\s*).*?(\s*<\/ul>)/su',
                fn($m) => $m[1] . "\n" . $listeHtml . $m[2],
                $content
            );
        } else {
            $content = preg_replace_callback(
                '/(<p class="main-text">).*?(<\/p>)/su',
                fn($m) => $m[1] . e($request->paragraphe) . $m[2],
                $content
            );
        }

        $extraFormatted = nl2br(e($request->extra));
        $innerHtml = "\n                            <p>\n                                " . $extraFormatted . "\n                            </p>\n";

        $tablesTitre  = $request->table_titre ?? [];
        $tablesAnnees = $request->table_annees ?? [];
        $tablesCause  = $request->table_cause ?? [];
        $tablesV1     = $request->table_v1 ?? [];
        $tablesV2     = $request->table_v2 ?? [];
        $tablesV3     = $request->table_v3 ?? [];
        $tablesTotal  = $request->table_total ?? [];

        foreach ($tablesTitre as $ti => $titreTable) {
            $innerHtml .= "\n                            <h4 class=\"table-title\">" . e($titreTable) . "</h4>\n";
            $innerHtml .= "                            <div class=\"table-responsive\">\n";
            $innerHtml .= "                                <table class=\"custom-sar-table\">\n";
            $innerHtml .= "                                    <thead>\n                                        <tr>\n";
            $innerHtml .= "                                            <th>Cause</th>\n";
            foreach ($tablesAnnees[$ti] ?? [] as $annee) {
                $innerHtml .= "                                            <th>" . e($annee) . "</th>\n";
            }
            $innerHtml .= "                                        </tr>\n                                    </thead>\n                                    <tbody>\n";

            foreach ($tablesCause[$ti] ?? [] as $ri => $cause) {
                $classe = (stripos($cause, 'autre') !== false) ? ' class="row-others"' : '';
                $innerHtml .= "                                        <tr{$classe}><td>" . e($cause) . "</td><td>" . e($tablesV1[$ti][$ri] ?? '') . "</td><td>" . e($tablesV2[$ti][$ri] ?? '') . "</td><td>" . e($tablesV3[$ti][$ri] ?? '') . "</td></tr>\n";
            }

            $innerHtml .= "                                    </tbody>\n                                    <tfoot>\n";
            $innerHtml .= "                                        <tr class=\"row-total\"><td>Total</td>";
            foreach ($tablesTotal[$ti] ?? [] as $tot) {
                $innerHtml .= "<td>" . e($tot) . "</td>";
            }
            $innerHtml .= "</tr>\n                                    </tfoot>\n                                </table>\n                            </div>\n";
        }

        $content = preg_replace_callback(
            '/(<div class="article-highlight">\s*).*?(\s*<\/div>\s*<\/div>\s*<\/div>\s*<div class="info-footer">)/su',
            fn($m) => $m[1] . $innerHtml . $m[2],
            $content
        );

        File::put($fullPath, $content);

        return redirect()
            ->route('activites-nos')
            ->with('success', $config['label'] . ' a été mise à jour avec succès.');
    }

    // ===================================================================
    //  SERVICES EN LIGNE
    // ===================================================================

    public function servicesEnLigne()
    {
        if (!File::exists($this->servicesEnLigneViewPath)) {
            abort(404, 'Fichier Services en Ligne introuvable : ' . $this->servicesEnLigneViewPath);
        }

        $content = File::get($this->servicesEnLigneViewPath);

        // Récupère le contenu du tableau $solMeta
        preg_match('/\$solMeta\s*=\s*\[(.*?)\n    \];/su', $content, $mMeta);
        $metaBlock = $mMeta[1] ?? '';

        // Récupère (si présent) le tableau $solLiens ajouté par une précédente sauvegarde
        preg_match('/\$solLiens\s*=\s*\[(.*?)\n    \];/su', $content, $mLiens);
        $liensBlock = $mLiens[1] ?? '';

        $services = [];
        foreach ($this->servicesEnLigneNoms as $nom) {
            $pattern = '/\'' . preg_quote($nom, '/') . '\'\s*=>\s*\[\s*\'desc\'\s*=>\s*"(.*?)",\s*\'accent\'\s*=>\s*\'(.*?)\',\s*\'icon\'\s*=>\s*\'(.*?)\',\s*\],/su';
            preg_match($pattern, $metaBlock, $mItem);

            $lienPattern = '/\'' . preg_quote($nom, '/') . '\'\s*=>\s*\'(.*?)\',/su';
            preg_match($lienPattern, $liensBlock, $mLien);

            $services[] = [
                'key'    => $nom,
                'desc'   => trim($mItem[1] ?? ''),
                'accent' => trim($mItem[2] ?? 'navy'),
                'icon'   => trim($mItem[3] ?? 'folder'),
                'lien'   => trim($mLien[1] ?? '#'),
                'ok'     => !empty($mItem[1]),
            ];
        }

        return view('Espace_admin.service_ligne', ['services' => $services]);
    }

    public function servicesEnLigne_update(Request $request)
    {
        $request->validate([
            'desc'   => 'required|array',
            'desc.*' => 'required|string|max:500',
            'accent' => 'required|array',
            'accent.*' => 'required|string|in:navy,blue,orange,green,gold',
            'icon'   => 'required|array',
            'icon.*' => 'required|string|in:stamp,shield,anchor,booklet,wheel,gear-ship,folder',
            'lien'   => 'nullable|array',
            'lien.*' => 'nullable|string|max:500',
        ]);

        $content = File::get($this->servicesEnLigneViewPath);

        // 1. Reconstruit le tableau $solMeta en entier
        $metaHtml = '';
        foreach ($this->servicesEnLigneNoms as $i => $nom) {
            $desc   = $request->desc[$i]   ?? '';
            $accent = $request->accent[$i] ?? 'navy';
            $icon   = $request->icon[$i]   ?? 'folder';

            $metaHtml .= "        '" . addslashes($nom) . "' => [\n";
            $metaHtml .= "            'desc'   => \"" . addslashes($desc) . "\",\n";
            $metaHtml .= "            'accent' => '" . $accent . "',\n";
            $metaHtml .= "            'icon'   => '" . $icon . "',\n";
            $metaHtml .= "        ],\n";
        }

        $content = preg_replace_callback(
            '/(\$solMeta\s*=\s*\[).*?(\n    \];)/su',
            fn($m) => $m[1] . "\n" . $metaHtml . $m[2],
            $content
        );

        // 2. Reconstruit (ou crée) le tableau $solLiens
        $liensHtml = '';
        foreach ($this->servicesEnLigneNoms as $i => $nom) {
            $lien = $request->lien[$i] ?? '#';
            $liensHtml .= "        '" . addslashes($nom) . "' => '" . addslashes($lien) . "',\n";
        }
        $liensBlockComplet = "\n    \$solLiens = [\n" . $liensHtml . "    ];\n";

        if (preg_match('/\$solLiens\s*=\s*\[.*?\n    \];\n/su', $content)) {
            // Le tableau existe déjà : on le remplace
            $content = preg_replace(
                '/\$solLiens\s*=\s*\[.*?\n    \];\n/su',
                trim($liensBlockComplet) . "\n",
                $content
            );
        } else {
            // Première sauvegarde : on l'insère juste après la fermeture de $solMeta
            $content = preg_replace(
                '/(\$solMeta\s*=\s*\[.*?\n    \];\n)/su',
                '$1' . $liensBlockComplet,
                $content,
                1
            );
        }

        // 3. Utilise $solLiens dans le repli (fallback) pour que les liens soient bien pris en compte
        $content = preg_replace(
            "/collect\(array_keys\(\\\$solMeta\)\)->map\(function \(\\\$name\) \{\s*return \(object\) \['service' => \\\$name, 'lien' => '#'\];\s*\}\);/su",
            "collect(array_keys(\$solMeta))->map(function (\$name) use (\$solLiens) {\n            return (object) ['service' => \$name, 'lien' => \$solLiens[\$name] ?? '#'];\n        });",
            $content
        );

        File::put($this->servicesEnLigneViewPath, $content);

        return redirect()
            ->route('services-en-ligne')
            ->with('success', 'La page Services en Ligne a été mise à jour avec succès.');
    }
}