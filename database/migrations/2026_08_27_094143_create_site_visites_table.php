<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_visites', function (Blueprint $table) {
            $table->id();
            $table->string('pays', 100)->default('Inconnu');
            $table->string('ville', 100)->default('Inconnue');
            $table->date('date_visite');
            $table->unsignedInteger('vues')->default(1);
            $table->timestamps();

            $table->unique(['pays', 'ville', 'date_visite']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_visites');
    }
};