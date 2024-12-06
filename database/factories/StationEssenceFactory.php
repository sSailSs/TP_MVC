<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StationEssence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StationEssence>
 */
class StationEssenceFactory extends Factory
{
    protected $model = StationEssence::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomStation = ['Shell', 'Total', 'Texaco', 'Agip', 'Repsol', 'Elf', 'BP', 'ESSO'];
        $totalCiternes = $this->faker->randomFloat(2, 5000, 20000); // Entre 5000 et 20000 litres

        return [
            'nom' => $this->faker->randomElement($nomStation),
            'localisation' => $this->faker->city(),
            'total_citernes' => $totalCiternes, // Capacité totale des citernes
            'qte_carburant' => $this->faker->randomFloat(2, 0, $totalCiternes), // Quantité <= total_citernes
        ];
    }
}
