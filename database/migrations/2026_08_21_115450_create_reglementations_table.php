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
        Schema::create('reglementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activite_id')->constrained('activites')->onDelete('cascade');
            $table->string('titre');
            $table->string('sous_titre')->nullable();
            $table->text('intro')->nullable();
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reglementations');
    }
};
