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
            $table->string('remark')->nullable(true)->change();
            $table->string('bank_Name')->nullable(true)->change();
            $table->string('payment_qr')->nullable(true)->change();
            $table->string('acc_number')->nullable(true)->change();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('remark')->nullable()->change();
            $table->string('bank_Name')->nullable()->change();
            $table->string('payment_qr')->nullable()->change();
            $table->string('acc_number')->nullable()->change();
           
        });
    }
};
