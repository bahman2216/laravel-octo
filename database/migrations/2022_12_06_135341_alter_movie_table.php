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
        Schema::table('Movie', function (Blueprint $table) {
            $table->integer('theater_name_id');
            $table->tinyInteger('theater_room_no')->unsigned();
            $table->dateTime('start_date')->default(now());
            $table->dateTime('end_date')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Movie', function (Blueprint $table) {
            $table->dropColumn('theater_name_id');
            $table->dropColumn('theater_room_no');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
};
