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
        // Events Table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('opening_date');
            $table->dateTime('closing_date');
            $table->bigInteger('created_by')->unsigned();
            $table->text('description');
            $table->string('img_cover');
            $table->string('password');
            $table->string('slug');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
        });

        // Projects Table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });

        // Project Field Table
        Schema::create('project_field', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type_field');
            $table->timestamps();
        });

        // Project Authors Table
        Schema::create('project_authors', function (Blueprint $table) {
            $table->bigInteger('projects_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();
            $table->primary(['projects_id', 'users_id']);
            $table->timestamps();

            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Projects Evaluator Table
        Schema::create('projects_evaluator', function (Blueprint $table) {
            $table->bigInteger('projects_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();
            $table->primary(['projects_id', 'users_id']);
            $table->timestamps();

            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Events Has Projects Table
        Schema::create('events_has_projects', function (Blueprint $table) {
            $table->bigInteger('events_id')->unsigned();
            $table->bigInteger('projects_id')->unsigned();
            $table->primary(['events_id', 'projects_id']);
            $table->timestamps();

            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
        });

        // Projects Has Field Table
        Schema::create('projects_has_field', function (Blueprint $table) {
            $table->bigInteger('projects_id')->unsigned();
            $table->bigInteger('project_field_id')->unsigned();
            $table->text('value');
            $table->primary(['projects_id', 'project_field_id']);
            $table->timestamps();

            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('project_field_id')->references('id')->on('project_field')->onDelete('cascade');
        });

        // Events Has Project Field Table
        Schema::create('events_has_project_field', function (Blueprint $table) {
            $table->bigInteger('events_id')->unsigned();
            $table->bigInteger('project_field_id')->unsigned();
            $table->primary(['events_id', 'project_field_id']);
            $table->timestamps();

            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('project_field_id')->references('id')->on('project_field')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop tables in reverse order to avoid foreign key constraint issues
        Schema::dropIfExists('events_has_project_field');
        Schema::dropIfExists('projects_has_field');
        Schema::dropIfExists('events_has_projects');
        Schema::dropIfExists('projects_evaluator');
        Schema::dropIfExists('project_authors');
        Schema::dropIfExists('project_field');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('events');
    }
};
