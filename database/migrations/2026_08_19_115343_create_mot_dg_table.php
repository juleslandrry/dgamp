<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mot_dg', function (Blueprint $table) {
            $table->id();
            $table->string('grade_dg');
            $table->string('nom_dg');
            $table->string('prenom_dg');
            $table->string('titre_dg');
            $table->text('texte_dg');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mot_dg');
    }
};