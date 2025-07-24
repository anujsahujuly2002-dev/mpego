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
        Schema::create('send_notification_custom_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_custom_notify_id')->nullable();
            $table->foreign('schedule_custom_notify_id')->references('id')->on('schedule_custom_notifications')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_notification_custom_users');
    }
};
