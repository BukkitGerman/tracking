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
        Schema::create('fuel_stations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('street');
            $table->string('place');
            $table->string('house_number');
            $table->string('post_code');
            $table->float('lat');
            $table->float('lng');
            $table->float('dist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_stations');
    }
};
