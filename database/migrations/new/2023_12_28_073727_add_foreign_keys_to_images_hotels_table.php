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
        Schema::table('images_hotels', function (Blueprint $table) {
            $table->foreign(['hotel_code'], 'FK_HOTEL_CODE_IMAGES_HOTELS')->references(['code'])->on('hotels')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images_hotels', function (Blueprint $table) {
            $table->dropForeign('FK_HOTEL_CODE_IMAGES_HOTELS');
        });
    }
};
