<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Citerne;
use App\Models\StationEssence;
use App\Models\Carburant;

class CiterneTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de la route index.
     */
    public function testIndexRouteDisplaysCiternes()
    {
        // Création de données
        $citernes = Citerne::factory(3)->create();

        // Appel de la route index
        $response = $this->get('/citernes');

        // Vérifications
        $response->assertStatus(200);
        foreach ($citernes as $citerne) {
            $response->assertSee($citerne->capacite);
            $response->assertSee($citerne->qte_carburant);
        }
    }

    /**
     * Test de la création d'une citerne avec des données valides.
     */
    public function testStoreCreatesCiterne()
    {
        // Création de dépendances
        $station = StationEssence::factory()->create();
        $carburant = Carburant::factory()->create();

        $data = [
            'station_essence_id' => $station->id,
            'carburant_id' => $carburant->id,
            'capacite' => 10000,
            'qte_carburant' => 5000,
        ];

        // Envoi de la requête POST
        $response = $this->post('/citernes', $data);

        // Vérifications
        $response->assertRedirect('/citernes');
        $this->assertDatabaseHas('citernes', $data);
    }

    /**
     * Test de la validation lors de la création d'une citerne avec des données invalides.
     */
    public function testStoreFailsWithInvalidData()
    {
        // Création de dépendances
        $station = StationEssence::factory()->create();
        $carburant = Carburant::factory()->create();

        $data = [
            'station_essence_id' => $station->id,
            'carburant_id' => $carburant->id,
            'capacite' => -1000, // Valeur négative
            'qte_carburant' => 15000, // Plus que la capacité
        ];

        // Envoi de la requête POST
        $response = $this->post('/citernes', $data);

        // Vérifications
        $response->assertSessionHasErrors(['capacite', 'qte_carburant']);
        $this->assertDatabaseMissing('citernes', ['capacite' => -1000]);
    }

    /**
     * Test de la route show pour afficher une citerne.
     */
    public function testShowRouteDisplaysSingleCiterne()
    {
        // Création d'une citerne
        $citerne = Citerne::factory()->create();

        // Appel de la route show
        $response = $this->get("/citernes/{$citerne->id}");

        // Vérifications
        $response->assertStatus(200);
        $response->assertSee($citerne->capacite);
        $response->assertSee($citerne->qte_carburant);
    }

    /**
     * Test de la mise à jour d'une citerne.
     */
    public function testUpdateEditsCiterne()
    {
        // Création d'une citerne
        $citerne = Citerne::factory()->create([
            'capacite' => 10000,
            'qte_carburant' => 5000,
        ]);

        // Données mises à jour
        $updatedData = [
            'capacite' => 15000,
            'qte_carburant' => 7000,
        ];

        // Envoi de la requête PUT
        $response = $this->put("/citernes/{$citerne->id}", $updatedData);

        // Vérifications
        $response->assertRedirect('/citernes');
        $this->assertDatabaseHas('citernes', $updatedData);
    }

    /**
     * Test de la suppression d'une citerne.
     */
    public function testDestroyDeletesCiterne()
    {
        // Création d'une citerne
        $citerne = Citerne::factory()->create();

        // Envoi de la requête DELETE
        $response = $this->delete("/citernes/{$citerne->id}");

        // Vérifications
        $response->assertRedirect('/citernes');
        $this->assertDatabaseMissing('citernes', ['id' => $citerne->id]);
    }

    /**
     * Test des contraintes sur la capacité et la quantité actuelle.
     */
    public function testValidationRulesForCapacityAndQuantity()
    {
        // Création de dépendances
        $station = StationEssence::factory()->create();
        $carburant = Carburant::factory()->create();

        $data = [
            'station_essence_id' => $station->id,
            'carburant_id' => $carburant->id,
            'capacite' => 5000,
            'qte_carburant' => 6000, // Plus que la capacité
        ];

        // Envoi de la requête POST
        $response = $this->post('/citernes', $data);

        // Vérifications des erreurs de validation
        $response->assertSessionHasErrors(['qte_carburant']);
    }
}
