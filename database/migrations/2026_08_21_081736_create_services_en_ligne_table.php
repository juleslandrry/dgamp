<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services_en_ligne', function (Blueprint $table) {
            $table->id();
            $table->string('cle')->unique(); // ex: 'Agréments et visas'
            $table->string('desc')->nullable();
            $table->string('accent')->default('navy');
            $table->string('icon')->default('folder');
            $table->string('lien')->nullable();
            $table->text('detail_texte')->nullable();
            $table->json('detail_points')->nullable(); // liste optionnelle
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services_en_ligne');
    }
};