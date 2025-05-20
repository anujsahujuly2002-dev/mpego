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
        Schema::create('insurance_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_insurance_info_id');
            $table->foreign('car_insurance_info_id')->references('id')->on('car_insurance_infos')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('insurance_images');
    }
};
