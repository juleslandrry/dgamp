<?php

namespace App\Http\Controllers;

use App\Models\ServiceEnLigne;
use Illuminate\Http\Request;

class ServiceEnLigneController extends Controller
{
    protected array $accents = ['navy', 'blue', 'orange', 'green', 'gold'];
    protected array $icons = ['folder', 'stamp', 'shield', 'anchor', 'booklet', 'wheel', 'gear-ship'];

    public function edit()
    {
        $services = ServiceEnLigne::orderBy('ordre')->get()->map(fn($s) => [
            'id'            => $s->id,
            'badge'         => $s->badge,
            'titre'         => $s->titre,
            'description'   => $s->description,
            'bouton_texte'  => $s->bouton_texte,
            'detail_texte'  => $s->detail_texte,
            'detail_points' => implode("\n", $s->detail_points ?? []),
            'accent'        => $s->accent ?: 'navy',
            'icon'          => $s->icon ?: 'folder',
            'lien'          => $s->lien ?: '#',
        ])->toArray();

        return view('Espace_admin.service_ligne', [
            'services' => $services,
            'accents'  => $this->accents,
            'icons'    => $this->icons,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'              => 'required|array',
            'badge'           => 'required|array',
            'badge.*'         => 'required|string|max:100',
            'titre'           => 'required|array',
            'titre.*'         => 'required|string|max:255',
            'description'     => 'required|array',
            'description.*'   => 'required|string|max:5000',
            'bouton_texte'    => 'required|array',
            'bouton_texte.*'  => 'required|string|max:100',
            'accent'          => 'required|array',
            'accent.*'        => 'required|string|in:navy,blue,orange,green,gold',
            'icon'            => 'required|array',
            'icon.*'          => 'required|string',
            'lien'            => 'nullable|array',
            'lien.*'          => 'nullable|string|max:500',
            'detail_texte'    => 'nullable|array',
            'detail_texte.*'  => 'nullable|string',
            'detail_points'   => 'nullable|array',
            'detail_points.*' => 'nullable|string',
        ]);

        foreach ($request->id as $i => $id) {
            $pointsRaw = $request->detail_points[$i] ?? '';
            $points = collect(explode("\n", $pointsRaw))->map(fn($p) => trim($p))->filter()->values()->all();

            $data = [
                'badge'         => $request->badge[$i] ?? '',
                'titre'         => $request->titre[$i] ?? '',
                'description'   => $request->description[$i] ?? '',
                'bouton_texte'  => $request->bouton_texte[$i] ?? '',
                'accent'        => $request->accent[$i] ?? 'navy',
                'icon'          => $request->icon[$i] ?? 'folder',
                'lien'          => $request->lien[$i] ?: '#',
                'detail_texte'  => $request->detail_texte[$i] ?? '',
                'detail_points' => $points,
                'ordre'         => $i,
            ];

            if ($id) {
                $service = ServiceEnLigne::find($id);
                if ($service) {
                    $service->update($data);
                }
            } else {
                $data['cle']  = $data['titre'];
                $data['slug'] = ServiceEnLigne::generateUniqueSlug($data['titre']);
                ServiceEnLigne::create($data);
            }
        }

        return redirect()
            ->route('services-en-ligne')
            ->with('success', 'Les services en ligne ont été mis à jour avec succès.');
    }

    public function destroy(int $id)
    {
        $service = ServiceEnLigne::find($id);

        if ($service) {
            $service->delete();
        }

        return redirect()
            ->route('services-en-ligne')
            ->with('success', 'Le service a été supprimé.');
    }

    public function show(string $slug)
    {
        $service = ServiceEnLigne::where('slug', $slug)->firstOrFail();

        return view('service-en-ligne.show', ['service' => $service]);
    }
}