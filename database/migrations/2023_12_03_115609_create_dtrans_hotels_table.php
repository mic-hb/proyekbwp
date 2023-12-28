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
        Schema::create('dtrans_hotels', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->index('htrans_id');
            $table->foreign('htrans_id')->references('id')->on('htrans_hotel')->onDelete('cascade')->onUpdate('cascade');
            $table->index('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('subtotal');
            // $table->timestamp('created_at', $precision = 0)->useCurrent();
            // $table->timestamp('updated_at', $precision = 0)->nullable();
            // $table->timestamp('deleted_at', $precision = 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtrans_hotels');
    }
};
