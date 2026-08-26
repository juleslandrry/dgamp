<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParametreController extends Controller
{
    public function index()
    {
        // Récupère la première ligne ou en crée une vide
        $setting = Configuration::first() ?? new Configuration();

        return view('Espace_admin.parametres.configuration', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telephone'      => 'nullable|string|max:50',
            'boite_postale'  => 'nullable|string|max:255',
            'email'          => 'nullable|email|max:255',
            'adresse'        => 'nullable|string|max:255',
            'lien_maps'      => 'nullable|string',
            'facebook'       => 'nullable|url|max:255',
            'twitter'        => 'nullable|url|max:255',
            'youtube'        => 'nullable|url|max:255',
            'linkedin'       => 'nullable|url|max:255',
            'logo_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:2048',
            'logo_connexion' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:2048',
            'favicon'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg,ico|max:1024',
        ]);

        $setting = Configuration::first();

        if (!$setting) {
            $setting = new Configuration();
        }

        $data = $request->only([
            'telephone', 'boite_postale', 'email', 'adresse', 'lien_maps',
            'facebook', 'twitter', 'youtube', 'linkedin'
        ]);

        // Traitement des images
        $files = ['logo_principal', 'logo_connexion', 'favicon'];
        foreach ($files as $fileKey) {
            if ($request->hasFile($fileKey)) {
                if ($setting->$fileKey && Storage::disk('public')->exists($setting->$fileKey)) {
                    Storage::disk('public')->delete($setting->$fileKey);
                }
                $data[$fileKey] = $request->file($fileKey)->store('settings', 'public');
            }
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Les paramètres d\'apparence ont été mis à jour avec succès.');
    }
}
