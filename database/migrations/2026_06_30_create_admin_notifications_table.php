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
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('title', 255);
            $table->text('message');
            $table->string('type', 50); // 'enrollment', 'event', 'user', 'system'
            $table->string('action_type', 50)->nullable(); // 'new_enrollment', 'event_created', etc.
            $table->unsignedBigInteger('related_id')->nullable(); // ID of related entity
            $table->boolean('is_read')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('read_at')->nullable();

            $table->foreign('admin_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->index('admin_id');
            $table->index('is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};
