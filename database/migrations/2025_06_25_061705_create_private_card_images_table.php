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
        Schema::create('private_card_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('private_card_id');
            $table->foreign('private_card_id')->references('id')->on('private_cards')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('private_card_images');
    }
};
