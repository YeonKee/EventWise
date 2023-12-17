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
        Schema::table('registrations', function (Blueprint $table) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->string('longitude', 255)->nullable();
                $table->string('latitude', 255)->nullable();
                $table->integer('distance_time')->nullable(); // Corrected the definition
                $table->string('distance_km', 255)->nullable();
            });  
            // $table->string('city')->nullable(true)->change();
            // $table->string('states')->nullable(true)->change();
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            Schema::table('registrations', function (Blueprint $table) {
                $table->dropColumn(['longitude', 'latitude', 'distance_time', 'distance_km']);
            });
            // $table->string('city')->nullable()->change();
            // $table->string('states')->nullable()->change();
           

        });
    }
};
