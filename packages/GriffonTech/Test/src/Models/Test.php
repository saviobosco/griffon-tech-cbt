<?php


namespace GriffonTech\Test\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Test\Contracts\Test as TestContract;

class Test extends Model implements TestContract
{

    protected $table = 'tests';

    protected $fillable = [
        'name',
        'test_category_id',
        'duration',
        'difficulty_level',
        'total_question',
        'total_mark',
        'test_instruction_id',
        'shuffle_question_in_subject',
        'group_questions_subject_wise',
        'option_wise_shuffling',
        'mandatory_to_attempt_all_question',
        'show_marks_for_test',
        'allow_user_move_back_and_forward',
        'allow_bonus_marking',
        'apply_partial_marking',
        'show_calculator',
        'candidate_to_finish_test_between_allocated_time_frame',
        'clock_format',
        'atomize_time_for_all_question',
        'show_message',
        'feedback_for_pass',
        'feedback_for_fail',
        'message_on_submit_test',
        'pass_percentage',
        'calculate_ranks_using_automated_or_manual_variation',
        'allow_duplicate_rank',
        'skip_after_a_duplicate',
        'give_priority_to_finish_time',
        'show_reports',
        'multiple_attempt',
        'is_published',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'max_submit_date',
        'fix_end_date',
        'max_submit_time',
        'fix_end_time',
        'unique_code'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function test_category()
    {
        return $this->belongsTo(TestCategoryProxy::modelClass(), 'test_category_id', 'id');
    }


    public function test_instruction()
    {
        return $this->belongsTo(TestInstructionProxy::modelClass(), 'test_instruction_id', 'id');
    }


    public function questions()
    {
        return $this->hasMany(TestQuestionProxy::modelClass(), 'test_id', 'id');
    }
}
