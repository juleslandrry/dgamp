<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['avenir', 'passe']);
            $table->string('titre');
            $table->text('description')->nullable();   // passé
            $table->string('date_affichee')->nullable(); // passé (ex: "06 MARS 2026")
            $table->string('image')->nullable();         // passé
            $table->string('jour')->nullable();           // avenir
            $table->string('mois')->nullable();           // avenir
            $table->string('horaire')->nullable();        // avenir
            $table->string('lieu')->nullable();           // avenir
            $table->string('lien')->nullable();           // avenir
            $table->string('categorie')->nullable();      // filtre interne (les deux)
            $table->string('tag')->nullable();             // étiquette affichée (les deux)
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};