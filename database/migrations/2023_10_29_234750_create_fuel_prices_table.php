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
        Schema::create('fuel_prices', function (Blueprint $table) {
            $table->id();
            $table->string('station_id');
            $table->float('diesel')->nullable();
            $table->float('e5')->nullable();
            $table->float('e10')->nullable();
            $table->boolean('open')->nullable();
            $table->timestamps();

            $table->foreign('station_id')->references('id')->on('fuel_stations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_prices');
    }
};
