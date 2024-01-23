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
        // events migration
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('opening_date');
            $table->dateTime('closing_date');
            $table->bigInteger('created_by')->unsigned()->index();
            $table->text('description');
            $table->string('img_cover');
            $table->string('password');
            $table->string('slug', 200);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // events_configuration_project_field migration
        Schema::create('events_configuration_project_field', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('type_field')->comment('para definir si es un ARCHIVO O ES TEXTO PLANO');
            $table->bigInteger('events_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // projects migration
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('description');
            $table->bigInteger('events_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // project_field migration
        Schema::create('project_field', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->integer('type_field');
            $table->bigInteger('projects_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // project_authors migration
        Schema::create('project_authors', function (Blueprint $table) {
            $table->bigInteger('projects_id')->unsigned()->index();
            $table->bigInteger('users_id')->unsigned()->index();
            $table->primary(['projects_id', 'users_id']);
            $table->timestamps();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // evaluation_criteria migration
        Schema::create('evaluation_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->bigInteger('events_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // project_evaluation migration
        Schema::create('project_evaluation', function (Blueprint $table) {
            $table->id();
            $table->decimal('score');
            $table->bigInteger('projects_id')->unsigned()->index();
            $table->bigInteger('evaluation_criteria_id')->unsigned()->index();
            $table->bigInteger('users_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('evaluation_criteria_id')->references('id')->on('evaluation_criteria')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });

        // projects_evaluator migration
        Schema::create('projects_evaluator', function (Blueprint $table) {
            $table->bigInteger('projects_id')->unsigned()->index();
            $table->bigInteger('users_id')->unsigned()->index();
            $table->primary(['projects_id', 'users_id']);
            $table->timestamps();
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_evaluator');
        Schema::dropIfExists('project_evaluation');
        Schema::dropIfExists('evaluation_criteria');
        Schema::dropIfExists('project_authors');
        Schema::dropIfExists('project_field');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('events_configuration_project_field');
        Schema::dropIfExists('events');
    }
};
