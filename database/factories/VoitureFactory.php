<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\FakeCar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voiture>
 */
class VoitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FakeCar($this->faker));

        $reservoir = $this->faker->randomFloat(2, 20, 200); // Capacité entre 20 et 200 litres

        return [
            'marque' => $this->faker->vehicleBrand(), // Génère une marque réaliste
            'modele' => $this->faker->vehicleModel(), // Génère un modèle réaliste
            'reservoir' => $this->faker->randomFloat(2, 20, 200), // Capacité entre 20 et 200 litres
            'qte_carburant' => $this->faker->randomFloat(2, 0, $reservoir), // Quantité ≤ capacité
        ];
    }
}
