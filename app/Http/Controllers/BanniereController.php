<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Banniere;
class BanniereController extends Controller
{
    public function index()
    {
        $banners = Banniere::orderBy('ordre', 'asc')->orderBy('created_at', 'desc')->get();
        return view('Espace_admin.parametres.banniere', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:2000', // Augmenté pour le HTML
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ordre' => 'nullable|integer',
        ]);

        $imagePath = $request->file('image')->store('banniere', 'public');

        Banniere::create([
            'titre'     => $request->titre,
            'image'     => $imagePath,
            'ordre'     => $request->ordre ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Bannière ajoutée avec succès.');
    }

    public function update(Request $request, Banniere $banniere)
    {
        $request->validate([
            'titre' => 'required|string|max:2000', // Augmenté pour le HTML
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'ordre' => 'nullable|integer',
        ]);

        $data = [
            'titre'     => $request->titre,
            'ordre'     => $request->ordre ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($banniere->image && Storage::disk('public')->exists($banniere->image)) {
                Storage::disk('public')->delete($banniere->image);
            }
            $data['image'] = $request->file('image')->store('banniere', 'public');
        }

        $banniere->update($data);

        return redirect()->back()->with('success', 'Bannière mise à jour avec succès.');
    }

    public function destroy(Banniere $banniere)
    {
        if ($banniere->image && Storage::disk('public')->exists($banniere->image)) {
            Storage::disk('public')->delete($banniere->image);
        }
        $banniere->delete();

        return redirect()->back()->with('success', 'Bannière supprimée avec succès.');
    }
}
