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
        Schema::table('images_rooms', function (Blueprint $table) {
            $table->foreign(['room_types_code'], 'FK_ROOM_TYPES_CODE_IMAGES_ROOMS')->references(['code'])->on('room_types')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images_rooms', function (Blueprint $table) {
            $table->dropForeign('FK_ROOM_TYPES_CODE_IMAGES_ROOMS');
        });
    }
};
