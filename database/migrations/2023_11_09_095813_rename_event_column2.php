<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Schema::table('events', function (Blueprint $table) {
        //     $table->string('openFor')->after('other_Cat')->nullable;
        // });

        // DB::statement('UPDATE events SET openFor = other_Cat');

        // Schema::table('events', function (Blueprint $table) {
        //     $table->dropColumn('other_Cat');
        // });

        if (Schema::hasColumn('events', 'other_Cat')){
  
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('other_Cat');
            });
        }
    }

    public function down(): void
    {
        // Schema::table('events', function (Blueprint $table) {
        //     $table->string('other_Cat')->after('previous_column')->nullable();
        // });

        // DB::statement('UPDATE events SET other_Cat = openFor');

        // Schema::table('events', function (Blueprint $table) {
        //     $table->dropColumn('openFor');
        // });

    
    }

};
