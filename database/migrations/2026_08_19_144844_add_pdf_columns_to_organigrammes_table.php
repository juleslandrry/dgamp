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
        Schema::table('organigrammes', function (Blueprint $table) {
            $table->string('organigramme_pdf')->nullable();
            $table->string('decret_pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organigrammes', function (Blueprint $table) {
            //
        });
    }
};
