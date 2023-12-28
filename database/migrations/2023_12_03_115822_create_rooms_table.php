<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('code')->primary;
            $table->index('hotel_code');
            $table->foreign('hotel_code')->references('code')->on('hotels')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type');
            $table->string('floor');
            $table->string('number');
            $table->integer('status');
            $table->integer('price');
            $table->timestamp('created_at', $precision = 0)->useCurrent();
            $table->timestamp('updated_at', $precision = 0)->nullable();
            $table->timestamp('deleted_at', $precision = 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
