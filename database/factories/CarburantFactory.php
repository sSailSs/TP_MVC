<?php

namespace Database\Factories;

use App\Models\Carburant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarburantFactory extends Factory
{
    protected $model = Carburant::class;

    public function definition()
    {
        $types = ['SP95', 'SP95-E10', 'SP98', 'Gazole'];
        return [
            'type' => $this->faker->randomElement($types), // Type de carburant
        ];
    }
}
