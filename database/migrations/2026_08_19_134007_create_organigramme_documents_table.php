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
        Schema::create('organigramme_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organigramme_id')
                ->constrained('organigrammes')
                ->cascadeOnDelete();

            $table->string('titre');

            $table->enum('type', [
                'organigramme',
                'decret'
            ]);

            $table->string('fichier');

            $table->string('bouton')->default('Voir le PDF');

            $table->unsignedInteger('ordre')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organigramme_documents');
    }
};
