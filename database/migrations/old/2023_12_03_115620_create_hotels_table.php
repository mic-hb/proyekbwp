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
        Schema::create('hotels', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->index('city_code');
            $table->foreign('city_code')->references('code')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('address');
            $table->string('img');
            $table->timestamp('status', $precision = 0);
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
        Schema::dropIfExists('hotels');
    }
};
