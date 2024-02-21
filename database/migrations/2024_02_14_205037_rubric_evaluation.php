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

        // Tabla 'rubric_evaluations'
        Schema::create('rubric_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('evaluador_id');
            $table->unsignedBigInteger('rubric_criteria_id');
            $table->unsignedBigInteger('rubric_levels_selected_id');
            $table->text('comments')->nullable();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('evaluador_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rubric_criteria_id')->references('id')->on('rubric_criteria')->onDelete('cascade');
            $table->foreign('rubric_levels_selected_id')->references('id')->on('rubric_levels')->onDelete('cascade');
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

        Schema::dropIfExists('rubric_evaluations');
        Schema::dropIfExists('rubric_levels');
        Schema::dropIfExists('rubric_criteria');
        Schema::dropIfExists('rubrics');
    }
};
