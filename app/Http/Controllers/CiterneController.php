<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citerne;
use App\Models\StationEssence;
use App\Models\Carburant;

class CiterneController extends Controller
{
    /**
     * Afficher la liste des citernes.
     */
    public function index()
    {
        $citernes = Citerne::with('stationEssence', 'carburant')->get(); // Charger les relations
        return view('citernes.index', compact('citernes'));
    }

    /**
     * Afficher le formulaire pour créer une nouvelle citerne.
     */
    public function create()
    {
        $stations = StationEssence::all(); // Récupère toutes les stations
        $carburants = Carburant::all(); // Récupère tous les carburants
        return view('citernes.create', compact('stations', 'carburants'));
    }

    /**
     * Enregistrer une nouvelle citerne dans la base.
     */
    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'station_essence_id' => 'required|exists:station_essences,id',
            'carburant_id' => 'required|exists:carburants,id',
            'capacite' => 'required|numeric|min:1000|max:5000',
            'qte_carburant' => 'required|numeric|min:0|max:capacite',
        ]);

        // Créer une nouvelle citerne
        Citerne::create($validated);

        // Redirection avec un message de succès
        return redirect()->route('citernes.index')
            ->with('success', 'Citerne créée avec succès.');
    }

    /**
     * Afficher une citerne spécifique.
     */
    public function show(Citerne $citerne)
    {
        return view('citernes.show', compact('citerne'));
    }

    /**
     * Afficher le formulaire pour modifier une citerne.
     */
    public function edit(Citerne $citerne)
    {
        $stations = StationEssence::all(); // Récupère toutes les stations
        $carburants = Carburant::all(); // Récupère tous les carburants
        return view('citernes.edit', compact('citerne', 'stations', 'carburants'));
    }

    /**
     * Mettre à jour une citerne existante.
     */
    public function update(Request $request, Citerne $citerne)
    {
        // Valider les données
        $validated = $request->validate([
            'station_essence_id' => 'required|exists:station_essences,id',
            'carburant_id' => 'required|exists:carburants,id',
            'capacite' => 'required|numeric|min:1000|max:5000',
            'qte_carburant' => 'required|numeric|min:0|max:capacite',
        ]);

        // Mettre à jour la citerne
        $citerne->update($validated);

        // Redirection avec un message de succès
        return redirect()->route('citernes.index')
            ->with('success', 'Citerne mise à jour avec succès.');
    }

    /**
     * Supprimer une citerne.
     */
    public function destroy(Citerne $citerne)
    {
        $citerne->delete(); // Supprimer la citerne

        // Redirection avec un message de succès
        return redirect()->route('citernes.index')
            ->with('success', 'Citerne supprimée avec succès.');
    }
}
