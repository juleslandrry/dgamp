<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Reglementation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActiviteController extends Controller
{
    // Affichage public d'une activité via son slug
    public function showActivite($slug)
    {
        $activite = Activite::with('reglementations')->where('slug', $slug)->firstOrFail();

        return view('activite.activites', compact('activite'));
    }

    public function indexActivite()
    {
        $activites = Activite::with('reglementations')->get();
        return view('Espace_admin.activites', compact('activites'));
    }

    // Enregistrer une activité
    public function storeActivite(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('activites', 'public') : null;

        Activite::create([
            'titre' => $request->titre,
            'slug' => Str::slug($request->titre),
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Activité créée avec succès.');
    }

    // Mettre à jour une activité
    public function updateActivite(Request $request, Activite $activite)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($activite->image) Storage::disk('public')->delete($activite->image);
            $activite->image = $request->file('image')->store('activites', 'public');
        }

        $activite->titre = $request->titre;
        $activite->slug = Str::slug($request->titre);
        $activite->save();

        return back()->with('success', 'Activité mise à jour.');
    }

    // Supprimer une activité
    public function destroyActivite(Activite $activite)
    {
        if ($activite->image) Storage::disk('public')->delete($activite->image);
        $activite->delete();
        return back()->with('success', 'Activité supprimée.');
    }

    // Enregistrer une réglementation rattachée
    public function storeReglementation(Request $request, Activite $activite)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'sous_titre' => 'nullable|string|max:255',
            'intro' => 'nullable|string',
            'description' => 'required|string',
        ]);

        $activite->reglementations()->create($data);

        return back()->with('success', 'Réglementation ajoutée.');
    }

    // Supprimer une réglementation
    public function destroyReglementation(Reglementation $reglementation)
    {
        $reglementation->delete();
        return back()->with('success', 'Réglementation supprimée.');
    }
}
