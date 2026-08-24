<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vie_associative_pages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // prevoyance | vie-sociale | autres-associations

            // En-tête
            $table->string('badge')->nullable();
            $table->string('titre')->nullable();
            $table->string('lead')->nullable();

            // Section d'introduction (texte + image)
            $table->string('intro_titre')->nullable();
            $table->longText('intro_texte')->nullable();
            $table->string('intro_image')->nullable();
            $table->json('checklist')->nullable();

            // Champs spécifiques (utilisés selon la page)
            $table->string('stat1_val')->nullable();
            $table->string('stat1_lab')->nullable();
            $table->string('stat2_val')->nullable();
            $table->string('stat2_lab')->nullable();
            $table->json('tags')->nullable();

            // Bloc CTA
            $table->string('cta_titre')->nullable();
            $table->string('cta_texte')->nullable();
            $table->string('cta_bouton_texte')->nullable();
            $table->string('cta_bouton_lien')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vie_associative_pages');
    }
};