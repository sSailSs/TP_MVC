<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Voiture;
use Tests\TestCase;

class VoitureTest extends TestCase
{
    //use RefreshDatabase;
    use WithFaker;



    /**
     * Test de la route index.
     */
    public function testIndexRouteDisplaysVoitures()
    {
        // Création de données
        $voitures = Voiture::factory(3)->create();

        // Appel de la route index
        $response = $this->get('/voitures');

        // Vérifications
        $response->assertStatus(200);
        foreach ($voitures as $voiture) {
            $response->assertSee($voiture->marque);
        }
    }

    /**
     * Test de la création d'une voiture avec des données valides.
     */
    public function testStoreCreatesVoiture()
    {
        $data = [
            'marque' => 'Peugeot',
            'modele' => '208',
            'reservoir' => 60,
            'qte_carburant' => 30,
        ];

        // Envoi de la requête POST
        $response = $this->post('/voitures', $data);

        // Vérifications
        $response->assertRedirect('/voitures');
        $this->assertDatabaseHas('voitures', $data);
    }

    /**
     * Test de la validation lors de la création d'une voiture avec un champ manquant.
     */
    public function testStoreFailsWithMissingField()
    {
        $data = [
            'marque' => '', // Champ manquant
            'modele' => '208',
            'reservoir' => 60,
            'qte_carburant' => 30,
        ];

        // Envoi de la requête POST
        $response = $this->post('/voitures', $data);

        // Vérifications
        $response->assertSessionHasErrors(['marque']);
        $this->assertDatabaseMissing('voitures', ['modele' => '208']);
    }

    /**
     * Test de la route show pour afficher une voiture.
     */
    public function testShowRouteDisplaysSingleVoiture()
    {
        // Création d'une voiture
        $voiture = Voiture::factory()->create();

        // Appel de la route show
        $response = $this->get("/voitures/{$voiture->id}");

        // Vérifications
        $response->assertStatus(200);
        $response->assertSee($voiture->marque);
        $response->assertSee($voiture->modele);
    }

    /**
     * Test de la mise à jour d'une voiture.
     */
    public function testUpdateEditsVoiture()
    {
        // Création d'une voiture
        $voiture = Voiture::factory()->create([
            'marque' => 'Renault',
            'modele' => 'Clio',
            'reservoir' => 50,
            'qte_carburant' => 20,
        ]);

        // Données mises à jour
        $updatedData = [
            'marque' => 'Renault',
            'modele' => 'Clio V',
            'reservoir' => 50,
            'qte_carburant' => 25,
        ];

        // Envoi de la requête PUT
        $response = $this->put("/voitures/{$voiture->id}", $updatedData);

        // Vérifications
        $response->assertRedirect('/voitures');
        $this->assertDatabaseHas('voitures', $updatedData);
    }

    /**
     * Test de la suppression d'une voiture.
     */
    public function testDestroyDeletesVoiture()
    {
        // Création d'une voiture
        $voiture = Voiture::factory()->create();

        // Envoi de la requête DELETE
        $response = $this->delete("/voitures/{$voiture->id}");

        // Vérifications
        $response->assertRedirect('/voitures');
        $this->assertDatabaseMissing('voitures', ['id' => $voiture->id]);
    }

    /**
     * Test de la validation des règles personnalisées.
     */
    public function testValidationRules()
    {
        $data = [
            'marque' => 'A',
            'modele' => 'DS',
            'reservoir' => 201, // Dépasse la limite
            'qte_carburant' => -1, // Valeur négative
        ];

        // Envoi de la requête POST
        $response = $this->post('/voitures', $data);

        // Vérifications des erreurs de validation
        $response->assertSessionHasErrors(['marque', 'reservoir', 'qte_carburant']);
    }

        /**
     * A test to attempt creating a properly formated voiture.
     *
     * @return void
     */
    public function testCreateVoiture()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine:
        $this->post('/voitures?marque=Citroen&modele=DS&reservoir=50&qte_carburant=46');
        $response = $this->get('/voitures/' . \DB::getPdo()->lastInsertId());
        //$response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(200);
    }

   /**
     * A test to attempt creating a properly formated voiture with latin accent still fine.
     *
     * @return void
     */
    public function testCreateVoitureLatin()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a Latin Accent in String:
        $this->post('/voitures?marque=Citroën&modele=DS&reservoir=50&qte_carburant=46');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(200);
    }

   /**
     * A test to attempt creating a wrongly formated voiture with String too long.
     *
     * @return void
     */
    public function testCreateVoitureTooLong()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a String too long:
        $this->post('/voitures?marque=' . $this->faker->sentence(91) . '&modele=DS&reservoir=50&qte_carburant=46');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

   /**
     * A test to attempt creating a wrongly formated voiture with a missing String.
     *
     * @return void
     */
    public function testCreateVoitureMissingField()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a String too long:
        $this->post('/voitures?marque=&modele=DS&reservoir=50&qte_carburant=46');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

   /**
     * A test to attempt creating a wrongly formated voiture with a negative value qte_carburant.
     *
     * @return void
     */
    public function testCreateVoitureNegative()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a negative value qte_carburant:
        $this->post('/voitures?marque=&modele=DS&reservoir=50&qte_carburant=-1');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated voiture with a float value qte_carburant.
     *
     * @return void
     */
    public function testCreateVoitureFloat()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a float value qte_carburant:
        $this->post('/voitures?marque=&modele=DS&reservoir=50&qte_carburant=0.0');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated voiture with a min value reservoir.
     *
     * @return void
     */
    public function testCreateVoitureMinReservoir()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a min value reservoir:
        $this->post('/voitures?marque=&modele=DS&reservoir=19&qte_carburant=0');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated voiture with a max value reservoir.
     *
     * @return void
     */
    public function testCreateVoitureMaxReservoir()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a max value reservoir:
        $this->post('/voitures?marque=&modele=DS&reservoir=201&qte_carburant=0');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated voiture with a value more than reservoir.
     *
     * @return void
     */
    public function testCreateVoitureMoreThanReservoir()
    {
        //When user submits post request to create voiture endpoint

        //First of all, checking that rules are working fine, including a value more than reservoir:
        $this->post('/voitures?marque=&modele=DS&reservoir=199&qte_carburant=200');
        $response = $this->get('/voitures/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }
    
}
