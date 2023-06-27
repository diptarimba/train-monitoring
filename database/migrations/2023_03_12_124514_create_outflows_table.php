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
        Schema::create('outflows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('water_way_id');
            $table->unsignedBigInteger('wagon_id');
            $table->float('value', 8, 2);
            $table->timestamp('open_date')->nullable();
            $table->timestamp('close_date')->nullable();
            $table->timestamps();

            $table->foreign('wagon_id')->references('id')->on('wagons')->onDelete('cascade');
            $table->foreign('water_way_id')->references('id')->on('waterways')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outflows');
    }
};
