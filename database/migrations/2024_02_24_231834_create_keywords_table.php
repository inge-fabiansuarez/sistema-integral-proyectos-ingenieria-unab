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
        Schema::create('keyword_project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keyword_id');
            $table->unsignedBigInteger('project_id');
            // Foreign keys
            $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            // Unique key to prevent duplicate entries
            $table->unique(['keyword_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyword_project');
    }
};
