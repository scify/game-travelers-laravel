<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('players');
            $table->smallInteger('board_id')->default(1);
            $table->smallInteger('mode_id')->default(1);
            $table->smallInteger('pawn_id_1')->default(1);
            $table->smallInteger('pawn_id_2')->default(2);
            $table->boolean('use_tutorial')->default(true);
            $table->unsignedInteger('location_1')->default(0);
            $table->unsignedInteger('location_2')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game');
    }
};
