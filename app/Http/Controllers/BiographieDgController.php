<?php

namespace App\Http\Controllers;

use App\Models\Biographie;
use Illuminate\Http\Request;

class BiographieDgController extends Controller
{
    /**
     * Affiche le formulaire admin
     */
        public function edit()
    {
        $biographie = Biographie::with(['timelines', 'formations'])->first();
        $motDg      = \App\Models\MotDg::first();

        $timeline = $biographie
            ? $biographie->timelines->map(fn($t) => ['date' => $t->date, 'texte' => $t->texte])->toArray()
            : [];

        $formation = $biographie
            ? $biographie->formations->map(fn($f) => ['annee' => $f->annee, 'texte' => $f->texte])->toArray()
            : [];

        return view('Espace_admin.accueil.directeurgene.biographie', [
            'date_naissance' => $biographie->date_naissance ?? '',
            'lieu_naissance' => $biographie->lieu_naissance ?? '',
            'corps'          => $biographie->corps ?? '',
            'grade'          => $biographie->grade_classe ?? '',
            'fonction'       => $biographie->fonction_actuelle ?? '',
            'photo'          => $motDg->photo ?? 'assets/images/default-dg.jpg',
            'timeline'       => $timeline,
            'formation'      => $formation,
        ]);
    }

    /**
     * Enregistre les modifications
     */
        public function update(Request $request)
    {
    $validated = $request->validate([
        'date_naissance'      => 'required|date',
        'lieu_naissance'      => 'required|string|max:255',
        'corps'               => 'required|string|max:255',
        'grade'               => 'required|string|max:255',
        'fonction'            => 'required|string',
        'timeline_date'       => 'required|array',
        'timeline_date.*'     => 'required|string|max:100',
        'timeline_texte'      => 'required|array',
        'timeline_texte.*'    => 'required|string',
        'formation_annee'     => 'required|array',
        'formation_annee.*'   => 'required|string|max:20',
        'formation_texte'     => 'required|array',
        'formation_texte.*'   => 'required|string',
    ]);

    $biographie = Biographie::first() ?? new Biographie();

    $biographie->date_naissance    = $validated['date_naissance'];
    $biographie->lieu_naissance    = $validated['lieu_naissance'];
    $biographie->corps             = $validated['corps'];
    $biographie->grade_classe      = $validated['grade'];
    $biographie->fonction_actuelle = $validated['fonction'];
    $biographie->save();

    $biographie->timelines()->delete();
    foreach ($request->timeline_date as $i => $date) {
        $biographie->timelines()->create([
            'date'  => $date,
            'texte' => $request->timeline_texte[$i] ?? '',
            'ordre' => $i,
        ]);
    }

    $biographie->formations()->delete();
    foreach ($request->formation_annee as $i => $annee) {
        $biographie->formations()->create([
            'annee' => $annee,
            'texte' => $request->formation_texte[$i] ?? '',
            'ordre' => $i,
        ]);
    }

    return redirect()
        ->route('biodg')
        ->with('success', 'La biographie du Directeur Général a été mise à jour avec succès.');
    }

    /**
     * Affiche la page publique "Biographie du DG"
     */
    public function show()
    {
    $biographie = Biographie::with(['timelines', 'formations'])->first();
    $motDg      = \App\Models\MotDg::first();

    return view('accueil.apropos.direction-general.biographie-du-dg', [
        'nom'            => $motDg->nom_dg ?? '',
        'prenoms'        => $motDg->prenom_dg ?? '',
        'date_naissance' => $biographie->date_naissance ?? '',
        'lieu_naissance' => $biographie->lieu_naissance ?? '',
        'corps'          => $biographie->corps ?? '',
        'grade'          => $biographie->grade_classe ?? '',
        'fonction'       => $biographie->fonction_actuelle ?? '',
        'photo'          => $motDg->photo ?? 'assets/images/default-dg.jpg',
        'timeline'       => $biographie ? $biographie->timelines : collect(),
        'formation'      => $biographie ? $biographie->formations : collect(),
    ]);
    }
}