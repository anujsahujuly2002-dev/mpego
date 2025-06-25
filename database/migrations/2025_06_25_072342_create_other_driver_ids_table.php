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
        Schema::create('other_driver_ids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accident_id');
            $table->foreign('accident_id')->references('id')->on('accident_infos')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('name');
            $table->string('license_no');
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
        Schema::dropIfExists('other_driver_ids');
    }
};
