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
        Schema::create('two_service_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('two_services_id');
            $table->foreign('two_services_id')->references('id')->on('two_services')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('two_service_images');
    }
};
