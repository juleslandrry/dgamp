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
        Schema::create('arretes', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Ex: Arrêté n°332 du 26 fév. 2020
            $table->text('description'); // Description complète
            $table->string('fichier_path')->nullable(); // Chemin du fichier PDF stocké
            $table->integer('ordre')->default(0); // Pour conserver l'ordre d'affichage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arretes');
    }
};
