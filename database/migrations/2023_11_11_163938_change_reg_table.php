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
            $table->string('part_name', 255); // Add 'part_name' column after the 'id' column
            $table->string('part_contactNo', 15); // Add 'part_contactNo' column after the 'part_name' column
            $table->string('part_email', 255); // Add 'part_email' column after the 'part_contactNo' column
            $table->string('suggest', 10)->nullable(); // Add 'suggest' column after the 'part_email' column and make it nullable
            $table->string('states')->nullable(); // Add 'states' column after the 'suggest' column and make it nullable

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('part_name');
            $table->dropColumn('part_contactNo');
            $table->dropColumn('part_email');
            $table->dropColumn('suggest');
            $table->dropColumn('states');

        });
    }
};
