<?php

namespace Database\Seeders;

use App\Models\StationEssence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Citerne;
use App\Models\Carburant;

class StationEssenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = StationEssence::factory()->count(2)->create();

        $carburants = Carburant::all();

        foreach ($stations as $station) {
            foreach ($carburants as $carburant) {
                $capacite = fake()->randomFloat(2, 1000, 5000);
                $station->citernes()->create([
                    'carburant_id' => $carburant->id,
                    'capacite' => $capacite,
                    'qte_carburant' => fake()->randomFloat(2, 0, $capacite),
                ]);
            }
        }
    }
}
