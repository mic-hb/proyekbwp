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
        Schema::table('rooms', function (Blueprint $table) {
            $table->foreign(['hotel_code'], 'FK_HOTEL_CODE_ROOMS')->references(['code'])->on('hotels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['room_types_code'], 'FK_ROOM_TYPES_CODE_ROOMS')->references(['code'])->on('room_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign('FK_HOTEL_CODE_ROOMS');
            $table->dropForeign('FK_ROOM_TYPES_CODE_ROOMS');
        });
    }
};
