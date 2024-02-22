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
        // Tabla 'rubrics'
        Schema::create('rubrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->double('total_rating');
            $table->timestamps();
        });

        // Tabla 'rubric_criteria'
        Schema::create('rubric_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('rubrics_id');
            $table->foreign('rubrics_id')->references('id')->on('rubrics')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla 'rubric_levels'
        Schema::create('rubric_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('points');
            $table->unsignedBigInteger('rubric_criteria_id');
            $table->foreign('rubric_criteria_id')->references('id')->on('rubric_criteria')->onDelete('cascade');
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
        Schema::dropIfExists('rubric_levels');
        Schema::dropIfExists('rubric_criteria');
        Schema::dropIfExists('rubrics');
    }
};
