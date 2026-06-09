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
     Schema::create('enrollments', function (Blueprint $table) {
        $table->id('enrollment_id');
        $table->unsignedBigInteger('event_id');
        
        // Match the user_id data type explicitly
        $table->unsignedBigInteger('client_id'); 
        $table->timestamp('registration_date')->useCurrent();
        $table->string('attendance_status', 50)->default('Registered');
        $table->string('payment_status', 50)->default('N/A');

        // Foreign keys
        $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
        
        // Target the unique composite key or direct primary key explicitly
        $table->foreign('client_id')->references('user_id')->on('users')->onDelete('cascade');
        
        $table->unique(['event_id', 'client_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
