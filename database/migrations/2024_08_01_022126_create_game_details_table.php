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
        Schema::create('game_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->string('min_os');
            $table->string('min_cpu');
            $table->string('min_ram');
            $table->string('min_gpu');
            $table->string('min_storage');
            $table->string('req_os');
            $table->string('req_cpu');
            $table->string('req_ram');
            $table->string('req_gpu');
            $table->string('req_storage');
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_details');
    }
};
