<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();
            $table->text('instruction');
            $table->text('question_ids')->nullable();
            $table->integer('no_of_questions')->default(0);
            $table->text('ip_addresses');
            $table->integer('duration')->comment('duration in minutes');
            $table->float('pass_percentage')->default(50);
            $table->boolean('view_answer')->default(1);
            $table->boolean('require_camera')->default(0);
            $table->boolean('question_selection')->default(0);
            $table->boolean('chart_rank')->default(0);
            $table->boolean('requires_login')->default(1);
            $table->string('template')->default('default_template');
            $table->float('price')->default(0);
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
        Schema::dropIfExists('quizzes');
    }
}
