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
        Schema::create('drivers_registration_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accident_id');
            $table->foreign('accident_id')->references('id')->on('accident_infos')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('name');
            $table->string('registration_no');
            $table->string('image');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers_registration_cards');
    }
};
