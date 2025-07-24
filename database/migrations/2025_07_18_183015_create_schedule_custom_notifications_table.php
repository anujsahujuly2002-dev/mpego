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
        Schema::create('schedule_custom_notifications', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->dateTime('schedule_time');
            $table->enum('status',['pending','sent']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_custom_notifications');
    }
};
