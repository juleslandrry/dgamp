<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services_en_ligne', function (Blueprint $table) {
            $table->string('badge')->nullable()->after('cle');
            $table->string('titre')->nullable()->after('badge');
            $table->text('description')->nullable()->after('titre');
            $table->string('bouton_texte')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('services_en_ligne', function (Blueprint $table) {
            $table->dropColumn(['badge', 'titre', 'description', 'bouton_texte']);
        });
    }
};