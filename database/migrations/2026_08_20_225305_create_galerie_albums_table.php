<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galerie_albums', function (Blueprint $table) {
            $table->id();
            $table->string('album_id')->unique(); // identifiant slug ex: visite-port
            $table->string('titre');
            $table->string('date')->nullable();
            $table->string('popup_titre')->nullable();
            $table->string('popup_sous')->nullable();
            $table->string('cover')->nullable();
            $table->json('photos')->nullable(); // tableau de chemins d'images
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galerie_albums');
    }
};