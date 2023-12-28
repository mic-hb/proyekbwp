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
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('code', 5)->primary();
            $table->string('hotel_code', 5)->nullable()->index('FK_HOTEL_CODE_ROOMS');
            $table->string('type', 3)->nullable();
            $table->string('floor', 2)->nullable();
            $table->string('number', 2)->nullable();
            $table->integer('status')->nullable();
            $table->integer('price')->nullable();
            $table->timestamp('created_at', $precision = 0)->useCurrent();
            $table->timestamp('updated_at', $precision = 0)->nullable();
            $table->timestamp('deleted_at', $precision = 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
