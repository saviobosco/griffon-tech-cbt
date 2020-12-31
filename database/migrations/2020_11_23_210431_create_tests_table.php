<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('test_category_id');
            $table->string('duration', 20);
            $table->string('difficulty_level')->nullable();
            $table->unsignedInteger('total_question');
            $table->string('total_mark');
            $table->unsignedInteger('test_instruction_id')->nullable();
            $table->boolean('shuffle_question_in_subject')->nullable()->default(0);
            $table->boolean('group_questions_subject_wise')->nullable()->default(0);
            $table->boolean('option_wise_shuffling')->nullable()->default(0);
            $table->boolean('mandatory_to_attempt_all_question')->nullable()->default(0);
            $table->boolean('show_marks_for_test')->nullable()->default(0);
            $table->boolean('allow_user_move_back_and_forward')->nullable()->default(0);
            $table->boolean('allow_bonus_marking')->nullable()->default(0);
            $table->boolean('apply_partial_marking')->nullable()->default(0);
            $table->boolean('show_calculator')->nullable()->default(0);
            $table->boolean('candidate_to_finish_test_between_allocated_time_frame')->nullable()->default(0);
            $table->string('clock_format', 20)->nullable();
            $table->boolean('allow_time_to_each_section')->nullable()->default(0);
            $table->boolean('atomize_time_for_all_question')->nullable()->default(0);
            $table->boolean('show_message')->nullable()->default(0);
            $table->text('feedback_for_pass')->nullable();
            $table->text('feedback_for_fail')->nullable();
            $table->text('message_on_submit_test')->nullable();
            $table->string('pass_percentage')->nullable();
            $table->string('calculate_ranks_using_automated_or_manual_variation', 30)->nullable();
            $table->boolean('allow_duplicate_rank')->nullable()->default(0);
            $table->boolean('skip_after_a_duplicate')->nullable()->default(0);
            $table->boolean('give_priority_to_finish_time')->nullable()->default(0);
            $table->boolean('show_reports')->nullable()->default(1);
            $table->boolean('multiple_attempt')->nullable()->default(0);
            $table->boolean('is_published')->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('max_submit_date')->nullable();
            $table->date('fix_end_date')->nullable();
            $table->time('max_submit_time')->nullable();
            $table->time('fix_end_time')->nullable();
            $table->string('unique_code', 15)->nullable()->comment('This is a unique code that will be used for identifying this test.');
            $table->string('template', 50)->nullable()->default('default_template')->comment('The design template used to display the test.');
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
        Schema::dropIfExists('tests');
    }
}
