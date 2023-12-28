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
        Schema::create('dtrans_hotel', function (Blueprint $table) {
            $table->string('id', 6);
            $table->string('htrans_id', 6)->index('FK_HTRANS_ID_DTRANS');
            $table->string('booking_id', 5)->index('FK_BOOKING_ID_DTRANS');
            $table->integer('subtotal');

            $table->primary(['id', 'booking_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtrans_hotel');
    }
};
