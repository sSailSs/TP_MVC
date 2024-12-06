<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('station_essences', function (Blueprint $table) {
        $table->renameColumn('citerne', 'total_citernes'); // Renomme "citerne"
        $table->renameColumn('qte_carburant', 'qte_carburant'); // Conserve "qte_carburant"
        $table->decimal('total_citernes', 10, 2)->change(); // Convertit en décimal
        $table->decimal('qte_carburant', 10, 2)->change(); // Convertit en décimal
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
