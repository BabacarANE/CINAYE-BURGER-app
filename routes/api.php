<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\StatistiqueController;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Auth
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user', [AuthController::class, 'user']);

// Burgers
Route::get('/burgers', [BurgerController::class, 'index']);
Route::post('/burgers', [BurgerController::class, 'store']);
Route::get('/burgers/{burger}', [BurgerController::class, 'show']);
Route::put('/burgers/{burger}', [BurgerController::class, 'update']);
Route::patch('/burgers/{burger}/archive', [BurgerController::class, 'archive']);

// Clients
Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::get('/clients/{client}', [ClientController::class, 'show']);

// Commandes
Route::get('/commandes', [CommandeController::class, 'index']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::get('/commandes/{commande}', [CommandeController::class, 'show']);
Route::put('/commandes/{commande}', [CommandeController::class, 'update']);
Route::patch('/commandes/{commande}/annuler', [CommandeController::class, 'annuler']);

// Paiements
Route::post('/commandes/{commande}/paiement', [PaiementController::class, 'store']);

// Statistiques
Route::get('/statistiques', [StatistiqueController::class, 'index']);

/*
// Routes protégées (nécessitent une authentification)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Burgers
    Route::get('/burgers', [BurgerController::class, 'index']);
    Route::post('/burgers', [BurgerController::class, 'store']);
    Route::get('/burgers/{burger}', [BurgerController::class, 'show']);
    Route::put('/burgers/{burger}', [BurgerController::class, 'update']);
    Route::patch('/burgers/{burger}/archive', [BurgerController::class, 'archive']);

    // Clients
    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::get('/clients/{client}', [ClientController::class, 'show']);

    // Commandes
    Route::get('/commandes', [CommandeController::class, 'index']);
    Route::post('/commandes', [CommandeController::class, 'store']);
    Route::get('/commandes/{commande}', [CommandeController::class, 'show']);
    Route::put('/commandes/{commande}', [CommandeController::class, 'update']);
    Route::patch('/commandes/{commande}/annuler', [CommandeController::class, 'annuler']);

    // Paiements
    Route::post('/commandes/{commande}/paiement', [PaiementController::class, 'store']);

    // Statistiques
    Route::get('/statistiques', [StatistiqueController::class, 'index']);
});
*/
