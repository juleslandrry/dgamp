<?php

namespace App\Http\Controllers;

use App\Models\MessageDg;
use Illuminate\Http\Request;

class MessageDgController extends Controller
{
    // Formulaire "Écrire au DG"
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['destination'] = 'dg';

        MessageDg::create($validated);

        return back()->with('success', 'Votre message a bien été envoyé au Directeur Général.');
    }

    // Formulaire "Contactez-nous" (footer / page contact générale)
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['destination'] = 'dgamp';

        MessageDg::create($validated);

        return back()->with('success', 'Votre message a bien été envoyé à la DGAMP.');
    }

    // Liste des messages côté admin (les deux destinations)
    public function index(Request $request)
{
    $filter = $request->query('destination');

    $messages = MessageDg::when($filter, function ($query) use ($filter) {
            $query->where('destination', $filter);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15)
        ->withQueryString();

    $totalTous = MessageDg::count();

    return view('Espace_admin.accueil.directeurgene.messages-dg', compact('messages', 'filter', 'totalTous'));
}

    public function markAsRead($id)
    {
        MessageDg::where('id', $id)->update(['lu' => true]);
        return back();
    }

    public function destroy($id)
    {
        MessageDg::findOrFail($id)->delete();
        return back()->with('success', 'Message supprimé.');
    }
}