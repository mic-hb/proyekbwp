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
        Schema::table('dtrans_hotel', function (Blueprint $table) {
            $table->foreign(['booking_id'], 'FK_BOOKING_ID_DTRANS')->references(['id'])->on('bookings')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['htrans_id'], 'FK_HTRANS_ID_DTRANS')->references(['id'])->on('htrans_hotel')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dtrans_hotel', function (Blueprint $table) {
            $table->dropForeign('FK_BOOKING_ID_DTRANS');
            $table->dropForeign('FK_HTRANS_ID_DTRANS');
        });
    }
};
