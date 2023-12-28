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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id', 5)->primary();
            $table->string('room_code', 5)->nullable()->index('FK_ROOM_CODE_BOOKINGS');
            $table->string('user_id', 5)->nullable()->index('FK_USER_ID_BOOKINGS');
            $table->dateTime('start_date', $precision = 0);
            $table->dateTime('end_date', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
