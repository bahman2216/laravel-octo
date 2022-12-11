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
        Schema::create('Time_Slot', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('theater_id');
            $table->integer('movie_id');
            $table->tinyInteger('theater_room_no');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
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
        Schema::dropIfExists('Time_Slot');
    }
};
