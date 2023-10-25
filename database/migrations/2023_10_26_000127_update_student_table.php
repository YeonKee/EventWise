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
        Schema::table('students', function (Blueprint $table) {
            // Drop the old column
            $table->dropColumn('email_verified_at');

            // Add a new column
            $table->string('is_email_verified')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('your_table', function (Blueprint $table) {
            // Recreate the dropped column
            $table->string('email_verified_at');

            // Remove the newly added column
            $table->dropColumn('is_email_verified');
        });
    }
};
