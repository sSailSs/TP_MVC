<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citernes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_essence_id')->constrained()->onDelete('cascade');
            $table->foreignId('carburant_id')->constrained()->onDelete('cascade');
            $table->decimal('capacite', 10, 2); // Capacité totale de la citerne
            $table->decimal('qte_carburant', 10, 2); // Quantité actuelle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citernes');
    }
};
