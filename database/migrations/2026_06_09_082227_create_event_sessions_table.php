<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_sessions', function (Blueprint $table) {
            $table->id('session_id');
            $table->unsignedBigInteger('event_id');
            $table->string('session_title', 150)->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('location', 255);

            // Foreign Key Constraint
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
        });

        // Safe cross-database fallback: Only run the ALTER TABLE statement if we aren't using SQLite
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE event_sessions ADD CONSTRAINT chk_date_logic CHECK (end_date > start_date)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_sessions');
    }
};