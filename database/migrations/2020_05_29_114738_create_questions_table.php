<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->text('question');
            $table->text('description')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->unsignedInteger('topic_id')->nullable();
            $table->tinyInteger('right_mark')->nullable();
            $table->tinyInteger('negative_mark')->nullable();
            $table->string('difficulty_level')->nullable();
            $table->text('paragraph')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
