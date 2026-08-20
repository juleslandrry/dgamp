<?php

namespace App\Http\Controllers;

use App\Models\MotDg;
use Illuminate\Http\Request;

class MotDgController extends Controller
{
    /**
     * Affiche le formulaire admin
     */
    public function edit()
    {
        $motDg = MotDg::first();

        return view('Espace_admin.accueil.directeurgene.mot_dg', [
            'grade_dg'  => $motDg->grade_dg  ?? '',
            'nom_dg'    => $motDg->nom_dg    ?? '',
            'prenom_dg' => $motDg->prenom_dg ?? '',
            'titre_dg'  => $motDg->titre_dg  ?? '',
            'texte_dg'  => $motDg->texte_dg  ?? '',
            'photo'     => $motDg->photo     ?? 'assets/images/default-dg.jpg',
        ]);
    }

    /**
     * Enregistre les modifications
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'grade_dg'  => 'required|string|max:255',
            'nom_dg'    => 'required|string|max:255',
            'prenom_dg' => 'required|string|max:255',
            'titre_dg'  => 'required|string|max:255',
            'texte_dg'  => 'required|string',
            'photo'     => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $motDg = MotDg::first() ?? new MotDg();

        $motDg->grade_dg  = $validated['grade_dg'];
        $motDg->nom_dg    = $validated['nom_dg'];
        $motDg->prenom_dg = $validated['prenom_dg'];
        $motDg->titre_dg  = $validated['titre_dg'];
        $motDg->texte_dg  = $validated['texte_dg'];

        if ($request->hasFile('photo')) {
            $filename = 'dg_' . time() . '.' . $request->file('photo')->extension();
            $request->file('photo')->move(public_path('assets/images'), $filename);
            $motDg->photo = 'assets/images/' . $filename;
        }

        $motDg->save();

        return redirect()
            ->route('motdg')
            ->with('success', 'Le Mot du Directeur Général a été mis à jour avec succès.');
    }

    /**
     * Affiche la page publique "Mot du DG"
     */
    public function show()
    {
        $motDg = MotDg::first();

        return view('accueil.apropos.direction-general.mot-du-dg', [
            'grade_dg'  => $motDg->grade_dg  ?? '',
            'nom_dg'    => $motDg->nom_dg    ?? '',
            'prenom_dg' => $motDg->prenom_dg ?? '',
            'titre_dg'  => $motDg->titre_dg  ?? '',
            'texte_dg'  => $motDg->texte_dg  ?? '',
            'photo'     => $motDg->photo     ?? 'assets/images/default-dg.jpg',
        ]);
    }
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:4096',
        ]);

        $filename = 'motdg_editor_' . time() . '_' . uniqid() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('assets/images'), $filename);

        return response()->json([
            'location' => asset('assets/images/' . $filename),
        ]);
    }
}