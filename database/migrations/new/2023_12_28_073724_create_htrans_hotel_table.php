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
        Schema::create('htrans_hotel', function (Blueprint $table) {
            $table->string('id', 6)->primary();
            $table->string('user_id', 5)->index('FK_USER_ID_HTRANS');
            $table->dateTime('date');
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('htrans_hotel');
    }
};
