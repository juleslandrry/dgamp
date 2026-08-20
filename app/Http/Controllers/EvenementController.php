<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EvenementController extends Controller
{
    public function edit()
    {
        $passes = Evenement::passe()->get()->map(fn($e) => [
            'titre' => $e->titre,
            'date_evenement' => optional($e->date_evenement)->format('Y-m-d'),
            'description' => $e->description,
            'details' => $e->details,
            'categorie' => $e->categorie,
            'tag' => $e->tag,
            'image' => $e->image,
        ])->toArray();

        $avenir = Evenement::avenir()->get()->map(fn($e) => [
            'titre' => $e->titre,
            'date_evenement' => optional($e->date_evenement)->format('Y-m-d'),
            'heure_evenement' => $e->heure_evenement ? substr($e->heure_evenement, 0, 5) : '',
            'lieu' => $e->lieu,
            'categorie' => $e->categorie,
            'tag' => $e->tag,
            'lien' => $e->lien,
            'details' => $e->details,
        ])->toArray();

        if (empty($passes)) $passes = [['titre'=>'','date_evenement'=>'','description'=>'','details'=>'','categorie'=>'','tag'=>'','image'=>'']];
        if (empty($avenir)) $avenir = [['titre'=>'','date_evenement'=>'','heure_evenement'=>'','lieu'=>'','categorie'=>'','tag'=>'','lien'=>'','details'=>'']];

        return view('Espace_admin.évenement', [
            'passes' => $passes, 'passes_ok' => true,
            'avenir' => $avenir, 'avenir_ok' => true,
        ]);
    }

    public function updatePasses(Request $request)
    {
        $request->validate([
            'titre' => 'required|array', 'titre.*' => 'required|string|max:255',
            'date_evenement' => 'required|array', 'date_evenement.*' => 'required|date',
            'description' => 'required|array', 'description.*' => 'required|string',
            'details' => 'nullable|array', 'details.*' => 'nullable|string',
            'categorie' => 'required|array', 'categorie.*' => 'required|string|max:100',
            'tag' => 'required|array', 'tag.*' => 'required|string|max:100',
            'image_actuelle' => 'required|array',
            'image' => 'nullable|array', 'image.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
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

        Evenement::where('type', 'passe')->delete();
        foreach ($request->titre as $i => $titre) {
            Evenement::create([
                'type' => 'passe', 'titre' => $titre,
                'date_evenement' => $request->date_evenement[$i] ?? null,
                'description' => $request->description[$i] ?? '',
                'details' => $request->details[$i] ?? '',
                'categorie' => $request->categorie[$i] ?? '',
                'tag' => $request->tag[$i] ?? '',
                'image' => $images[$i] ?? '',
                'ordre' => $i,
            ]);
        }

        return redirect()->route('evenements')->with('success', 'Les événements passés ont été mis à jour avec succès.');
    }

    public function updateAvenir(Request $request)
    {
        $request->validate([
            'titre' => 'required|array', 'titre.*' => 'required|string|max:255',
            'date_evenement' => 'required|array', 'date_evenement.*' => 'required|date',
            'heure_evenement' => 'required|array', 'heure_evenement.*' => 'required',
            'lieu' => 'required|array', 'lieu.*' => 'required|string|max:255',
            'categorie' => 'required|array', 'categorie.*' => 'required|string|max:100',
            'tag' => 'required|array', 'tag.*' => 'required|string|max:100',
            'lien' => 'nullable|array', 'lien.*' => 'nullable|string|max:500',
            'details' => 'nullable|array', 'details.*' => 'nullable|string',
        ]);

        Evenement::where('type', 'avenir')->delete();
        foreach ($request->titre as $i => $titre) {
            Evenement::create([
                'type' => 'avenir', 'titre' => $titre,
                'date_evenement' => $request->date_evenement[$i] ?? null,
                'heure_evenement' => $request->heure_evenement[$i] ?? null,
                'lieu' => $request->lieu[$i] ?? '',
                'categorie' => $request->categorie[$i] ?? '',
                'tag' => $request->tag[$i] ?? '',
                'lien' => $request->lien[$i] ?? '#',
                'details' => $request->details[$i] ?? '',
                'ordre' => $i,
            ]);
        }

        return redirect()->route('evenements')->with('success', 'Les événements à venir ont été mis à jour avec succès.');
    }

    public function showAvenir()
    {
        Carbon::setLocale('fr');

        $evenements = Evenement::avenir()->get()->map(function ($e) {
            $e->jour_affiche = $e->date_evenement ? $e->date_evenement->format('d') : '';
            $e->mois_affiche = $e->date_evenement ? ucfirst($e->date_evenement->translatedFormat('F')) : '';
            $e->horaire_affiche = $e->heure_evenement ? Carbon::parse($e->heure_evenement)->format('H\hi') : '';
            return $e;
        });

        $categories = $evenements->unique('categorie')->map(fn($e) => ['categorie' => $e->categorie, 'tag' => $e->tag])->values();

        return view('accueil.agenda.even-à-venir', [
            'evenements' => $evenements,
            'categories' => $categories,
        ]);
    }

    public function showPasses()
    {
        Carbon::setLocale('fr');

        $evenements = Evenement::passe()->get()->map(function ($e) {
            $e->date_affichee = $e->date_evenement ? strtoupper($e->date_evenement->translatedFormat('d F Y')) : '';
            return $e;
        });

        return view('accueil.agenda.even-passé', [
            'evenements' => $evenements,
        ]);
    }
}