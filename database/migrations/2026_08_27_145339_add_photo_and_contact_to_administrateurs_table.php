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
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('email');
            $table->string('contact', 30)->nullable()->after('photo');
        });
    }

    public function down(): void
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->dropColumn(['photo', 'contact']);
        });
    }
    
};
