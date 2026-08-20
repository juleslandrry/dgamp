<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mot_dg', function (Blueprint $table) {
            $table->longText('texte_dg')->change();
        });
    }

    public function down(): void
    {
        Schema::table('mot_dg', function (Blueprint $table) {
            $table->text('texte_dg')->change();
        });
    }
};