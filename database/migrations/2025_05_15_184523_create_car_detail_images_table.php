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
        Schema::create('car_detail_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_detail_id');
            $table->foreign('car_detail_id')->references('id')->on('car_details')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('images');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_detail_images');
    }
};
