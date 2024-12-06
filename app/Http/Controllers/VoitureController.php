<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiture;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voitures = Voiture::all(); // Récupère toutes les voitures
        return view('voitures.index', compact('voitures')); // Renvoie à la vue index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('voitures.create'); // Vue pour créer une voiture
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate(Voiture::$createRules);

        // Créer une nouvelle voiture avec les données validées
        Voiture::create($validated);

        // Rediriger vers la liste des voitures avec un message de succès
        return redirect()->route('voitures.index')
            ->with('success', 'Voiture créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voiture $voiture)
    {
        return view('voitures.show', compact('voiture')); // Vue avec les détails
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voiture $voiture)
    {
        return view('voitures.edit', compact('voiture')); // Vue pour modifier une voiture
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voiture $voiture)
    {
        // Valider les données
        $validated = $request->validate(Voiture::$createRules);

        // Mettre à jour la voiture avec les données validées
        $voiture->update($validated);

        // Rediriger avec un message de succès
        return redirect()->route('voitures.index')
            ->with('success', 'Voiture mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voiture $voiture)
    {
        $voiture->delete(); // Supprime la voiture

        // Redirige avec un message de succès
        return redirect()->route('voitures.index')
            ->with('success', 'Voiture supprimée avec succès.');
    }
}
