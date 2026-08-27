<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use App\Models\Banniere;
class ArrondissementController extends Controller
{
    public function showArrondissement($slug)
    {
        $arrondissement = Arrondissement::where('slug', $slug)->firstOrFail();
        
        return view('arrondissement.arrondissement', compact('arrondissement'));
    }

    public function index()
    {
        $arrondissements = Arrondissement::latest()->paginate(10);
        return view('Espace_admin.arrondissement.arrondissement', compact('arrondissements'));
    }

    public function create()
    {
        return view('Espace_admin.arrondissement.create');  
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'description' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('arrondissements', 'public');
        }

        Arrondissement::create([
            'titre'       => $request->titre,
            'slug'        => Str::slug($request->titre),
            'image'       => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('arrondissements.index')
                         ->with('success', 'Arrondissement créé avec succès.');
    }

    public function edit(Arrondissement $arrondissement)
    {
        return view('Espace_admin.arrondissement.edit', compact('arrondissement'));
    }

    public function update(Request $request, Arrondissement $arrondissement)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
            'description' => 'required|string',
        ]);

        $data = [
            'titre'       => $request->titre,
            'slug'        => Str::slug($request->titre),
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($arrondissement->image) {
                Storage::disk('public')->delete($arrondissement->image);
            }
            $data['image'] = $request->file('image')->store('arrondissements', 'public');
        }

        $arrondissement->update($data);

        return redirect()->route('arrondissements.index')
                         ->with('success', 'Arrondissement mis à jour avec succès.');
    }

    public function destroy(Arrondissement $arrondissement)
    {
        if ($arrondissement->image) {
            Storage::disk('public')->delete($arrondissement->image);
        }
        $arrondissement->delete();

        return redirect()->route('arrondissements.index')
                         ->with('success', 'Arrondissement supprimé avec succès.');
    }

    // Gestion du téléversement d'images internes au WYSIWYG
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('arrondissements/editor', 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
        return response()->json(['error' => 'Aucun fichier transmis'], 400);
    }
}
