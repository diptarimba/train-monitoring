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
        Schema::create('water_flow_meters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wagon_id');
            $table->bigInteger('discharge');
            $table->bigInteger('volume');
            $table->timestamps();

            $table->foreign('wagon_id')->references('id')->on('wagons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flow_meters');
    }
};
