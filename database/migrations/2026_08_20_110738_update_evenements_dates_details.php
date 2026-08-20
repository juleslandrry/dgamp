<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->date('date_evenement')->nullable()->after('type');
            $table->time('heure_evenement')->nullable()->after('date_evenement');
            $table->text('details')->nullable()->after('description');
        });

        Schema::table('evenements', function (Blueprint $table) {
            $table->dropColumn(['jour', 'mois', 'horaire', 'date_affichee']);
        });
    }

    public function down(): void
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->string('jour')->nullable();
            $table->string('mois')->nullable();
            $table->string('horaire')->nullable();
            $table->string('date_affichee')->nullable();
            $table->dropColumn(['date_evenement', 'heure_evenement', 'details']);
        });
    }
};