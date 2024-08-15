<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function store(Request $request, Commande $commande)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric|min:0',
        ]);

        $validatedData['commande_id'] = $commande->id;
        $validatedData['date_paiement'] = now();

        $paiement = Paiement::create($validatedData);

        $commande->etat = 'payee';
        $commande->save();

        return $paiement;
    }
}
