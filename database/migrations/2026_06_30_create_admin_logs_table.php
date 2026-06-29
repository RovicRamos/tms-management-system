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
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('action', 100); // 'created', 'updated', 'deleted', 'login', 'logout'
            $table->string('entity_type', 100); // 'event', 'user', 'enrollment', 'session'
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->json('changes')->nullable(); // Track what changed
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('admin_id')->references('user_id')->on('users')->onDelete('set null');
            $table->index('admin_id');
            $table->index('action');
            $table->index('entity_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_logs');
    }
};
