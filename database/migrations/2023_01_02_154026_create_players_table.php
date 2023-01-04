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
        Schema::create('players', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary(['id','user_id']);
            $table->string('name');
            $table->smallInteger('avatar_id');
            $table->boolean('auto')->default(true);
            $table->string('select_key')->default('');
            $table->string('navigate_key')->default('');
            $table->smallInteger('help_after_x_mistakes')->default(3);
            $table->smallInteger('scanning_speed')->default(2);
            $table->smallInteger('dice_type')->default(1);
            $table->smallInteger('board_size')->default(2);
            $table->smallInteger('difficulty')->default(1);
            $table->smallInteger('movement_mode')->default(2);
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
        Schema::dropIfExists('players');
    }
};
