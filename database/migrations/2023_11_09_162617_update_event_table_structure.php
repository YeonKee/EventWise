<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('events', function (Blueprint $table) {
        //     $table->string('event_picture', 255);
        //     $table->string('event_venuearr', 255);
        //     $table->string('category', 255);
        //     $table->string('registration_status', 255);
        //     $table->string('email', 255);
        //     $table->string('acc_number', 255);
        //     $table->string('openFor', 255);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('events', function (Blueprint $table) {
        //     $table->dropColumn('event_picture');
        //     $table->dropColumn('event_venuearr');
        //     $table->dropColumn('category');
        //     $table->dropColumn('registration_status');
        //     $table->dropColumn('email');
        //     $table->dropColumn('acc_number');
        //     $table->dropColumn('openFor');
        // });
    }
};
