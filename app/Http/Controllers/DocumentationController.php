<?php

namespace App\Http\Controllers;

use App\Models\Accord;
use App\Models\Arrete;
use App\Models\Convention;
use App\Models\Decret;
use App\Models\Loi;
use App\Models\Protocole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    // Affiche la liste des lois sur le site public
    public function showLois()
    {
        // Récupération des lois triées par ordre
        $lois = Loi::orderBy('ordre', 'asc')->orderBy('id', 'asc')->get();

        return view('accueil.apropos.documentation.textes-nationaux.lois-dgam', compact('lois')); // Remplacez 'lois' par le nom exact de votre fichier de vue front
    }

    // Affiche la liste des lois dans l'admin
    public function indexLois()
    {
        $lois = Loi::orderBy('ordre', 'asc')->orderBy('id', 'asc')->get();
        return view('Espace_admin.texte_nationnaux.lois', compact('lois'));
    }

    // Traite l'ajout, la mise à jour et la suppression massive
    public function updateLois(Request $request)
    {
        $request->validate([
            'reference.*' => 'required|string|max:255',
            'intitule.*'  => 'required|string|max:255',
            'fichier.*'   => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $submittedIds = array_filter($request->input('id', []));

        // 1. Suppression des lois retirées sur l'interface
        $loisToDelete = Loi::whereNotIn('id', $submittedIds)->get();
        foreach ($loisToDelete as $loi) {
            if ($loi->fichier_path && Storage::disk('public')->exists($loi->fichier_path)) {
                Storage::disk('public')->delete($loi->fichier_path);
            }
            $loi->delete();
        }

        // 2. Traitement des enregistrements
        $references = $request->input('reference', []);
        $intitules = $request->input('intitule', []);
        $ids = $request->input('id', []);
        $fichiers = $request->file('fichier', []);

        foreach ($references as $index => $ref) {
            $loiId = $ids[$index] ?? null;
            $loi = $loiId ? Loi::find($loiId) : new Loi();

            $loi->reference = $ref;
            $loi->intitule = $intitules[$index] ?? '';
            $loi->ordre = $index + 1;

            // Enregistrement / Remplacement du PDF
            if (isset($fichiers[$index])) {
                if ($loi->exists && $loi->fichier_path && Storage::disk('public')->exists($loi->fichier_path)) {
                    Storage::disk('public')->delete($loi->fichier_path);
                }
                $path = $fichiers[$index]->store('documents/lois', 'public');
                $loi->fichier_path = $path;
            }

            // Ne sauvegarder que si la loi est existante ou si un fichier a été fourni lors de la création
            if ($loi->exists || $loi->fichier_path) {
                $loi->save();
            }
        }

        return redirect()->back()->with('success', 'Les lois et règlements ont été mis à jour avec succès.');
    }

    // Admin : Affichage de la page de gestion des décrets
    public function indexDecrets()
    {

        $decrets = Decret::orderBy('ordre', 'asc')->orderBy('id', 'asc')->get();
        return view('Espace_admin.texte_nationnaux.decret', compact('decrets'));
    }

    // Admin : Traitement des décrets / arrêtés
    public function updateDecrets(Request $request)
    {
        $request->validate([
            'titre.*'       => 'required|string|max:255',
            'description.*' => 'required|string',
            'fichier.*'     => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $titres = $request->input('titre', []);
        $descriptions = $request->input('description', []);
        $rawIds = $request->input('id', []);
        $fichiers = $request->file('fichier', []);

        // Garder les IDs valides
        $keptIds = [];

        foreach ($titres as $key => $titre) {
            $decretId = $rawIds[$key] ?? null;

            // Si l'ID existe en base, on le met à jour, sinon on crée une nouvelle instance
            $decret = ($decretId && is_numeric($decretId)) ? Decret::find($decretId) : new Decret();
            if (!$decret) {
                $decret = new Decret();
            }

            $decret->titre = $titre;
            $decret->description = $descriptions[$key] ?? '';
            $decret->ordre = $key + 1;
            
            // Valeur par défaut pour fichier_path si création sans fichier immédiat
            if (!$decret->fichier_path) {
                $decret->fichier_path = '';
            }

            if (isset($fichiers[$key]) && $fichiers[$key]->isValid()) {
                if ($decret->exists && $decret->fichier_path && Storage::disk('public')->exists($decret->fichier_path)) {
                    Storage::disk('public')->delete($decret->fichier_path);
                }
                $path = $fichiers[$key]->store('documents/decrets', 'public');
                $decret->fichier_path = $path;
            }

            $decret->save();
            $keptIds[] = $decret->id;
        }

        // Supprimer uniquement les décrets qui ont été retirés dans l'interface
        if (!empty($keptIds)) {
            Decret::whereNotIn('id', $keptIds)->delete();
        }

        return redirect()->route('decrets.index')->with('success', 'Enregistrement effectué avec succès.');
    }

    // Public : Affichage sur le site client
    public function showDecrets()
    {
        $decrets = Decret::orderBy('ordre', 'asc')->orderBy('id', 'asc')->get();
        return view('accueil.apropos.documentation.textes-nationaux.decret-dgam', compact('decrets'));
    }

    public function indexArrete()
    {
        $arretes = Arrete::orderBy('ordre', 'asc')->get();

        return view('Espace_admin.texte_nationnaux.arrete', compact('arretes'));
    }

    /**
     * 2. Traite l'enregistrement, la mise à jour et la suppression des arrêtés
     */
    public function updateArretes(Request $request)
    {
        $request->validate([
            'titre.*'       => 'required|string|max:255',
            'description.*' => 'required|string',
            'fichier.*'     => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $ids          = $request->input('id', []);
        $titres       = $request->input('titre', []);
        $descriptions = $request->input('description', []);
        $fichiers     = $request->file('fichier', []);

        $keptIds = [];

        foreach ($titres as $key => $titre) {
            $arreteId = $ids[$key] ?? null;

            // Récupère l'élément s'il existe, sinon instancie un nouveau
            $arrete = ($arreteId && is_numeric($arreteId)) 
                ? Arrete::find($arreteId) 
                : new Arrete();

            if (!$arrete) {
                $arrete = new Arrete();
            }

            $arrete->titre       = $titre;
            $arrete->description = $descriptions[$key] ?? '';
            $arrete->ordre       = $key + 1;

            // Upload et remplacement du fichier PDF si un nouveau fichier est envoyé
            if (isset($fichiers[$key]) && $fichiers[$key]->isValid()) {
                if ($arrete->exists && $arrete->fichier_path && Storage::disk('public')->exists($arrete->fichier_path)) {
                    Storage::disk('public')->delete($arrete->fichier_path);
                }
                $path = $fichiers[$key]->store('documents/arretes', 'public');
                $arrete->fichier_path = $path;
            }

            $arrete->save();
            $keptIds[] = $arrete->id;
        }

        // Supprime de la BDD les cartes retirées de l'interface
        if (!empty($keptIds)) {
            Arrete::whereNotIn('id', $keptIds)->delete();
        }

        return redirect()->back()->with('success', 'Arrêtés enregistrés avec succès.');
    }

    /**
     * 3. Affiche la liste des arrêtés sur le site public
     */
    public function showArrete(Request $request)
    {
        $query = Arrete::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $arretes = $query->orderBy('ordre', 'asc')->get();

        return view('accueil.apropos.documentation.textes-nationaux.arretes', compact('arretes'));
    }

    public function editConventions()
    {
        $conventions = Convention::all();
        $detection_ok = true;

        return view('Espace_admin.texte_internationnaux.convention', compact('conventions', 'detection_ok'));
    }

    // Traitement du formulaire d'enregistrement (Admin)
    public function updateConventions(Request $request)
    {
        $request->validate([
            'titre' => 'required|array',
            'titre.*' => 'required|string|max:255',
            'fichier.*' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Optionnel : Réinitialiser la table si tu gères l'ensemble par synchronisation
        Convention::truncate();

        $titres = $request->input('titre', []);
        $descriptions = $request->input('description', []);
        $liens_existants = $request->input('lien', []);

        foreach ($titres as $index => $titre) {
            $path = $liens_existants[$index] ?? null;

            // Traitement de l'upload si un nouveau fichier est transmis
            if ($request->hasFile("fichier.$index")) {
                $file = $request->file("fichier.$index");
                $path = $file->store('conventions', 'public');
            }

            Convention::create([
                'titre' => $titre,
                'description' => $descriptions[$index] ?? null,
                'fichier_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Les conventions ont été mises à jour avec succès.');
    }

    // Affichage public du site
    public function showConventions()
    {
        $conventions = Convention::all();
        return view('accueil.apropos.documentation.textes-nationaux.textes-internationaux.convention-dgam', compact('conventions'));
    }

    // Affichage dans l'espace Admin
    public function editAccords()
    {
        $accords = Accord::all();
        $detection_ok = true;

        return view('Espace_admin.texte_internationnaux.accord', compact('accords', 'detection_ok'));
    }

    // Sauvegarde / Mise à jour dans l'espace Admin
    public function updateAccords(Request $request)
    {
        $request->validate([
            'reference'   => 'required|array',
            'reference.*' => 'required|string|max:255',
            'intitule'    => 'required|array',
            'intitule.*'  => 'required|string|max:255',
            'fichier.*'   => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // On re-synchronise la liste
        Accord::truncate();

        $references      = $request->input('reference', []);
        $intitules       = $request->input('intitule', []);
        $mots_cles       = $request->input('mots_cles', []);
        $liens_existants = $request->input('lien', []);

        foreach ($references as $index => $ref) {
            $path = $liens_existants[$index] ?? null;

            if ($request->hasFile("fichier.$index")) {
                $file = $request->file("fichier.$index");
                $path = $file->store('accords', 'public');
            }

            Accord::create([
                'reference'    => $ref,
                'intitule'     => $intitules[$index] ?? '',
                'mots_cles'    => $mots_cles[$index] ?? null,
                'fichier_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Les accords ont été mis à jour avec succès.');
    }

    // Affichage public sur le site principal
    public function showAccords()
    {
        $accords = Accord::all();
        return view('accueil.apropos.documentation.textes-nationaux.textes-internationaux.accord-dgam', compact('accords'));
    }

    // Affichage dans l'espace Admin
    public function editProtocoles()
    {
        $protocoles = Protocole::all();
        $detection_ok = true;

        return view('Espace_admin.texte_internationnaux.protocole', compact('protocoles', 'detection_ok'));
    }

    // Traitement du formulaire d'administration
    public function updateProtocoles(Request $request)
    {
        $request->validate([
            'reference'   => 'required|array',
            'reference.*' => 'required|string|max:255',
            'intitule'    => 'required|array',
            'intitule.*'  => 'required|string|max:255',
            'fichier.*'   => 'nullable|file|mimes:pdf|max:10240',
        ]);

        Protocole::truncate();

        $references      = $request->input('reference', []);
        $intitules       = $request->input('intitule', []);
        $mots_cles       = $request->input('mots_cles', []);
        $liens_existants = $request->input('lien', []);

        foreach ($references as $index => $ref) {
            $path = $liens_existants[$index] ?? null;

            if ($request->hasFile("fichier.$index")) {
                $file = $request->file("fichier.$index");
                $path = $file->store('protocoles', 'public');
            }

            Protocole::create([
                'reference'    => $ref,
                'intitule'     => $intitules[$index] ?? '',
                'mots_cles'    => $mots_cles[$index] ?? null,
                'fichier_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Les protocoles ont été mis à jour avec succès.');
    }

    // Affichage sur le site public
    public function showProtocoles()
    {
        $protocoles = Protocole::all();
        return view('accueil.apropos.documentation.textes-nationaux.textes-internationaux.protocole-dgam', compact('protocoles'));
    }


}
