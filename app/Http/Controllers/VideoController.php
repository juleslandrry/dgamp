<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function edit()
    {
        $videos = Video::orderBy('ordre')->get()->map(fn($v) => [
            'id'    => $v->id,
            'url'   => $v->url,
            'titre' => $v->titre,
        ])->toArray();

        if (empty($videos)) {
            $videos = [['id' => null, 'url' => '', 'titre' => '']];
        }

        return view('Espace_admin.multimedia.video', [
            'videos'       => $videos,
            'detection_ok' => Video::count() > 0,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'      => 'nullable|array',
            'id.*'    => 'nullable|integer|exists:videos,id',
            'url'     => 'required|array',
            'url.*'   => 'required|string|max:500',
            'titre'   => 'required|array',
            'titre.*' => 'required|string|max:500',
        ]);

        $ids = $request->id ?? [];
        $idsGardes = [];

        foreach ($request->url as $i => $url) {
            $data = [
                'url'   => $url,
                'titre' => $request->titre[$i] ?? '',
                'ordre' => $i,
            ];

            $id = $ids[$i] ?? null;

            if ($id) {
                $video = Video::find($id);
                if ($video) {
                    $video->update($data);
                    $idsGardes[] = $video->id;
                }
            } else {
                $nouveau = Video::create($data);
                $idsGardes[] = $nouveau->id;
            }
        }

        Video::whereNotIn('id', $idsGardes)->delete();

        return redirect()
            ->route('videos')
            ->with('success', 'La page Vidéos a été mise à jour avec succès.');
    }

    public function show()
    {
        $videos = Video::orderBy('ordre')->get();

        return view('multimedia.galerie-vidéo', [
            'videos' => $videos,
        ]);
    }
}