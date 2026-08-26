<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdministrateurController extends Controller
{
    /**
     * Liste des administrateurs (+ recherche + pagination)
     */
    public function index(Request $request)
    {
        $recherche = $request->input('q');

        $administrateurs = Administrateur::query()
            ->when($recherche, function ($query) use ($recherche) {
                $query->where('nom', 'like', "%{$recherche}%")
                      ->orWhere('email', 'like', "%{$recherche}%")
                      ->orWhere('titre', 'like', "%{$recherche}%");
            })
            ->orderBy('nom')
            ->paginate(10)
            ->withQueryString();

        return view('Espace_admin.administrateurs', compact('administrateurs', 'recherche'));
    }

    /**
     * Enregistrer un nouvel administrateur
     */
    public function store(Request $request)
    {
        $donnees = $request->validate([
            'nom'      => ['required', 'string', 'max:150'],
            'email'    => ['required', 'email', 'max:150', 'unique:administrateurs,email'],
            'titre'    => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'statut'   => ['required', Rule::in(['actif', 'inactif'])],
        ], [
            'email.unique' => 'Cette adresse email est déjà utilisée par un autre administrateur.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $donnees['password'] = Hash::make($donnees['password']);

        Administrateur::create($donnees);

        return redirect()
            ->route('administrateurs.index')
            ->with('succes', 'Administrateur ajouté avec succès.');
    }

    /**
     * Mettre à jour un administrateur existant
     */
    public function update(Request $request, Administrateur $administrateur)
    {
        $donnees = $request->validate([
            'nom'      => ['required', 'string', 'max:150'],
            'email'    => ['required', 'email', 'max:150', Rule::unique('administrateurs', 'email')->ignore($administrateur->id)],
            'titre'    => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'statut'   => ['required', Rule::in(['actif', 'inactif'])],
        ], [
            'email.unique' => 'Cette adresse email est déjà utilisée par un autre administrateur.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        if (!empty($donnees['password'])) {
            $donnees['password'] = Hash::make($donnees['password']);
        } else {
            unset($donnees['password']);
        }

        $administrateur->update($donnees);

        return redirect()
            ->route('administrateurs.index')
            ->with('succes', 'Administrateur modifié avec succès.');
    }

    /**
     * Supprimer un administrateur
     */
    public function destroy(Request $request, Administrateur $administrateur)
    {
        if ($request->user() && $request->user()->id === $administrateur->id) {
            return redirect()
                ->route('administrateurs.index')
                ->with('erreur', "Vous ne pouvez pas supprimer votre propre compte.");
        }

        $administrateur->delete();

        return redirect()
            ->route('administrateurs.index')
            ->with('succes', 'Administrateur supprimé avec succès.');
    }
}