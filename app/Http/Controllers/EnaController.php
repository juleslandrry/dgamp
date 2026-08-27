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
            'intitule'  => $d->intitule,
            'lien'      => $d->lien,
        ])->toArray();

        if (empty($ena)) {
            $ena = [['id' => null, 'reference' => '', 'intitule' => '', 'lien' => '']];
        }

        return view('Espace_admin.recrutement.ena', [
            'ena'          => $ena,
            'detection_ok' => EnaDocument::count() > 0,
        ]);
    }

    /**
     * Enregistre les modifications (update / create, sans toucher aux documents non envoyés)
     */
    public function update(Request $request)
    {
        $request->validate([
            'id'          => 'nullable|array',
            'id.*'        => 'nullable|integer|exists:ena_documents,id',
            'reference'   => 'required|array',
            'reference.*' => 'required|string|max:255',
            'intitule'    => 'required|array',
            'intitule.*'  => 'required|string|max:500',
            'lien'        => 'nullable|array',
            'lien.*'      => 'nullable|string|max:500',
            'fichier'     => 'nullable|array',
            'fichier.*'   => 'nullable|file|mimes:pdf|max:10240',
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

        $ids = $request->id ?? [];

        foreach ($request->reference as $i => $reference) {
            $intitule = $request->intitule[$i] ?? '';
            $motsCles = strtolower($reference . ' ' . $intitule); // généré automatiquement
            $lien     = $liens[$i] ?? null;
            $id       = $ids[$i] ?? null;

            $data = [
                'reference' => $reference,
                'mots_cles' => $motsCles,
                'intitule'  => $intitule,
                'ordre'     => $i,
            ];

            if ($lien) {
                $data['lien'] = $lien;
            }

            if ($id) {
                $doc = EnaDocument::find($id);
                if ($doc) {
                    $doc->update($data);
                }
            } else {
                $data['lien'] = $lien;
                EnaDocument::create($data);
            }
        }

        return redirect()
            ->route('admin.ena')
            ->with('success', 'La page ENA a été mise à jour avec succès.');
    }

    /**
     * Supprime un document individuellement
     */
    public function destroy(int $id)
    {
        EnaDocument::where('id', $id)->delete();

        return redirect()
            ->route('admin.ena')
            ->with('success', 'Le document a été supprimé.');
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