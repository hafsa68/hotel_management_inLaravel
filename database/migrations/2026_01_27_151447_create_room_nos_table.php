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
        Schema::create('room_nos', function (Blueprint $table) {
        $table->id();
        
        $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
        $table->string('room_number'); 
        $table->string('status')->default('Enabled');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_nos');
    }
};
