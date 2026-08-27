<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FlashInfo;

class FlashinfoController extends Controller
{
    public function index()
    {
        $flashInfos = FlashInfo::orderBy('ordre', 'asc')->get();
        return view('Espace_admin.parametres.flashinfo', compact('flashInfos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
            'lien'    => 'nullable|url|max:255',
            'ordre'   => 'nullable|integer',
        ]);

        FlashInfo::create([
            'contenu'   => $request->contenu,
            'lien'      => $request->lien,
            'ordre'     => $request->ordre ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Message Flash Info ajouté avec succès.');
    }

    public function update(Request $request, FlashInfo $flashInfo)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
            'lien'    => 'nullable|url|max:255',
            'ordre'   => 'nullable|integer',
        ]);

        $flashInfo->update([
            'contenu'   => $request->contenu,
            'lien'      => $request->lien,
            'ordre'     => $request->ordre ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->back()->with('success', 'Message Flash Info mis à jour.');
    }

    public function destroy(FlashInfo $flashInfo)
    {
        $flashInfo->delete();
        return redirect()->back()->with('success', 'Message supprimé avec succès.');
    }
}
