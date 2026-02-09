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
            
            // RELATIONS (Critical for the booking logic to work)
            // Note: Ensure your tables are named 'rooms' and 'room_nos' in the DB
            $table->unsignedBigInteger('rooms_id');    // The Room Type (Deluxe, etc)
            $table->unsignedBigInteger('room_nos_id')->nullable(); // The specific Room Number ID (101, 102)

            // GUEST INFO
            $table->string('guest_name');  // Renamed from 'username' to match your Controller
            $table->string('guest_email')->nullable(); // Renamed from 'email'
            $table->string('phone')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_verified')->default(false);
                $table->timestamp('verified_at')->nullable();


            // DATES
            $table->date('check_in');
            $table->date('check_out');
             
            // FINANCIALS (Kept from your original code)
            $table->integer('nights')->default(1);
            $table->decimal('total_price', 10, 2)->default(0); // Renamed to match typical use, or keep 'grand_total'
            $table->string('status')->default('booked'); // pending, booked, cancelled
            
            $table->timestamps();

            // OPTIONAL: Foreign Key Constraints (Recommended)
            // $table->foreign('rooms_id')->references('id')->on('rooms')->onDelete('cascade');
            // $table->foreign('room_nos_id')->references('id')->on('room_nos')->onDelete('cascade');
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