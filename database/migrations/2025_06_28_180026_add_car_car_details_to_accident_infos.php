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
        Schema::table('accident_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('car_detail_id')->after('id')->nullable();
            $table->foreign('car_detail_id')->references('id')->on('car_details')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('car_insurence_info_id')->after('car_detail_id')->nullable();
            $table->foreign('car_insurence_info_id')->references('id')->on('car_insurance_infos')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accident_infos', function (Blueprint $table) {
            //
        });
    }
};
