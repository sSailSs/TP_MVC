<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StationEssenceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test de la route index.
     */
    public function testIndexRouteDisplaysStations()
    {
        // Création de données
        $stations = StationEssence::factory(3)->create();

        // Appel de la route index
        $response = $this->get('/stationEssences');

        // Vérifications
        $response->assertStatus(200);
        foreach ($stations as $station) {
            $response->assertSee($station->nom);
            $response->assertSee($station->localisation);
        }
    }

    /**
     * Test de la création d'une station avec des données valides.
     */
    public function testStoreCreatesStation()
    {
        $data = [
            'nom' => 'Station Total',
            'localisation' => 'Paris',
            'total_citernes' => 10000,
            'qte_carburant' => 5000,
        ];

        // Envoi de la requête POST
        $response = $this->post('/stationEssences', $data);

        // Vérifications
        $response->assertRedirect('/stationEssences');
        $this->assertDatabaseHas('station_essences', $data);
    }

    /**
     * Test de la validation lors de la création d'une station avec des données invalides.
     */
    public function testStoreFailsWithInvalidData()
    {
        $data = [
            'nom' => '', // Nom manquant
            'localisation' => 'Paris',
            'total_citernes' => 20001, // Dépasse la limite
            'qte_carburant' => -1, // Valeur négative
        ];

        // Envoi de la requête POST
        $response = $this->post('/stationEssences', $data);

        // Vérifications
        $response->assertSessionHasErrors(['nom', 'total_citernes', 'qte_carburant']);
        $this->assertDatabaseMissing('station_essences', ['localisation' => 'Paris']);
    }

    /**
     * Test de la route show pour afficher une station.
     */
    public function testShowRouteDisplaysSingleStation()
    {
        // Création d'une station
        $station = StationEssence::factory()->create();

        // Appel de la route show
        $response = $this->get("/stationEssences/{$station->id}");

        // Vérifications
        $response->assertStatus(200);
        $response->assertSee($station->nom);
        $response->assertSee($station->localisation);
    }

    /**
     * Test de la mise à jour d'une station.
     */
    public function testUpdateEditsStation()
    {
        // Création d'une station
        $station = StationEssence::factory()->create([
            'nom' => 'Station Total',
            'localisation' => 'Paris',
            'total_citernes' => 10000,
            'qte_carburant' => 5000,
        ]);

        // Données mises à jour
        $updatedData = [
            'nom' => 'Station Shell',
            'localisation' => 'Lyon',
            'total_citernes' => 15000,
            'qte_carburant' => 7000,
        ];

        // Envoi de la requête PUT
        $response = $this->put("/stationEssences/{$station->id}", $updatedData);

        // Vérifications
        $response->assertRedirect('/stationEssences');
        $this->assertDatabaseHas('station_essences', $updatedData);
    }

    /**
     * Test de la suppression d'une station.
     */
    public function testDestroyDeletesStation()
    {
        // Création d'une station
        $station = StationEssence::factory()->create();

        // Envoi de la requête DELETE
        $response = $this->delete("/stationEssences/{$station->id}");

        // Vérifications
        $response->assertRedirect('/stationEssences');
        $this->assertDatabaseMissing('station_essences', ['id' => $station->id]);
    }

    /**
     * Test des contraintes sur la capacité totale et la quantité actuelle.
     */
    public function testValidationRulesForCapacityAndQuantity()
    {
        $data = [
            'nom' => 'Station BP',
            'localisation' => 'Marseille',
            'total_citernes' => 20001, // Dépasse la limite maximale
            'qte_carburant' => 25000, // Plus que la capacité totale
        ];

        // Envoi de la requête POST
        $response = $this->post('/stationEssences', $data);

        // Vérifications des erreurs de validation
        $response->assertSessionHasErrors(['total_citernes', 'qte_carburant']);
    }

    /**
     * A test to attempt creating a properly formated voiture.
     *
     * @return void
     */
    public function testCreateStationEssence()
    {
        //When user submits post request to create station essence endpoint

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=Shell&localisation=Saint Etienne&citerne=5001&qte_carburant=0');
        $response = $this->get('/stationEssences/' . \DB::getPdo()->lastInsertId());
        //$response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(200);
    }

    /**
     * A test to attempt creating a properly formated voiture with latin accent still fine.
     *
     * @return void
     */
    public function testCreateStationEssenceLatin()
    {
        //When user submits post request to create station essence endpoint, including Latin accent in String

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=Shell&localisation=Saint Étienne&citerne=5001&qte_carburant=0');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(200);
    }

    /**
     * A test to attempt creating a wrongly formated station essence with String too long.
     *
     * @return void
     */
    public function testCreateStationEssenceTooLong()
    {
        //When user submits post request to create station essence endpoint, including String too long

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=' . $this->faker->sentence(91) . '&localisation=Saint Étienne&citerne=5001&qte_carburant=0');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated station essence with negative value qte_carburant.
     *
     * @return void
     */
    public function testCreateStationEssenceQte_carburantNegative()
    {
        //When user submits post request to create station essence endpoint, including negative value qte_carburant

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=&localisation=Saint Étienne&citerne=5001&qte_carburant=-1');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated station essence with missing field.
     *
     * @return void
     */
    public function testCreateStationEssenceMissingField()
    {
        //When user submits post request to create station essence endpoint, including missing field

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=&localisation=Saint Étienne&citerne=5001&qte_carburant=0');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated station essence with float value qte_carburant.
     *
     * @return void
     */
    public function testCreateStationEssenceQte_carburantFloat()
    {
        //When user submits post request to create station essence endpoint, including float value qte_carburant

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=&localisation=Saint Étienne&citerne=5001&qte_carburant=0.0');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated station essence with min value citerne.
     *
     * @return void
     */
    public function testCreateStationEssenceMinCiterne()
    {
        //When user submits post request to create station essence endpoint, including min value citerne

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=&localisation=Saint Étienne&citerne=4999&qte_carburant=0');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }

    /**
     * A test to attempt creating a wrongly formated station essence with max value citerne.
     *
     * @return void
     */
    public function testCreateStationEssenceMaxCiterne()
    {
        //When user submits post request to create station essence endpoint, including max value citerne

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=&localisation=Saint Étienne&citerne=20001&qte_carburant=0');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }
    /**
     * A test to attempt creating a wrongly formated station essence with more than value citerne.
     *
     * @return void
     */
    public function testCreateStationEssenceMoreThanCiterne()
    {
        //When user submits post request to create station essence endpoint, including more than value citerne

        //First of all, checking that rules are working fine:
        $this->post('/stationEssences?nom=&localisation=Saint Étienne&citerne=19999&qte_carburant=20000');
        $response = $this->get('/stationEssences/' . app('db')->getPdo()->lastInsertId());
        $response->assertStatus(404);
    }
}
