<?php

namespace Database\Factories;

use App\Models\Citerne;
use App\Models\StationEssence;
use App\Models\Carburant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CiterneFactory extends Factory
{
    protected $model = Citerne::class;

    public function definition()
    {
        $capacite = $this->faker->numberBetween(1000, 5000); // Capacité entre 1000 et 5000 litres
        return [
            'station_essence_id' => StationEssence::factory(), // Associe une station essence
            'carburant_id' => Carburant::factory(), // Associe un carburant
            'capacite' => $capacite, // Capacité totale
            'qte_carburant' => $this->faker->randomFloat(2, 0, $capacite), // Quantité de carburant
        ];
    }
}