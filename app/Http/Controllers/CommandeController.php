<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Commande;
use App\Models\Client;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::query();

        if ($request->has('burger_id')) {
            $query->where('burger_id', $request->burger_id);
        }
        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }
        if ($request->has('etat')) {
            $query->where('etat', $request->etat);
        }
        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'burger_id' => 'required|exists:burgers,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $burger = Burger::findOrFail($validatedData['burger_id']);
        $validatedData['prix_total'] = $burger->prix * $validatedData['quantite'];

        return Commande::create($validatedData);
    }

    public function show(Commande $commande)
    {
        return $commande->load('client', 'burger');
    }

    public function update(Request $request, Commande $commande)
    {
        $validatedData = $request->validate([
            'etat' => 'required|in:en_cours,terminee,payee,annulee',
        ]);

        $commande->update($validatedData);

        if ($commande->etat === 'terminee') {
            // Envoyer l'email avec la facture
            // Vous devrez implémenter cette logique
        }

        return $commande;
    }

    public function annuler(Commande $commande)
    {
        $commande->etat = 'annulee';
        $commande->save();
        return response()->json(['message' => 'Commande annulée']);
    }
}
