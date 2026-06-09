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
            $table->id('event_id');
            $table->unsignedBigInteger('type_id');
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('instructor_role_id');
            $table->integer('capacity');
            $table->string('status', 50)->default('Scheduled');
            $table->timestamp('created_at')->useCurrent();

            // RULE CHECK 1: Assures the assigned personnel exists and owns this exact role profile
            $table->foreign(['instructor_id', 'instructor_role_id'])
                  ->references(['user_id', 'role_id'])->on('users')
                  ->onDelete('restrict');

            // RULE CHECK 2: Rigid architectural constraint mapping Event Type to Instructor Role
            $table->foreign(['type_id', 'instructor_role_id'])
                  ->references(['type_id', 'required_role_id'])->on('event_types')
                  ->onDelete('restrict');
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
