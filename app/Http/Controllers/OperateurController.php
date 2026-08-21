<?php

namespace App\Http\Controllers;

use App\Models\Operateur;
use Illuminate\Http\Request;

class OperateurController extends Controller
{
    public function showOperateur(Request $request)
    {
        $search = $request->input('search');

        $operateurs = Operateur::when($search, function ($query, $search) {
            return $query->where('raison_sociale', 'like', "%{$search}%")
                         ->orWhere('activite', 'like', "%{$search}%");
        })->orderBy('raison_sociale', 'asc')->paginate(10);

        return view('operateur', compact('operateurs', 'search'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $operateurs = Operateur::when($search, function ($query, $search) {
            return $query->where('raison_sociale', 'like', "%{$search}%")
                         ->orWhere('activite', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('Espace_admin.operateur', compact('operateurs', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'raison_sociale' => 'required|string|max:255',
            'activite'       => 'required|string|max:255',
        ]);

        Operateur::create($request->only('raison_sociale', 'activite'));

        return redirect()->back()->with('success', 'Opérateur ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'raison_sociale' => 'required|string|max:255',
            'activite'       => 'required|string|max:255',
        ]);

        $operateur = Operateur::findOrFail($id);
        $operateur->update($request->only('raison_sociale', 'activite'));

        return redirect()->back()->with('success', 'Opérateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateur->delete();

        return redirect()->back()->with('success', 'Opérateur supprimé avec succès.');
    }
}
