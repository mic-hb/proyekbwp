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
        Schema::create('cities', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('name');
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
        Schema::dropIfExists('cities');
    }
};
