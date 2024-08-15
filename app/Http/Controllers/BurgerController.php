<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use Illuminate\Http\Request;

class BurgerController extends Controller
{
    public function index()
    {
        return Burger::where('est_archive', false)->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        return Burger::create($validatedData);
    }

    public function show(Burger $burger)
    {
        return $burger;
    }

    public function update(Request $request, Burger $burger)
    {
        $validatedData = $request->validate([
            'nom' => 'string|max:255',
            'prix' => 'numeric|min:0',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $burger->update($validatedData);
        return $burger;
    }

    public function archive(Burger $burger)
    {
        $burger->est_archive = true;
        $burger->save();
        return response()->json(['message' => 'Burger archivé']);
    }
}
