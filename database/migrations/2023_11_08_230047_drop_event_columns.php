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
        Schema::table('events', function (Blueprint $table) {
            $table->string('start_time',10)->change();
            $table->string('end_time',10)->change();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      
    }
};
