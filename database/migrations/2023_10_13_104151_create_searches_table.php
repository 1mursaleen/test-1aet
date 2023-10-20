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
        Schema::create('searches', function (Blueprint $table) {
            $table->id();

            $table->string('device')->index();
            $table->string('keyword');
            $table->unsignedBigInteger('repetitions')->default(1);

            $table->string('os')->nullable();
            $table->string('depth')->default(100);
            $table->string('language_code');

            // $table->string('api')->nullable();
            // $table->string('function')->nullable();
            // $table->string('se')->nullable();
            // $table->string('se_type')->nullable();

            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedMediumInteger('location_code')->index();

            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('location_code')->references('code')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('searches');
    }
};
