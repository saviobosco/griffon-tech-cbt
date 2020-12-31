{!! Form::model($test, ['route' => ['admin.tests.update', $test->id], 'role' => 'form', 'id' => 'test-settings-form']) !!}

<table class="table table-bordered">
    <tr>
        <td colspan="3">Shuffle and bundle questions to vivid sets with similar questions </td>
    </tr>
    <tr>
        <td rowspan="2">Grouping</td>
        <td> Shuffle questions within subject </td>
        <td>
            <label for="shuffle_question_in_subject_yes">
                {!! Form::radio('shuffle_question_in_subject',
                1, null, [ 'id'=>'shuffle_question_in_subject_yes']) !!}
                Yes
            </label>
            <label for="shuffle_question_in_subject_no">
                {!! Form::radio('shuffle_question_in_subject',
                0, null, ['id'=>'shuffle_question_in_subject_no']) !!}
                No
            </label>
        </td>
    </tr>
    <tr>
        <td> Group questions subjectWise </td>
        <td>
            <label for="group_questions_subject_wise_yes">
                {!! Form::radio('group_questions_subject_wise',
                1, null,
                 [
                  'id'=>'group_questions_subject_wise_yes']) !!}
                Yes
            </label>

            <label for="group_questions_subject_wise_no">
                {!! Form::radio('group_questions_subject_wise',
                0, null, [
                 'id'=>'group_questions_subject_wise_no']) !!}
                No
            </label>
        </td>
    </tr>
    <tr>
        <td> Shuffling </td>
        <td>Optionwise shuffling</td>
        <td>
            <label for="option_wise_shuffling_yes">
                {!! Form::radio('option_wise_shuffling', 1, null, [ 'id'=>'option_wise_shuffling_yes']) !!}
                Yes
            </label>
            <label for="option_wise_shuffling_no">
                {!! Form::radio('option_wise_shuffling', 0, null, ['id'=>'option_wise_shuffling_no']) !!}
                No
            </label>
        </td>
    </tr>
</table>

<div class="mt-5">
    <p>Set the required fields for a candidate appearing in the test</p>
    <div class="row">
        <div class="col-sm-6">
            <div>
                <label for="mandatory_to_attempt_all_question">
                    {!! Form::hidden('mandatory_to_attempt_all_question', 0) !!}
                    {!! Form::checkbox('mandatory_to_attempt_all_question', 1, null,['id' => 'mandatory_to_attempt_all_question']) !!}
                    Mandatory to attempt all question
                    <i class="fa fa-info-circle" title="Force the candidate to attempt all questions"></i>
                </label>
            </div>
            <div>
                <label for="show_marks_for_test">
                    {!! Form::hidden('show_marks_for_test', 0) !!}
                    {!! Form::checkbox('show_marks_for_test', 1, null,['id' => 'show_marks_for_test']) !!}
                    Show marks/points for test
                    <i class="fa fa-info-circle" title="Show marks for the test"></i>
                </label>
            </div>
            <div>
                <label for="">
                    <input type="checkbox" > Apply web hook
                    <i class="fa fa-info-circle"></i>
                </label>
            </div>

        </div>


        <div class="col-sm-6">
            <div>
                <label for="allow_user_move_back_and_forward">
                    {!! Form::hidden('allow_user_move_back_and_forward', 0) !!}
                    {!! Form::checkbox('allow_user_move_back_and_forward', 1, null,
                    ['id' => 'allow_user_move_back_and_forward']) !!}
                    Allow user to move back and forward
                    <i class="fa fa-info-circle" title="Allow the candidate to move back and forward in the questions"></i>
                </label>
            </div>
            <div>
                <label for="">
                    <input type="checkbox" >
                    Design multiple language test
                    <i class="fa fa-info-circle"></i>
                </label>
            </div>
            <div>
                <label for="apply_partial_marking">
                    {!! Form::hidden('apply_partial_marking', 0) !!}
                    {!! Form::checkbox('apply_partial_marking', 1, null,
                    ['id' => 'apply_partial_marking']) !!}
                    Apply Partial Marking
                    <i class="fa fa-info-circle"></i>
                </label>
            </div>
            <div>
                <label for="show_calculator">
                    {!! Form::hidden('show_calculator', 0) !!}
                    {!! Form::checkbox('show_calculator', 1, null,
                    ['id' => 'show_calculator']) !!}
                    Show Calculator
                    <i class="fa fa-info-circle"></i>
                </label>
            </div>
        </div>
    </div>
    <label for="allow_bonus_marking">
        {!! Form::hidden('allow_bonus_marking', 0) !!}
        {!! Form::checkbox('allow_bonus_marking', 1, null,
        ['id' => 'allow_bonus_marking']) !!}
        Allow Bonus Marking
        <i class="fa fa-info-circle"></i>
    </label>

</div>

<div class="mt-5">
    <p>Time Setting</p>
    <table class="table table-bordered">
        <tr>
            <td colspan="3">Amend the clock settings for a test</td>
        </tr>
        <tr>
            <th>Time Bound</th>
            <td>The Candidate has to finish the test in between the allocated time frame</td>
            <td>
                <label for="candidate_to_finish_test_between_allocated_time_frame_yes">
                    {!! Form::radio('candidate_to_finish_test_between_allocated_time_frame',
                    1, null, [
                         'id'=>'candidate_to_finish_test_between_allocated_time_frame_yes']) !!}
                    Yes
                </label>
                <label for="candidate_to_finish_test_between_allocated_time_frame_no">
                    {!! Form::radio('candidate_to_finish_test_between_allocated_time_frame',
                    0, null, [
                         'id'=>'candidate_to_finish_test_between_allocated_time_frame_no']) !!}
                    No
                </label>
            </td>
        </tr>
        <tr>
            <th>Clock Format</th>
            <td>Select Clock Format</td>
            <td>
                {!! Form::select('clock_format', ['12_hours', '24_hours'], null) !!}
            </td>
        </tr>
        <tr>
            <th>Section Wise Time </th>
            <td>If required you can allocate time to each section</td>
            <td>
                <label for="allow_time_to_each_section_yes">
                    {!! Form::radio('allow_time_to_each_section',
                    1, null, [
                         'id'=>'allow_time_to_each_section_yes']) !!}
                    Yes
                </label>

                <label for="allow_time_to_each_section_no">
                    {!! Form::radio('allow_time_to_each_section',
                    0, null, [
                         'id'=>'allow_time_to_each_section_no']) !!}
                    No
                </label>
            </td>
        </tr>
        <tr>
            <th>Question Wise Time</th>
            <td>Atomize time for all questions in test</td>
            <td>
                <label for="atomize_time_for_all_question_yes">
                    {!! Form::radio('atomize_time_for_all_question',
                    1, null, [
                         'id'=>'atomize_time_for_all_question_yes']) !!}
                    Yes
                </label>
                <label for="atomize_time_for_all_question_no">
                    {!! Form::radio('atomize_time_for_all_question',
                    0, null, [
                         'id'=>'atomize_time_for_all_question_no']) !!}
                    No
                </label>
            </td>
        </tr>
    </table>
</div>

<div class="mt-5">
    <table class="table table-bordered">
        <tr>
            <td colspan="3">Amend final phase changes to the test that includes result, score, message, etc</td>
        </tr>
        <tr>
            <th rowspan="3">Custom Message <i class="fa fa-info-circle text-gray-dark"></i> </th>
            <td>
                Show message
            </td>
            <td>
                <label for="show_message_yes">
                    {!! Form::radio('show_message',
                    1, null, [
                         'id'=>'show_message_yes']) !!}
                    Yes
                </label>
                <label for="show_message_no">
                    {!! Form::radio('show_message',
                    0, null, [
                         'id'=>'show_message_no']) !!}
                    No
                </label>
            </td>
        </tr>
        <tr>
            <td>Feedback for pass</td>
            <td>
                {!! Form::textarea('feedback_for_pass', null, ['class' => 'form-control', 'rows' => 10, 'cols' => 30]) !!}
            </td>
        </tr>
        <tr>
            <td>Feedback for fail</td>
            <td>
                {!! Form::textarea('feedback_for_fail', null, ['class' => 'form-control', 'rows' => 10, 'cols' => 30]) !!}
            </td>
        </tr>
        <tr>
            <th>Message On Submit Test</th>
            <td>
                {!! Form::textarea('message_on_submit_test', null, ['class' => 'form-control', 'rows' => 10, 'cols' => 30]) !!}
            </td>
        </tr>
        <tr>
            <th> Pass / Fail Marks (%)</th>
            <td>Define the passing percentage to the candidates </td>
            <td>
                {!! Form::text('pass_percentage', null, ['class' => 'form-control']) !!}
            </td>
        </tr>
    </table>
</div>

<div class="mt-5">
    <h6>Generate Rank</h6>
    <table class="table table-bordered">
        <tr>
            <td colspan="3">To produce the position of the candidates appearing in a test</td>
        </tr>
        <tr>
            <th>Generate Rank</th>
            <td>Calculate the ranks using automated or manual variation</td>
            <td>
                <label for="calculate_ranks_using_automated_or_manual_variation_automatic">
                    {!! Form::radio('calculate_ranks_using_automated_or_manual_variation',
                    'automatic', null,[
                         'id'=>'calculate_ranks_using_automated_or_manual_variation_automatic']) !!}
                    Automatic
                </label>
                <label for="calculate_ranks_using_automated_or_manual_variation_manual">
                    {!! Form::radio('calculate_ranks_using_automated_or_manual_variation',
                    'manual', null, [
                         'id'=>'calculate_ranks_using_automated_or_manual_variation_manual']) !!}
                    Manual
                </label>
            </td>
        </tr>
        <tr>
            <th rowspan="3">Rank</th>
            <td>Allow duplicate rank</td>
            <td>
                <label for="allow_duplicate_rank_yes">
                    {!! Form::radio('allow_duplicate_rank',
                    1, null, [
                         'id'=>'allow_duplicate_rank_yes']) !!}
                    Yes
                </label>
                <label for="allow_duplicate_rank_no">
                    {!! Form::radio('allow_duplicate_rank',
                    0, null, [
                         'id'=>'allow_duplicate_rank_no']) !!}
                    No
                </label>
            </td>
        </tr>
        <tr>
            <td>Skip after a duplicate</td>
            <td>
                <label for="skip_after_a_duplicate_yes">
                    {!! Form::radio('skip_after_a_duplicate',
                    1, null, [
                         'id'=>'skip_after_a_duplicate_yes']) !!}
                    Yes
                </label>

                <label for="skip_after_a_duplicate_no">
                    {!! Form::radio('skip_after_a_duplicate',
                    0, null, [
                         'id'=>'skip_after_a_duplicate_no']) !!}
                    No
                </label>
            </td>
        </tr>
        <tr>
            <td>Give priority to finish time</td>
            <td>
                <label for="give_priority_to_finish_time_yes">
                    {!! Form::radio('give_priority_to_finish_time',
                    1, null, [
                         'id'=>'give_priority_to_finish_time_yes']) !!}
                    Yes
                </label>
                <label for="give_priority_to_finish_time_no">
                    {!! Form::radio('give_priority_to_finish_time',
                    0, null, [
                         'id'=>'give_priority_to_finish_time_no']) !!}
                    No
                </label>
            </td>
        </tr>
    </table>
</div>

<div class="mt-5">
    <h6>Candidate Report Setting</h6>
    <table class="table table-bordered">
        <tr>
            <td colspan="3">Share report with Candidate as per your subsequent selection</td>
        </tr>
        <tr>
            <th>Test Taker Report</th>
            <td class="text-bold">Show reports</td>
            <td>
                <label for="show_reports_yes">
                    {!! Form::radio('show_reports',
                    1, null, [
                         'id'=>'show_reports_yes']) !!}
                    Yes
                </label>

                <label for="show_reports_no">
                    {!! Form::radio('show_reports',
                    0, null,  [
                         'id'=>'show_reports_no']) !!}
                    No
                </label>

            </td>
        </tr>
    </table>
</div>

<div class="mt-5">
    <h6>Multiple Attempt</h6>
    <table class="table table-bordered">
        <tr>
            <th> Multiple Attempt</th>
            <td>Enable Multiple attempt of test by a candidate</td>
            <td>
                <label for="multiple_attempt_yes">
                    {!! Form::radio('multiple_attempt',
                    1, null, [
                         'id'=>'multiple_attempt_yes']) !!}
                    Yes
                </label>
                <label for="multiple_attempt_no">
                    {!! Form::radio('multiple_attempt',
                    0, null, [
                         'id'=>'multiple_attempt_no']) !!}
                    No
                </label>
            </td>
        </tr>
    </table>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
{!! Form::close() !!}

<script>
    $(function() {
        $('#test-settings-form').submit(function (event) {
            event.preventDefault();

            $.post(this.action, $(this).serialize(), function (responseData, statusText, xhr) {
                if (xhr.status === 200) {
                    if (responseData.data !== undefined) {
                        toastr.success(responseData.data.message);
                    } else if (responseData.error !== undefined) {
                        toastr.error(responseData.error.message);
                    }
                    console.log(responseData);
                }
            });
            //console.log(this.action);
            //console.log(event);
        })
    });
</script>
