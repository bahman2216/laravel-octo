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
        Schema::create('Movie', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->date('release');
            $table->tinyInteger('length')->unsigned();
            $table->text('description');
            $table->string('mpaa_rating');
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
        Schema::dropIfExists('Movie');
    }
};
