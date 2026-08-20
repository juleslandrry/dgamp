<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\MissionsObjectifs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Organigramme;
use App\Models\OrganigrammeNode;

use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
    public function historiqueSite()
    {
        $historique = Historique::with('etapes')->first();

        return view('accueil.apropos.organisation.historique-dgam', compact('historique'));
    }

    public function organigrammeSite()
    {
        $organigramme = Organigramme::with([
            'nodes' => function ($query) {
                $query->whereNull('parent_id')
                    ->orderBy('ordre')
                    ->with([
                        'enfants' => function ($query) {
                            $query->orderBy('ordre');
                        }
                    ]);
            }
        ])->first();

        return view('accueil.apropos.organisation.organigrame-dgam', compact('organigramme'));
    }

    public function missionsObjectifs()
    {
        $contenu = MissionsObjectifs::with([
            'missions',
            'objectifs'
        ])->first();

        return view('accueil.apropos.organisation.mission-et-objectif', compact('contenu'));
    }

    public function historique()
    {
        $historique = Historique::with('etapes')->first();

        $intro = $historique?->intro ?? '';

        $timeline = $historique
            ? $historique->etapes->map(function ($etape) {
                return [
                    'date' => $etape->date,
                    'description' => $etape->description,
                ];
            })->toArray()
            : [];

        return view('Espace_admin.accueil.directeurgene.organisation.historique', compact(
            'intro',
            'timeline'
        ));
    }

    public function updateHistorique(Request $request)
    {
        $request->validate([
            'intro' => [
                'required',
                'string',
            ],

            'date' => [
                'nullable',
                'array',
            ],

            'date.*' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'array',
            ],

            'description.*' => [
                'nullable',
                'string',
            ],
        ]);

        $historique = Historique::first();

        if (!$historique) {
            $historique = Historique::create([
                'intro' => $request->intro,
            ]);
        } else {
            $historique->update([
                'intro' => $request->intro,
            ]);
        }

        // On supprime les anciennes étapes
        $historique->etapes()->delete();

        // On recrée les étapes dans l'ordre affiché dans la vue
        foreach ($request->date ?? [] as $index => $date) {

            $description = $request->description[$index] ?? '';

            // Évite d'enregistrer une étape complètement vide
            if (trim($date) === '' && trim($description) === '') {
                continue;
            }

            $historique->etapes()->create([
                'date' => $date,
                'description' => $description,
                'ordre' => $index + 1,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'L’historique a été mis à jour avec succès.');
    }

    public function missions()
    {
        $missionsObjectifs = MissionsObjectifs::with([
            'missions',
            'objectifs',
        ])->first();

        return view('Espace_admin.accueil.directeurgene.organisation.mission_et_objectif',compact('missionsObjectifs'));
    }

    public function updateMissions(Request $request)
    {
        $request->validate([
            'missions_titre' => ['required', 'string', 'max:255'],

            'objectifs_titre' => ['required', 'string', 'max:255'],

            'missions' => ['nullable', 'array'],

            'missions.*.titre' => [
                'required',
                'string',
                'max:255',
            ],

            'missions.*.description' => [
                'required',
                'string',
            ],

            'objectifs' => ['nullable', 'array'],

            'objectifs.*.titre' => [
                'required',
                'string',
                'max:255',
            ],

            'objectifs.*.description' => [
                'required',
                'string',
            ],
        ]);

        DB::transaction(function () use ($request) {

            $missionsObjectifs = MissionsObjectifs::first();

            if (!$missionsObjectifs) {

                $missionsObjectifs = MissionsObjectifs::create([
                    'missions_titre' => $request->missions_titre,
                    'objectifs_titre' => $request->objectifs_titre,
                ]);

            } else {

                $missionsObjectifs->update([
                    'missions_titre' => $request->missions_titre,
                    'objectifs_titre' => $request->objectifs_titre,
                ]);

            }

            $missionsObjectifs->cartes()->delete();

            foreach ($request->missions ?? [] as $index => $mission) {

                $missionsObjectifs->cartes()->create([
                    'type' => 'mission',
                    'titre' => $mission['titre'],
                    'description' => $mission['description'],
                    'ordre' => $index,
                ]);
            }

            foreach ($request->objectifs ?? [] as $index => $objectif) {

                $missionsObjectifs->cartes()->create([
                    'type' => 'objectif',
                    'titre' => $objectif['titre'],
                    'description' => $objectif['description'],
                    'ordre' => $index,
                ]);
            }
        });

        return redirect()->route('admin.missions')->with('success','Les missions et objectifs ont été mis à jour avec succès.');
    }

    public function organigramme()
    {
        $organigramme = Organigramme::with([
            'nodes.enfants.enfants',
            'documents',
        ])->first();

        return view('Espace_admin.accueil.directeurgene.organisation.organigrame',compact('organigramme')
        );
    }

    public function updateOrganigramme(Request $request)
    {
        $request->validate([
            'directeur_titre' => [
                'required',
                'string',
                'max:255',
            ],

            'nodes' => [
                'nullable',
                'array',
            ],

            'nodes.*.nom' => [
                'required',
                'string',
                'max:255',
            ],

            'nodes.*.enfants' => [
                'nullable',
                'array',
            ],

            'nodes.*.enfants.*.nom' => [
                'required',
                'string',
                'max:255',
            ],

            'organigramme_pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],

            'decret_pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],
        ]);

        DB::transaction(function () use ($request) {

            /*
            |--------------------------------------------------------------------------
            | 1. Récupérer ou créer l'organigramme
            |--------------------------------------------------------------------------
            */

            $organigramme = Organigramme::first();

            if (!$organigramme) {

                $organigramme = Organigramme::create([
                    'directeur_titre' => $request->directeur_titre,
                ]);

            } else {

                $organigramme->update([
                    'directeur_titre' => $request->directeur_titre,
                ]);
            }

            if ($request->hasFile('organigramme_pdf')) {

                // Supprimer l'ancien fichier
                if (
                    $organigramme->organigramme_pdf &&
                    Storage::disk('public')->exists($organigramme->organigramme_pdf)
                ) {
                    Storage::disk('public')->delete(
                        $organigramme->organigramme_pdf
                    );
                }

                // Enregistrer le nouveau
                $path = $request
                    ->file('organigramme_pdf')
                    ->store('organigramme', 'public');

                $organigramme->update([
                    'organigramme_pdf' => $path,
                ]);
            }

            if ($request->hasFile('decret_pdf')) {

                if (
                    $organigramme->decret_pdf &&
                    Storage::disk('public')->exists($organigramme->decret_pdf)
                ) {
                    Storage::disk('public')->delete(
                        $organigramme->decret_pdf
                    );
                }

                $path = $request
                    ->file('decret_pdf')
                    ->store('organigramme', 'public');

                $organigramme->update([
                    'decret_pdf' => $path,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | 2. Supprimer l'ancienne hiérarchie
            |--------------------------------------------------------------------------
            */

            $organigramme->nodes()->each(function ($node) {

                $this->deleteNodeChildren($node);

            });

            OrganigrammeNode::where(
                'organigramme_id',
                $organigramme->id
            )->delete();


            /*
            |--------------------------------------------------------------------------
            | 3. Recréer la hiérarchie
            |--------------------------------------------------------------------------
            */

            foreach ($request->nodes ?? [] as $ordre => $nodeData) {

                $parent = OrganigrammeNode::create([
                    'organigramme_id' => $organigramme->id,
                    'parent_id' => null,
                    'nom' => $nodeData['nom'],
                    'ordre' => $ordre,
                ]);


                foreach ($nodeData['enfants'] ?? [] as $ordreEnfant => $enfantData) {

                    OrganigrammeNode::create([
                        'organigramme_id' => $organigramme->id,
                        'parent_id' => $parent->id,
                        'nom' => $enfantData['nom'],
                        'ordre' => $ordreEnfant,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.organigramme')
            ->with(
                'success',
                'L’organigramme a été mis à jour avec succès.'
            );
    }

    private function deleteNodeChildren(OrganigrammeNode $node)
    {
        foreach ($node->enfants as $enfant) {

            $this->deleteNodeChildren($enfant);

            $enfant->delete();
        }
    }

}
