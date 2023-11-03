<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Drop the cat_id column
            
                // Drop the cat_id column
                $table->dropColumn('cat_id');
            
            // Add the category column
            // $table->string('category', 255)->nullable();

            // Remove the event_picture, event_venuearr, and registration_status columns if they exist
            // $table->dropColumn('event_picture');
            // $table->dropColumn('event_venuearr');
            // $table->dropColumn('registration_status');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Reverse the changes by adding back the cat_id column as a foreign key
            // $table->unsignedBigInteger('cat_id');
            // $table->foreign('cat_id')->references('id')->on('categories');

            // Add back the event_picture, event_venuearr, and registration_status columns
            // $table->string('event_picture')->nullable();
            // $table->string('event_venuearr')->nullable();
            // $table->string('registration_status', 255)->default('Close');

            $table->string('cat_id')->nullable();
        });
    }
};

