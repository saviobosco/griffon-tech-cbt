<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizSessionAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_session_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quiz_session_id');
            $table->unsignedInteger('quiz_question_id')->nullable();
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('question_option_id')->nullable();
            $table->text('answer_text')->nullable();
            $table->float('score')->nullable();
            $table->unsignedInteger('time_spent')->default(0)->nullable();
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
        Schema::dropIfExists('quiz_session_answers');
    }
}
