<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carburant;

class CarburantController extends Controller
{
    /**
     * Afficher la liste des carburants.
     */
    public function index()
    {
        $carburants = Carburant::all(); // Récupère tous les carburants
        return view('carburants.index', compact('carburants')); // Retourne la vue avec les carburants
    }

    /**
     * Afficher le formulaire pour créer un nouveau carburant.
     */
    public function create()
    {
        return view('carburants.create'); // Vue du formulaire de création
    }

    /**
     * Enregistrer un nouveau carburant dans la base.
     */
    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'type' => 'required|string|in:SP95,SP95-E10,SP98,Gazole', // Types valides
        ]);

        // Créer le carburant
        Carburant::create($validated);

        // Redirection avec un message de succès
        return redirect()->route('carburants.index')
            ->with('success', 'Carburant créé avec succès.');
    }

    /**
     * Afficher un carburant spécifique.
     */
    public function show(Carburant $carburant)
    {
        return view('carburants.show', compact('carburant')); // Vue avec les détails du carburant
    }

    /**
     * Afficher le formulaire pour modifier un carburant.
     */
    public function edit(Carburant $carburant)
    {
        return view('carburants.edit', compact('carburant')); // Vue pour modifier
    }

    /**
     * Mettre à jour un carburant existant.
     */
    public function update(Request $request, Carburant $carburant)
    {
        // Valider les données
        $validated = $request->validate([
            'type' => 'required|string|in:SP95,SP95-E10,SP98,Gazole', // Types valides
        ]);

        // Mettre à jour le carburant
        $carburant->update($validated);

        // Redirection avec un message de succès
        return redirect()->route('carburants.index')
            ->with('success', 'Carburant mis à jour avec succès.');
    }

    /**
     * Supprimer un carburant.
     */
    public function destroy(Carburant $carburant)
    {
        $carburant->delete(); // Supprime le carburant

        // Redirection avec un message de succès
        return redirect()->route('carburants.index')
            ->with('success', 'Carburant supprimé avec succès.');
    }
}
