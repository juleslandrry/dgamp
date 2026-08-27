<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdministrateurController extends Controller
{
    public function connexion() {
        return view('Espace_admin.connexion');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();
            $admin->update(['derniere_connexion' => now()]);

            return redirect()->intended(route('accueiladmin'));
        }

        return back()->withErrors([
            'email' => 'Identifiant ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('connexion');
    }

    public function index(Request $request)
    {
        $query = Administrateur::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%")
                  ->orWhere('titre', 'like', "%{$search}%");
            });
        }

        $administrateurs = $query->latest()->paginate(10);

        return view('Espace_admin.administrateurs', compact('administrateurs'));
    }

    /**
     * Enregistre un nouvel administrateur.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'      => 'required|string|max:255',
            'email'    => 'required|email|unique:administrateurs,email',
            'contact'  => 'nullable|string|max:50',
            'titre'    => 'required|string|max:100',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('administrateurs', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);

        // Plus de gestion du champ statut ici

        Administrateur::create($validated);

        return redirect()->route('administrateurs.index')
            ->with('succes', 'Administrateur créé avec succès.');
    }

    /**
     * Met à jour les informations d'un administrateur.
     */
    public function update(Request $request, Administrateur $administrateur)
    {
        $validated = $request->validate([
            'nom'      => 'required|string|max:255',
            'email'    => 'required|email|unique:administrateurs,email,' . $administrateur->id,
            'contact'  => 'nullable|string|max:50',
            'titre'    => 'required|string|max:100',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('photo')) {
            if ($administrateur->photo && Storage::disk('public')->exists($administrateur->photo)) {
                Storage::disk('public')->delete($administrateur->photo);
            }
            $validated['photo'] = $request->file('photo')->store('administrateurs', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Plus de gestion du champ statut ici

        $administrateur->update($validated);

        return redirect()->route('administrateurs.index')
            ->with('succes', 'Administrateur mis à jour avec succès.');
    }

    /**
     * Supprime un administrateur.
     */
    public function destroy(Administrateur $administrateur)
    {
        if ($administrateur->photo && Storage::disk('public')->exists($administrateur->photo)) {
            Storage::disk('public')->delete($administrateur->photo);
        }

        $administrateur->delete();

        return redirect()->route('administrateurs.index')
            ->with('succes', 'Administrateur supprimé avec succès.');
    }

    /**
     * Afficher le profil de l'administrateur connecté
     */
    public function editerProfil()
    {
        $admin = Auth::guard('admin')->user();
        return view('Espace_admin.editer_profil', compact('admin'));
    }

    /**
     * Mettre à jour le profil de l'administrateur connecté
     */
    public function updateProfil(Request $request)
    {
        /** @var Administrateur $admin */
        $admin = Auth::guard('admin')->user();

        $donnees = $request->validate([
            'nom'      => ['required', 'string', 'max:150'],
            'email'    => ['required', 'email', 'max:150', Rule::unique('administrateurs', 'email')->ignore($admin->id)],
            'contact'  => ['nullable', 'string', 'max:30'],
            'photo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        if ($request->hasFile('photo')) {
            if ($admin->photo && Storage::disk('public')->exists($admin->photo)) {
                Storage::disk('public')->delete($admin->photo);
            }
            $donnees['photo'] = $request->file('photo')->store('administrateurs', 'public');
        }

        if (!empty($donnees['password'])) {
            $donnees['password'] = Hash::make($donnees['password']);
        } else {
            unset($donnees['password']);
        }

        $admin->update($donnees);

        return back()->with('succes', 'Votre profil a été mis à jour avec succès.');
    }
}