<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carburant;

class CarburantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['SP95', 'SP95-E10', 'SP98', 'Gazole'];

        foreach ($types as $type) {
            Carburant::create(['type' => $type]);
        }
    }
}
