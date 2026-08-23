<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Communique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunicationController extends Controller
{
    public function indexCommunique()
    {
        $communiques = Communique::latest()->paginate(10);
        return view('Espace_admin.communication.communique', compact('communiques'));
    }

    // Site Public
    public function showCommunique()
    {
        $communiques = Communique::latest()->get();
        return view('communique', compact('communiques'));
    }

    public function storeCommunique(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'fichier'     => 'required|file|mimes:pdf|max:10240',
        ]);

        $path = $request->file('fichier')->store('communiques', 'public');

        Communique::create([
            'titre'        => $request->titre,
            'description'  => $request->description,
            'fichier_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Communiqué ajouté avec succès.');
    }

    public function updateCommunique(Request $request, $id)
    {
        $communique = Communique::findOrFail($id);

        $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'fichier'     => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('fichier')) {
            if ($communique->fichier_path && Storage::disk('public')->exists($communique->fichier_path)) {
                Storage::disk('public')->delete($communique->fichier_path);
            }
            $communique->fichier_path = $request->file('fichier')->store('communiques', 'public');
        }

        $communique->titre = $request->titre;
        $communique->description = $request->description;
        $communique->save();

        return redirect()->back()->with('success', 'Communiqué mis à jour avec succès.');
    }

    public function destroyCommunique($id)
    {
        $communique = Communique::findOrFail($id);

        if ($communique->fichier_path && Storage::disk('public')->exists($communique->fichier_path)) {
            Storage::disk('public')->delete($communique->fichier_path);
        }

        $communique->delete();

        return redirect()->back()->with('success', 'Communiqué supprimé avec succès.');
    }

    public function showActualite()
    {
        $actualites = Actualite::orderBy('date_publication', 'desc')->get();
        return view('actualite', compact('actualites'));
    }

    public function indexActualite()
    {
        $actualites = Actualite::latest()->paginate(10);
        return view('Espace_admin.communication.actualite', compact('actualites'));
    }

    public function storeActualite(Request $request)
    {
        $request->validate([
            'titre'            => 'required|string|max:255',
            'categorie'        => 'nullable|string|max:255',
            'date_publication' => 'nullable|date|max:255',
            'description'      => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create([
            'titre'            => $request->titre,
            'categorie'        => $request->categorie,
            'date_publication' => $request->date_publication,
            'description'      => $request->description,
            'image_path'       => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Article d\'actualité ajouté avec succès.');
    }

    public function updateActualite(Request $request, $id)
    {
        $actualite = Actualite::findOrFail($id);

        $request->validate([
            'titre'            => 'required|string|max:255',
            'categorie'        => 'nullable|string|max:255',
            'date_publication' => 'nullable|string|max:255',
            'description'      => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($actualite->image_path && Storage::disk('public')->exists($actualite->image_path)) {
                Storage::disk('public')->delete($actualite->image_path);
            }
            $actualite->image_path = $request->file('image')->store('actualites', 'public');
        }

        $actualite->titre = $request->titre;
        $actualite->categorie = $request->categorie;
        $actualite->date_publication = $request->date_publication;
        $actualite->description = $request->description;
        $actualite->save();

        return redirect()->back()->with('success', 'Article d\'actualité mis à jour avec succès.');
    }

    public function destroyActualite($id)
    {
        $actualite = Actualite::findOrFail($id);

        if ($actualite->image_path && Storage::disk('public')->exists($actualite->image_path)) {
            Storage::disk('public')->delete($actualite->image_path);
        }

        $actualite->delete();

        return redirect()->back()->with('success', 'Article d\'actualité supprimé avec succès.');
    }
}
