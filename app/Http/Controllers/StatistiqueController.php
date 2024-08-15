<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $commandesEnCours = Commande::where('etat', 'en_cours')
            ->whereDate('created_at', $today)
            ->count();

        $commandesValidees = Commande::where('etat', 'terminee')
            ->whereDate('created_at', $today)
            ->count();

        $recettesJournalieres = Commande::where('etat', 'payee')
            ->whereDate('created_at', $today)
            ->sum('prix_total');

        $commandesAnnulees = Commande::where('etat', 'annulee')
            ->whereDate('created_at', $today)
            ->count();

        return [
            'commandes_en_cours' => $commandesEnCours,
            'commandes_validees' => $commandesValidees,
            'recettes_journalieres' => $recettesJournalieres,
            'commandes_annulees' => $commandesAnnulees,
        ];
    }
}
