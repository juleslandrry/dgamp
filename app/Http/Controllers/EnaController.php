<?php

namespace App\Http\Controllers;

use App\Models\EnaDocument;
use Illuminate\Http\Request;

class EnaController extends Controller
{
    /**
     * Formulaire admin
     */
    public function edit()
    {
        $ena = EnaDocument::orderBy('ordre')->get()->map(fn($d) => [
            'id'        => $d->id,
            'reference' => $d->reference,
            'mots_cles' => $d->mots_cles,
            'intitule'  => $d->intitule,
            'lien'      => $d->lien,
        ])->toArray();

        if (empty($ena)) {
            $ena = [['id' => null, 'reference' => '', 'mots_cles' => '', 'intitule' => '', 'lien' => '']];
        }

        return view('Espace_admin.recrutement.ena', [
            'ena'          => $ena,
            'detection_ok' => EnaDocument::count() > 0,
        ]);
    }

    /**
     * Enregistre les modifications (remplace toute la liste)
     */
    public function update(Request $request)
    {
        $request->validate([
            'reference'       => 'required|array',
            'reference.*'     => 'required|string|max:255',
            'intitule'        => 'required|array',
            'intitule.*'      => 'required|string|max:500',
            'mots_cles'       => 'nullable|array',
            'mots_cles.*'     => 'nullable|string|max:255',
            'lien'            => 'nullable|array',
            'lien.*'          => 'nullable|string|max:500',
            'fichier'         => 'nullable|array',
            'fichier.*'       => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $liens = $request->lien ?? [];

        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $i => $file) {
                if ($file) {
                    $filename = 'ena_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $liens[$i] = 'assets/images/' . $filename;
                }
            }
        }

        // On remplace entièrement la liste (simple et fiable pour un formulaire dynamique)
        EnaDocument::truncate();

        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = $request->mots_cles[$i] ?? strtolower($reference . ' ' . $intitule);
            $lien     = $liens[$i] ?? null;

            EnaDocument::create([
                'reference'  => $reference,
                'mots_cles'  => $motsCles,
                'intitule'   => $intitule,
                'lien'       => $lien,
                'ordre'      => $i,
            ]);
        }

        return redirect()
            ->route('admin.ena')
            ->with('success', 'La page ENA a été mise à jour avec succès.');
    }

    /**
     * Page publique
     */
    public function show()
    {
        $documents = EnaDocument::orderBy('ordre')->get();

        return view('accueil.recrutement.ena', [
            'documents' => $documents,
        ]);
    }
}