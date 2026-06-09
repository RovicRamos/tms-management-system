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
       Schema::create('event_types', function (Blueprint $table) {
            $table->id('type_id');
            $table->string('type_name', 50)->unique(); // 'Seminar' or 'Training'
            $table->unsignedBigInteger('required_role_id');
            
            // Relational Fix: Creates the composite unique index MySQL requires
            $table->unique(['type_id', 'required_role_id']);

            $table->foreign('required_role_id')->references('role_id')->on('roles')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_types');
    }
};
