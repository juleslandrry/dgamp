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
     * Libellés admin pour chacune des 3 pages.
     */
    protected function config(): array
    {
        return [
            'prevoyance' => [
                'label'       => 'Fonds de Prévoyance',
                'view_public' => 'vie-associative.fond-prevoyance',
            ],
            'vie-sociale' => [
                'label'       => 'Vie Sociale',
                'view_public' => 'vie-associative.vie-sociale',
            ],
            'autres-associations' => [
                'label'       => 'Autres Associations',
                'view_public' => 'vie-associative.autres-associations',
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
     * Pages publiques.
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
            'type'  => $type,
            'meta'  => $meta,
            'page'  => $page,
            'items' => $page ? $page->cards : collect(),
        ]);
    }

    /**
     * Un seul enregistrement : contenu de la page + liste d'informations.
     */
    public function update(Request $request, string $type)
    {
        $meta = $this->resolveType($type);

        $request->validate([
            'badge'          => 'nullable|string|max:100',
            'titre'          => 'required|string|max:255',
            'lead'           => 'nullable|string|max:500',
            'intro_titre'    => 'nullable|string|max:255',
            'intro_texte'    => 'nullable|string',
            'intro_image'    => 'nullable|image|max:4096',
            'item_titre'     => 'nullable|array',
            'item_titre.*'   => 'required|string|max:150',
            'item_description'   => 'nullable|array',
            'item_description.*' => 'nullable|string|max:1000',
        ]);

        $page = VieAssociativePage::where('type', $type)->first();

        $payload = [
            'type'        => $type,
            'badge'       => $request->badge,
            'titre'       => $request->titre,
            'lead'        => $request->lead,
            'intro_titre' => $request->intro_titre,
            'intro_texte' => $request->intro_texte,
        ];

        if ($request->hasFile('intro_image')) {
            if ($page && $page->intro_image) {
                Storage::disk('public')->delete($page->intro_image);
            }
            $payload['intro_image'] = $request->file('intro_image')->store('vie-associative', 'public');
        }

        $page = VieAssociativePage::updateOrCreate(['type' => $type], $payload);

        // Synchronise la liste d'informations : garde ce qui est soumis, supprime le reste.
        $submittedIds = [];

        foreach ($request->input('item_titre', []) as $i => $titre) {
            $id = $request->input('item_id.' . $i);

            $data = [
                'vie_associative_page_id' => $page->id,
                'titre'                   => $titre,
                'description'             => $request->input('item_description.' . $i),
                'ordre'                   => $i,
            ];

            if ($id) {
                $item = VieAssociativeCard::find($id);
                if ($item) {
                    $item->update($data);
                    $submittedIds[] = $item->id;
                }
            } else {
                $item = VieAssociativeCard::create($data);
                $submittedIds[] = $item->id;
            }
        }

        VieAssociativeCard::where('vie_associative_page_id', $page->id)
            ->whereNotIn('id', $submittedIds)
            ->delete();

        return redirect()
            ->route('admin.vie-associative.edit', $type)
            ->with('success', $meta['label'] . ' a été mis à jour avec succès.');
    }
}