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
            $table->unsignedBigInteger('projects_id');
            $table->unsignedBigInteger('evaluator_id');
            $table->unsignedBigInteger('events_id');
            $table->integer('state_evaluation');
            $table->primary(['projects_id', 'evaluator_id']);
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_has_evaluators');
    }
};
