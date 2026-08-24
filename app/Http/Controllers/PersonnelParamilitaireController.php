<?php

namespace App\Http\Controllers;

use App\Models\PersonnelParamilitaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonnelParamilitaireController extends Controller
{
    /**
     * Page publique.
     */
    public function show()
    {
        $data = PersonnelParamilitaire::first();

        return view('personnel.personnel-paramilitaire', ['data' => $data]);
    }

    /**
     * Formulaire admin.
     */
    public function edit()
    {
        $data = PersonnelParamilitaire::first();

        return view('Espace_admin.nos-personnel.personnel_paramilitaire', ['data' => $data]);
    }

    /**
     * Enregistrement admin.
     */
    public function update(Request $request)
    {
        $request->validate([
            'badge'             => 'nullable|string|max:100',
            'titre'             => 'required|string|max:255',
            'hero_description'  => 'nullable|string|max:1000',
            'hero_image'        => 'nullable|image|max:4096',
            'section_titre'     => 'required|string|max:255',
            'section_texte'     => 'required|string',
            'section_image'     => 'nullable|image|max:4096',
            'section_points'    => 'nullable|string',
        ]);

        $data = PersonnelParamilitaire::first();

        $payload = [
            'badge'            => $request->badge,
            'titre'            => $request->titre,
            'hero_description' => $request->hero_description,
            'section_titre'    => $request->section_titre,
            'section_texte'    => $request->section_texte,
            'section_points'   => collect(explode("\n", $request->section_points ?? ''))
                ->map(fn($p) => trim($p))
                ->filter()
                ->values()
                ->all(),
        ];

        if ($request->hasFile('hero_image')) {
            if ($data && $data->hero_image) {
                Storage::disk('public')->delete($data->hero_image);
            }
            $payload['hero_image'] = $request->file('hero_image')->store('personnel', 'public');
        }

        if ($request->hasFile('section_image')) {
            if ($data && $data->section_image) {
                Storage::disk('public')->delete($data->section_image);
            }
            $payload['section_image'] = $request->file('section_image')->store('personnel', 'public');
        }

        PersonnelParamilitaire::updateOrCreate(['id' => 1], $payload);

        return redirect()
            ->route('admin.personnel-paramilitaire')
            ->with('success', 'La page Personnel Paramilitaire a été mise à jour avec succès.');
    }
}