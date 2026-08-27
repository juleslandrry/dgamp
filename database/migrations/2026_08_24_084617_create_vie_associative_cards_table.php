<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vie_associative_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vie_associative_page_id')->constrained()->cascadeOnDelete();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->json('points')->nullable();
            $table->string('couleur')->default('orange'); // orange | vert | violet
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vie_associative_cards');
    }
};