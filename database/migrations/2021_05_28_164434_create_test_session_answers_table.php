<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestSessionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_session_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('test_session_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('question_option_id')->nullable();
            $table->text('answer_text')->nullable();
            $table->double('score',3, 2)->nullable();
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
        Schema::dropIfExists('test_session_answers');
    }
}
