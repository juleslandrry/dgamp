<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vie_associative_cards', function (Blueprint $table) {
            $table->dropColumn(['couleur', 'points']);
        });
    }

    public function down(): void
    {
        Schema::table('vie_associative_cards', function (Blueprint $table) {
            $table->string('couleur')->default('orange');
            $table->json('points')->nullable();
        });
    }
};