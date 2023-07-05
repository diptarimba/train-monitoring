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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wagon_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('status')->default('Belum Teratasi');
            $table->longText('content');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('complaint_categories')->onDelete('cascade');
            $table->foreign('wagon_id')->references('id')->on('wagons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
};
