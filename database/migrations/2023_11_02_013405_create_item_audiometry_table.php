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
        Schema::create('item_audiometries', function (Blueprint $table) {
            $table->id();
            $table->integer('frecuency');
            $table->integer('left_hertz');
            $table->integer('right_hertz');
            $table->unsignedBigInteger('audiometry_id');
            $table->foreign('audiometry_id')->references('id')->on('audiometries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_audiometries');
    }
};
