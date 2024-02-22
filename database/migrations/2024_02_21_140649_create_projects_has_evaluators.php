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
        // Tabla 'projects_has_evaluators'
        Schema::create('projects_has_evaluators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('evaluator_id');
            $table->unsignedBigInteger('events_id');
            $table->integer('state_evaluation');
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::dropIfExists('projects_has_evaluators');
    }
};
