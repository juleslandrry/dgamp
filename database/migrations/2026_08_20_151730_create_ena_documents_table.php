<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ena_documents', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('mots_cles')->nullable();
            $table->string('intitule');
            $table->string('lien')->nullable(); // chemin du PDF
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ena_documents');
    }
};