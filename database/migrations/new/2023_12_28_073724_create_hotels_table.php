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
        Schema::create('hotels', function (Blueprint $table) {
            $table->string('code', 5)->primary();
            $table->string('city_code', 5)->index('FK_CITY_CODE_HOTELS');
            $table->string('name');
            $table->string('address');
            $table->string('img')->default('https://imgcy.trivago.com/c_limit,d_dummy.jpeg,f_auto,h_1300,q_auto,w_2000/hotelier-images/c8/37/457a15dbf7b554669ddbde45878d9a40c48863ca4ec0c88cb7cc99bc4369.jpeg');
            $table->timestamp('status', $precision = 0)->nullable();
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
        Schema::dropIfExists('hotels');
    }
};
