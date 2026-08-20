<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('biographies', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('naissance');
            $table->date('date_naissance')->nullable()->after('id');
            $table->string('lieu_naissance')->nullable()->after('date_naissance');
        });
    }

    public function down(): void
    {
        Schema::table('biographies', function (Blueprint $table) {
            $table->dropColumn(['date_naissance', 'lieu_naissance']);
            $table->string('naissance')->nullable();
            $table->string('photo')->nullable();
        });
    }
};