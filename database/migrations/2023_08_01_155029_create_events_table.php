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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->foreignId('cat_id');
            $table->string('person_inCharge', 100);
            $table->string('contact_number', 12);
            $table->string('name', 100);
            $table->string('description', 256);
            $table->double('ticket_price', 3, 2);
            $table->integer('capacity');
            $table->integer('participated_count');
            $table->date('date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('duration');
            $table->string('status', 20);
            $table->string('remark', 256);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
