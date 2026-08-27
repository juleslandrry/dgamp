<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personnel_paramilitaires', function (Blueprint $table) {
            $table->id();

            // Hero (fond image + badge + titre + description courte)
            $table->string('badge')->nullable();
            $table->string('titre')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // Section "texte à côté de l'image"
            $table->string('section_titre')->nullable();
            $table->longText('section_texte')->nullable();
            $table->string('section_image')->nullable();
            $table->json('section_points')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnel_paramilitaires');
    }
};