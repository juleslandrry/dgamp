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
        Schema::create('missions_objectifs_cartes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('missions_objectifs_id')
                ->constrained('missions_objectifs')
                ->cascadeOnDelete();

            $table->enum('type', ['mission', 'objectif']);

            $table->string('titre');
            $table->text('description');

            $table->integer('ordre')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions_objectifs_cartes');
    }
};
