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
        Schema::create('images_hotels', function (Blueprint $table) {
            $table->string('code', 5)->primary();
            $table->string('hotel_code', 5)->index('FK_HOTEL_CODE_IMAGES_HOTELS');
            $table->string('url')->default('https://imgcy.trivago.com/c_limit,d_dummy.jpeg,f_auto,h_1300,q_auto,w_2000/hotelier-images/c8/37/457a15dbf7b554669ddbde45878d9a40c48863ca4ec0c88cb7cc99bc4369.jpeg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images_hotels');
    }
};
