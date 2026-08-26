<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vie_associative_pages', function (Blueprint $table) {
            $table->dropColumn([
                'checklist',
                'stat1_val', 'stat1_lab', 'stat2_val', 'stat2_lab',
                'tags',
                'cta_titre', 'cta_texte', 'cta_bouton_texte', 'cta_bouton_lien',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('vie_associative_pages', function (Blueprint $table) {
            $table->json('checklist')->nullable();
            $table->string('stat1_val')->nullable();
            $table->string('stat1_lab')->nullable();
            $table->string('stat2_val')->nullable();
            $table->string('stat2_lab')->nullable();
            $table->json('tags')->nullable();
            $table->string('cta_titre')->nullable();
            $table->string('cta_texte')->nullable();
            $table->string('cta_bouton_texte')->nullable();
            $table->string('cta_bouton_lien')->nullable();
        });
    }
};