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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playstation_id')->constrained('playstations');
            $table->foreignId('user_id')->constrained('users');
            $table->string('booking_code');
            $table->date('booking_date');
            $table->integer('booking_duration');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('total_pay');
            $table->string('payment')->nullable();
            $table->string('status')->default('Belum dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
