<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Carburant;

class CarburantTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de la route index.
     */
    public function testIndexRouteDisplaysCarburants()
    {
        // Création de données
        $carburants = Carburant::factory(4)->create();

        // Appel de la route index
        $response = $this->get('/carburants');

        // Vérifications
        $response->assertStatus(200);
        foreach ($carburants as $carburant) {
            $response->assertSee($carburant->type);
        }
    }

    /**
     * Test de la création d'un carburant avec des données valides.
     */
    public function testStoreCreatesCarburant()
    {
        $data = [
            'type' => 'SP98',
        ];

        // Envoi de la requête POST
        $response = $this->post('/carburants', $data);

        // Vérifications
        $response->assertRedirect('/carburants');
        $this->assertDatabaseHas('carburants', $data);
    }

    /**
     * Test de la validation lors de la création d'un carburant avec un type manquant.
     */
    public function testStoreFailsWithMissingType()
    {
        $data = [
            'type' => '', // Champ vide
        ];

        // Envoi de la requête POST
        $response = $this->post('/carburants', $data);

        // Vérifications
        $response->assertSessionHasErrors(['type']);
        $this->assertDatabaseMissing('carburants', $data);
    }

    /**
     * Test de la route show pour afficher un carburant.
     */
    public function testShowRouteDisplaysSingleCarburant()
    {
        // Création d'un carburant
        $carburant = Carburant::factory()->create();

        // Appel de la route show
        $response = $this->get("/carburants/{$carburant->id}");

        // Vérifications
        $response->assertStatus(200);
        $response->assertSee($carburant->type);
    }

    /**
     * Test de la mise à jour d'un carburant.
     */
    public function testUpdateEditsCarburant()
    {
        // Création d'un carburant
        $carburant = Carburant::factory()->create([
            'type' => 'SP95',
        ]);

        // Données mises à jour
        $updatedData = [
            'type' => 'Gazole',
        ];

        // Envoi de la requête PUT
        $response = $this->put("/carburants/{$carburant->id}", $updatedData);

        // Vérifications
        $response->assertRedirect('/carburants');
        $this->assertDatabaseHas('carburants', $updatedData);
    }

    /**
     * Test de la suppression d'un carburant.
     */
    public function testDestroyDeletesCarburant()
    {
        // Création d'un carburant
        $carburant = Carburant::factory()->create();

        // Envoi de la requête DELETE
        $response = $this->delete("/carburants/{$carburant->id}");

        // Vérifications
        $response->assertRedirect('/carburants');
        $this->assertDatabaseMissing('carburants', ['id' => $carburant->id]);
    }

    /**
     * Test de la validation de types spécifiques (SP95, SP98, Gazole).
     */
    public function testValidationAllowsSpecificTypes()
    {
        $validTypes = ['SP95', 'SP98', 'Gazole', 'SP95-E10'];

        foreach ($validTypes as $type) {
            $data = ['type' => $type];

            // Envoi de la requête POST
            $response = $this->post('/carburants', $data);

            // Vérifications
            $response->assertRedirect('/carburants');
            $this->assertDatabaseHas('carburants', $data);
        }
    }

    /**
     * Test de la validation avec un type non autorisé.
     */
    public function testValidationRejectsInvalidType()
    {
        $data = [
            'type' => 'InvalidType',
        ];

        // Envoi de la requête POST
        $response = $this->post('/carburants', $data);

        // Vérifications
        $response->assertSessionHasErrors(['type']);
        $this->assertDatabaseMissing('carburants', $data);
    }
}
