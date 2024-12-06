<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StationEssence;

class StationEssenceController extends Controller
{
    /**
     * Afficher la liste des stations essence.
     */
    public function index()
    {
        $stationEssences = StationEssence::all(); // Récupère toutes les stations
        return view('stationEssences.index', compact('stationEssences')); // Vue index
    }

    /**
     * Afficher le formulaire pour créer une nouvelle station.
     */
    public function create()
    {
        return view('stationEssences.create'); // Vue pour créer une station
    }

    /**
     * Enregistrer une nouvelle station dans la base.
     */
    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate(StationEssence::$createRules);

        // Créer une nouvelle station
        StationEssence::create($validated);

        // Redirection avec message de succès
        return redirect()->route('stationEssences.index')
            ->with('success', 'Station essence créée avec succès.');
    }

    /**
     * Afficher une station spécifique.
     */
    public function show(StationEssence $stationEssence)
    {
        return view('stationEssences.show', compact('stationEssence')); // Vue avec les détails
    }

    /**
     * Afficher le formulaire pour modifier une station.
     */
    public function edit(StationEssence $stationEssence)
    {
        return view('stationEssences.edit', compact('stationEssence')); // Vue pour modifier
    }

    /**
     * Mettre à jour une station existante.
     */
    public function update(Request $request, StationEssence $stationEssence)
    {
        // Valider les données
        $validated = $request->validate(StationEssence::$createRules);

        // Mettre à jour la station avec les données validées
        $stationEssence->update($validated);

        // Redirection avec message de succès
        return redirect()->route('stationEssences.index')
            ->with('success', 'Station essence mise à jour avec succès.');
    }

    /**
     * Supprimer une station.
     */
    public function destroy(StationEssence $stationEssence)
    {
        $stationEssence->delete(); // Supprimer la station

        // Redirection avec message de succès
        return redirect()->route('stationEssences.index')
            ->with('success', 'Station essence supprimée avec succès.');
    }
}
