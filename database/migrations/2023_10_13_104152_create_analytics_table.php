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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repetition');

            $table->unsignedBigInteger('rank_group')->nullable();
            $table->unsignedBigInteger('rank_absolute')->nullable();
            $table->string('type')->nullable();
            $table->string('domain')->nullable();
            $table->string('title')->nullable();
            $table->string('description', 2048)->nullable();
            $table->string('url', 2048)->nullable();

            $table->foreignId('search_id')->index();

            $table->timestamps();

            // $table->foreign('search_id')->references('id')->on('searches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
