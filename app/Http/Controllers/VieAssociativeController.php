<?php

namespace App\Http\Controllers;

use App\Models\VieAssociativeCard;
use App\Models\VieAssociativePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VieAssociativeController extends Controller
{
    /**
     * Configuration des 3 pages : libellés admin + quelles sections afficher.
     */
    protected function config(): array
    {
        return [
            'prevoyance' => [
                'label'       => 'Fonds de Prévoyance',
                'view_public' => 'vie-associative.fond-prevoyance',
                'has_stats'   => true,
                'has_tags'    => false,
                'has_cta'     => true,
            ],
            'vie-sociale' => [
                'label'       => 'Vie Sociale',
                'view_public' => 'vie-associative.vie-sociale',
                'has_stats'   => false,
                'has_tags'    => true,
                'has_cta'     => true,
            ],
            'autres-associations' => [
                'label'       => 'Autres Associations',
                'view_public' => 'vie-associative.autres-associations',
                'has_stats'   => false,
                'has_tags'    => false,
                'has_cta'     => false,
            ],
        ];
    }

    protected function resolveType(string $type): array
    {
        $config = $this->config();

        if (!isset($config[$type])) {
            throw new NotFoundHttpException();
        }

        return $config[$type];
    }

    /**
     * Pages publiques (une méthode par route existante).
     */
    public function showPrevoyance()
    {
        return $this->renderPublic('prevoyance');
    }

    public function showVieSociale()
    {
        return $this->renderPublic('vie-sociale');
    }

    public function showAutresAssociations()
    {
        return $this->renderPublic('autres-associations');
    }

    protected function renderPublic(string $type)
    {
        $meta = $this->resolveType($type);
        $page = VieAssociativePage::with('cards')->where('type', $type)->first();

        return view($meta['view_public'], ['page' => $page]);
    }

    /**
     * Formulaire admin.
     */
    public function edit(string $type)
    {
        $meta = $this->resolveType($type);
        $page = VieAssociativePage::with('cards')->where('type', $type)->first();

        return view('Espace_admin.vie-associative.edit', [
            'type' => $type,
            'meta' => $meta,
            'page' => $page,
            'cards' => $page ? $page->cards : collect(),
        ]);
    }

    /**
     * Enregistrement du contenu de la page (badge, titre, intro, cta...).
     */
    public function update(Request $request, string $type)
    {
        $meta = $this->resolveType($type);

        $request->validate([
            'badge'             => 'nullable|string|max:100',
            'titre'             => 'required|string|max:255',
            'lead'              => 'nullable|string|max:500',
            'intro_titre'       => 'nullable|string|max:255',
            'intro_texte'       => 'nullable|string',
            'intro_image'       => 'nullable|image|max:4096',
            'checklist'         => 'nullable|string',
            'stat1_val'         => 'nullable|string|max:50',
            'stat1_lab'         => 'nullable|string|max:100',
            'stat2_val'         => 'nullable|string|max:50',
            'stat2_lab'         => 'nullable|string|max:100',
            'tags'              => 'nullable|string',
            'cta_titre'         => 'nullable|string|max:255',
            'cta_texte'         => 'nullable|string|max:500',
            'cta_bouton_texte'  => 'nullable|string|max:100',
            'cta_bouton_lien'   => 'nullable|string|max:500',
        ]);

        $page = VieAssociativePage::where('type', $type)->first();

        $payload = [
            'type'             => $type,
            'badge'            => $request->badge,
            'titre'            => $request->titre,
            'lead'             => $request->lead,
            'intro_titre'      => $request->intro_titre,
            'intro_texte'      => $request->intro_texte,
            'checklist'        => $this->linesToArray($request->checklist),
            'stat1_val'        => $request->stat1_val,
            'stat1_lab'        => $request->stat1_lab,
            'stat2_val'        => $request->stat2_val,
            'stat2_lab'        => $request->stat2_lab,
            'tags'             => $this->linesToArray($request->tags),
            'cta_titre'        => $request->cta_titre,
            'cta_texte'        => $request->cta_texte,
            'cta_bouton_texte' => $request->cta_bouton_texte,
            'cta_bouton_lien'  => $request->cta_bouton_lien,
        ];

        if ($request->hasFile('intro_image')) {
            if ($page && $page->intro_image) {
                Storage::disk('public')->delete($page->intro_image);
            }
            $payload['intro_image'] = $request->file('intro_image')->store('vie-associative', 'public');
        }

        VieAssociativePage::updateOrCreate(['type' => $type], $payload);

        return redirect()
            ->route('admin.vie-associative.edit', $type)
            ->with('success', $meta['label'] . ' a été mis à jour avec succès.');
    }

    /**
     * Enregistrement des cartes (ajout, modification en masse).
     */
    public function updateCards(Request $request, string $type)
    {
        $meta = $this->resolveType($type);
        $page = VieAssociativePage::where('type', $type)->first();

        if (!$page) {
            return redirect()->route('admin.vie-associative.edit', $type)
                ->with('error', "Enregistre d'abord le contenu principal de la page avant d'ajouter des cartes.");
        }

        $request->validate([
            'card_id'          => 'nullable|array',
            'card_titre'       => 'required|array',
            'card_titre.*'     => 'required|string|max:150',
            'card_couleur'     => 'required|array',
            'card_couleur.*'   => 'required|string|in:orange,vert,violet',
            'card_description' => 'nullable|array',
            'card_points'      => 'nullable|array',
        ]);

        foreach ($request->card_titre as $i => $titre) {
            $id = $request->card_id[$i] ?? null;

            $data = [
                'vie_associative_page_id' => $page->id,
                'titre'                   => $titre,
                'couleur'                 => $request->card_couleur[$i] ?? 'orange',
                'description'             => $request->card_description[$i] ?? null,
                'points'                  => $this->linesToArray($request->card_points[$i] ?? ''),
                'ordre'                   => $i,
            ];

            if ($id) {
                $card = VieAssociativeCard::find($id);
                if ($card) {
                    $card->update($data);
                }
            } else {
                VieAssociativeCard::create($data);
            }
        }

        return redirect()
            ->route('admin.vie-associative.edit', $type)
            ->with('success', 'Les cartes de ' . $meta['label'] . ' ont été mises à jour.');
    }

    /**
     * Suppression d'une carte.
     */
    public function destroyCard(string $type, int $id)
    {
        $card = VieAssociativeCard::find($id);

        if ($card) {
            $card->delete();
        }

        return redirect()
            ->route('admin.vie-associative.edit', $type)
            ->with('success', 'La carte a été supprimée.');
    }

    protected function linesToArray(?string $text): array
    {
        return collect(explode("\n", $text ?? ''))
            ->map(fn($l) => trim($l))
            ->filter()
            ->values()
            ->all();
    }
}