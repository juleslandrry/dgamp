<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartenaireController extends Controller
{
    public function showPartenaire()
    {
        $partenaires = Partenaire::latest()->get();

        return view('partenaire', compact('partenaires'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $partenaires = Partenaire::when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%{$search}%")
                         ->orWhere('type', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('Espace_admin.partenaires', compact('partenaires', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'  => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'type' => 'nullable|string|max:255',
        ]);

        $logoPath = $request->file('logo')->store('partenaires', 'public');

        Partenaire::create([
            'nom'  => $request->nom,
            'logo' => $logoPath,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Partenaire ajouté avec succès.');
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $request->validate([
            'nom'  => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'type' => 'nullable|string|max:255',
        ]);

        $data = [
            'nom'  => $request->nom,
            'type' => $request->type,
        ];

        if ($request->hasFile('logo')) {
            if ($partenaire->logo && Storage::disk('public')->exists($partenaire->logo)) {
                Storage::disk('public')->delete($partenaire->logo);
            }
            $data['logo'] = $request->file('logo')->store('partenaires', 'public');
        }

        $partenaire->update($data);

        return redirect()->back()->with('success', 'Partenaire mis à jour avec succès.');
    }

    public function destroy(Partenaire $partenaire)
    {
        if ($partenaire->logo && Storage::disk('public')->exists($partenaire->logo)) {
            Storage::disk('public')->delete($partenaire->logo);
        }

        $partenaire->delete();

        return redirect()->back()->with('success', 'Partenaire supprimé avec succès.');
    }
}
