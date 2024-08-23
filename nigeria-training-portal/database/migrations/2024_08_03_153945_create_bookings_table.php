<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('student_id'); // Student reference
            $table->integer('tutor_id'); // Tutor reference
            $table->string('address'); // Address for physical sessions
            $table->string('phone'); // Phone number
            $table->enum('session_type', ['online', 'physical']); // Session type
            $table->datetime('start_time'); // Start time
            $table->integer('duration'); // Duration in hours
            $table->datetime('end_time'); // End time
            $table->longText('notes')->nullable(); // Additional notes
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'completed', 'paid'])->default('pending'); // Booking status
            $table->decimal('rate', 8, 2)->default(0.00); // Tutor's hourly rate
            $table->decimal('total_amount', 10, 2)->default(0.00); // Total amount for the session
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
