@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        <ul class="form-step-list">
                            <li class="step active" id="create-new-test">
                                <div>
                                    <p>
                                       1. Create a new test
                                    </p>
                                </div>
                            </li>
                            <li class="step" id="test-setting">
                                <div>
                                    <p>
                                       2. Test Settings
                                    </p>
                                </div>
                            </li>
                            <li class="step" id="add-questions">
                                <div>
                                    <p>3.Add questions</p>
                                </div>
                            </li>
                            <li class="step" id="publish-test">
                                <div>
                                    <p>4. Publish</p>
                                </div>
                            </li>
                            <li class="step" id="assign-test">
                                <div>
                                    <p>5. Assign Test</p>
                                </div>
                            </li>
                            <li class="step" id="create-certificate">
                                <div>
                                    <p>6. Create Certificate</p>
                                </div>
                            </li>
                        </ul>
                        <div>
                            <div class="form-tabs">
                                <div class="form-step-tab" data-id="create-new-test">
                                    {!! Form::open(['route' => 'admin.tests.store', 'role' => 'form']) !!}

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group required">
                                                <label for="name">Test Name </label>
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Quiz Name']) !!}
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group required">
                                                        <label for="test_category_id">Select Category</label>
                                                        {!! Form::select('test_category_id', $testCategories, null, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group required">
                                                        <label for="test_instructions">Test Instructions</label>
                                                        {!! Form::select('test_instruction_id', $testInstructions, null, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group required">
                                                        <label for="duration">Duration(In Min.)</label>
                                                        <input type="text" name="duration" id="duration" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group required">
                                                        <label for="difficulty_level">Difficulty Level</label>
                                                        <select name="difficulty_level" id="difficulty_level" class="form-control">
                                                            <option value="difficulty">Difficult</option>
                                                            <option value="easy">Easy</option>
                                                            <option value="normal">Normal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group required">
                                                        <label for="total_question">Total Question</label>
                                                        <input type="text" id="total_question" name="total_question" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group required">
                                                        <label for="total_mark">Total Marks</label>
                                                        <input type="text" id="total_mark" name="total_mark" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group required">
                                                <label for="test_template">Test Template</label>

                                                <select name="template" id="test_template" class="form-control">
                                                    <option value="default_template">Default</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>

<!--                                <div class="form-step-tab" data-id="test-setting">
                                    {!! Form::open(['route' => 'admin.tests.store', 'role' => 'form']) !!}

                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="3">Shuffle and bundle questions to vivid sets with similar questions </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">Grouping</td>
                                            <td> Shuffle questions within subject </td>
                                            <td>
                                                <label for="shuffle_question_in_subject_yes">
                                                    <input id="shuffle_question_in_subject_yes" name="shuffle_question_in_subject" type="radio">Yes
                                                </label>
                                                <label for="shuffle_question_in_subject_no">
                                                    <input id="shuffle_question_in_subject_no" name="shuffle_question_in_subject" type="radio">No
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Group questions subjectwise </td>
                                            <td>
                                                <label for="group_questions_subject_wise_yes">
                                                    <input id="group_questions_subject_wise_yes" name="group_questions_subject_wise" type="radio">Yes
                                                </label>
                                                <label for="group_questions_subject_wise_no">
                                                    <input id="group_questions_subject_wise_no" name="group_questions_subject_wise" type="radio">No
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Shuffling </td>
                                            <td>Optionwise shuffling</td>
                                            <td>
                                                <label for="option_wise_shuffling_yes">
                                                    <input id="option_wise_shuffling_yes" name="option_wise_shuffling" type="radio">Yes
                                                </label>
                                                <label for="option_wise_shuffling_no">
                                                    <input id="option_wise_shuffling_no" name="option_wise_shuffling" type="radio">No
                                                </label>
                                            </td>
                                        </tr>
                                    </table>

                                    <div>
                                        <p>Set the required fields for a candidate appearing in the test</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <label for="mandatory_to_attempt_all_question">
                                                        <input id="mandatory_to_attempt_all_question" name="mandatory_to_attempt_all_question" type="checkbox" > Mandatory to attempt all question
                                                        <i class="fa fa-info-circle"></i>
                                                    </label>
                                                </div>
                                                <div>
                                                    <label for="show_marks_for_test">
                                                        <input id="show_marks_for_test" name="show_marks_for_test" type="checkbox" > Show marks/points for test
                                                        <i class="fa fa-info-circle"></i>
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
                                                    <label for=""> <input type="checkbox" > Allow user to move back and forward <i class="fa fa-info-circle"></i> </label>
                                                </div>
                                                <div>
                                                    <label for=""> <input type="checkbox" > Design multiple language test <i class="fa fa-info-circle"></i> </label>
                                                </div>
                                                <div>
                                                    <label for=""> <input type="checkbox" > Apply Partial Marking <i class="fa fa-info-circle"></i> </label>
                                                </div>
                                                <div>
                                                    <label for=""> <input type="checkbox" > Show Calculator <i class="fa fa-info-circle"></i> </label>
                                                </div>
                                            </div>
                                        </div>
                                        <label for=""> <input type="checkbox" > Allow Bonus Marking <i class="fa fa-info-circle"></i> </label>

                                    </div>

                                    <div>
                                        <p>Time Setting</p>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td colspan="3">Amend the clock settings for a test</td>
                                            </tr>
                                            <tr>
                                                <th>Time Bound</th>
                                                <td>The Candidate has to finish the test in between the allocated time frame</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Clock Format</th>
                                                <td>Select Clock Format</td>
                                                <td>
                                                    <select name="" id="">
                                                        <option value="">12 hours</option>
                                                        <option value="">24 hours</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Section Wise Time </th>
                                                <td>If required you can allocate time to each section</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Question Wise Time</th>
                                                <td>Automize time for all questions in test</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div>
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
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Feedback for pass</td>
                                                <td><textarea name="" id="" cols="30" rows="10" class="form-control"></textarea> </td>
                                            </tr>
                                            <tr>
                                                <td>Feedback for fail</td>
                                                <td>
                                                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Message On Submit Test</th>
                                                <td>
                                                    <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> Pass / Fail Marks (%)</th>
                                                <td>Define the passing percentage to the candidates </td>
                                                <td>
                                                    <input type="text" class="form-control">
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
                                                    <label for=""><input type="radio">Automatic</label>
                                                    <label for=""><input type="radio">Manual</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th rowspan="3">Rank</th>
                                                <td>Allow duplicate rank</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Skip after a duplicate</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Give priority to finish time</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
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
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div>
                                        <h6>Multiple Attempt</h6>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th> Multiple Attempt</th>
                                                <td>Enable Multiple attempt of test by a candidate</td>
                                                <td>
                                                    <label for=""><input type="radio">Yes</label>
                                                    <label for=""><input type="radio">No</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div>
                                        <h6> Publish Test</h6>
                                        <div class="form-group">
                                            <label for="publish_test">
                                                <input id="publish_test" type="checkbox"> Publish Test
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="start_date_and_end_date">*Start & End Date</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="start_date_and_end_date">*Start & End Time</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="publish_test">
                                                <input id="publish_test" type="checkbox"> Advanced Time Option
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="start_date_and_end_date">*Max Submit Date &Fix End Date</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="start_date_and_end_date">*Max Submit Time &Fix End Time</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input id="start_date_and_end_date" type="text" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

@section('footer-script')
    <script>
        $('.step').click(function(event) {
            event.preventDefault();

            //displayTab(event.currentTarget.id);
        });

        function displayTab(tabId) {
            $('.step').removeClass('active');

            $('#' + tabId).addClass('active');

            $('.form-step-tab').hide();
            $("[data-id="+ tabId +"]").show();
        }

        displayTab('create-new-test');
    </script>

@endsection

