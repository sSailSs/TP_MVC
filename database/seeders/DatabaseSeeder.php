<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appeler les seeders pour chaque modèle
        $this->call([
            CarburantSeeder::class,       // Ajoute les 4 types de carburant
            StationEssenceSeeder::class, // Ajoute 2 stations avec leurs citernes
            VoitureSeeder::class,        // Ajoute 100 voitures
        ]);

        // Exemple : Créer un utilisateur de test si nécessaire
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
