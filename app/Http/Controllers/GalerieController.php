<?php

namespace App\Http\Controllers;

use App\Models\GalerieAlbum;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    public function edit()
    {
        $albums = GalerieAlbum::orderBy('ordre')->get()->map(fn($a) => [
            'db_id'       => $a->id,
            'id'          => $a->album_id,
            'titre'       => $a->titre,
            'date'        => $a->date ? $a->date->format('Y-m-d') : '',
            'popup_titre' => $a->popup_titre,
            'popup_sous'  => $a->popup_sous,
            'cover'       => $a->cover,
            'badge'       => count($a->photos ?? []) . ' Photos',
            'photos'      => $a->photos ?? [],
        ])->toArray();

        if (empty($albums)) {
            $albums = [[
                'db_id' => null, 'id' => '', 'titre' => '', 'date' => '', 'popup_titre' => '',
                'popup_sous' => '', 'cover' => '', 'badge' => '0 Photos', 'photos' => [],
            ]];
        }

        return view('Espace_admin.multimedia.image', [
            'albums'       => $albums,
            'detection_ok' => GalerieAlbum::count() > 0,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'db_id'               => 'nullable|array',
            'album_id'            => 'required|array',
            'album_id.*'          => 'required|string|max:100|alpha_dash',
            'titre'               => 'required|array',
            'titre.*'             => 'required|string|max:500',
            'date'                => 'required|array',
            'date.*'              => 'required|date',
            'popup_titre'         => 'required|array',
            'popup_titre.*'       => 'required|string|max:255',
            'popup_sous'          => 'required|array',
            'popup_sous.*'        => 'required|string|max:255',
            'cover_actuelle'      => 'required|array',
            'cover'               => 'nullable|array',
            'cover.*'             => 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
            'photos_actuelles'    => 'required|array',
            'nouvelles_photos'    => 'nullable|array',
            'nouvelles_photos.*'  => 'nullable|array',
            'nouvelles_photos.*.*'=> 'nullable|image|mimes:jpeg,jpg,png,webp|max:4096',
        ]);

        $covers = $request->cover_actuelle;
        if ($request->hasFile('cover')) {
            foreach ($request->file('cover') as $i => $file) {
                if ($file) {
                    $filename = 'album_cover_' . time() . '_' . $i . '.' . $file->extension();
                    $file->move(public_path('assets/images'), $filename);
                    $covers[$i] = 'assets/images/' . $filename;
                }
            }
        }

        $dbIds = $request->db_id ?? [];
        $idsGardes = [];

        foreach ($request->album_id as $i => $albumId) {
            $photosExistantes = json_decode($request->photos_actuelles[$i] ?? '[]', true) ?: [];

            $nouvellesPhotos = [];
            if ($request->hasFile("nouvelles_photos.$i")) {
                foreach ($request->file("nouvelles_photos")[$i] ?? [] as $j => $file) {
                    if ($file) {
                        $filename = 'album_photo_' . time() . '_' . $i . '_' . $j . '.' . $file->extension();
                        $file->move(public_path('assets/images'), $filename);
                        $nouvellesPhotos[] = 'assets/images/' . $filename;
                    }
                }
            }

            $data = [
                'album_id'    => $albumId,
                'titre'       => $request->titre[$i] ?? '',
                'date'        => $request->date[$i] ?? '',
                'popup_titre' => $request->popup_titre[$i] ?? '',
                'popup_sous'  => $request->popup_sous[$i] ?? '',
                'cover'       => $covers[$i] ?? null,
                'photos'      => array_merge($photosExistantes, $nouvellesPhotos),
                'ordre'       => $i,
            ];

            $id = $dbIds[$i] ?? null;

            if ($id) {
                $album = GalerieAlbum::find($id);
                if ($album) {
                    $album->update($data);
                    $idsGardes[] = $album->id;
                }
            } else {
                $nouveau = GalerieAlbum::create($data);
                $idsGardes[] = $nouveau->id;
            }
        }

        GalerieAlbum::whereNotIn('id', $idsGardes)->delete();

        return redirect()
            ->route('galerie')
            ->with('success', 'La galerie a été mise à jour avec succès.');
    }

    public function show()
    {
        $albums = GalerieAlbum::orderBy('ordre')->get();

        return view('multimedia.galerie-img', [
            'albums' => $albums,
        ]);
    }
}