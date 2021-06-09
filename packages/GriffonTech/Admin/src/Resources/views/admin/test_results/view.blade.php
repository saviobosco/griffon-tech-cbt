@extends('admin::layouts.master')

@section('page_title')
    Test Result for {{ ($testSession->candidate) ? $testSession->candidate->name : '' }} - {{ $testSession->id }}
@stop


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> {{ ($testSession->test) ? $testSession->test->name .' ('. $testSession->test->test_category->name .')' : 'Test Session :'. $testSession->id }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <a href="" class="btn btn-danger float-right"
                            onclick="event.preventDefault(); if (confirm('Are you sure? This operation is irreversible.')) {
                                document.getElementById('delete-test-result-{{$testSession->id}}').submit();
                            }">
                                Delete Result
                            </a>
                            <form id="delete-test-result-{{$testSession->id}}" action="{{ route('admin.test_results.delete', $testSession->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    <i class="fa fa-user"></i> Candidate : {{ $testSession->candidate->name }}
                                </p>
                                <p>
                                    <i class="fa fa-clock"></i> Date Taken: {{ $testSession->created_at }}
                                </p>
                                <p>
                                    <i class="fa fa-calendar-alt"></i> Session Start Time: {{ $testSession->start_time }}
                                </p>
                                <p>
                                    <i class="fa fa-calendar-alt"></i> Session End Time: {{ $testSession->end_time }}
                                </p>
                                <p>
                                    <i class="fa fa-clock"></i> Time Spent: 40 minutes
                                </p>
                                <p>
                                    <strong>Score</strong> : {{ $testSession->total_score }}
                                </p>
                                <p>
                                    <strong>Status</strong> :
                                    @switch($testSession->status)
                                        @case(1)
                                            <span class="text-danger">Active</span>
                                            @break
                                        @case(2)
                                            <span class="text-primary">Pending</span>
                                            @break
                                        @case(3)
                                            <span class="text-success">Completed</span>
                                    @endswitch
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <p>
                                    A graph chart will be placed here.
                                </p>

                                <p><span class="text-success">Passed</span> : 40%</p>
                                <p><span class="text-danger">Failed</span> : 60%</p>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Questions</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="height: 100%;">

                                <?php $num = 1; ?>
                                @foreach($questions as $question)
                                    <div class="mt-3 p-4 border question-container" id="question-number-{{$num}}">
                                        <h6>Question: {{ $num }} </h6>
                                        <p class="text-bold"> {{ $question->question }} </p>

                                        <div class="mt-4">
                                            @if ($question->type === 'multiple_choice')
                                                <?php
                                                    $answer = (isset($testSessionAnswers[$question->id][0])) ?
                                                        $testSessionAnswers[$question->id][0]['question_option_id'] : '';
                                                ?>
                                                @foreach($question->options as $option)
                                                    <p {{ ($option->is_correct) ? 'class=text-success' : (((int)$option->id === (int)$answer) ? 'class=text-danger' : '') }}><input type="radio" disabled {{ ((int)$option->id === (int)$answer) ? 'checked=checked' : '' }}>
                                                        {{ $option->option }}
                                                    </p>
                                                @endforeach
                                            @elseif ($question->type === 'multiple_response')

                                                <?php
                                                $answers = [];
                                                if (isset($testSessionAnswers[$question->id])) {
                                                    foreach ($testSessionAnswers[$question->id] as $answer) {
                                                        $answers[] = $answer['question_option_id'];
                                                    }
                                                }
                                                ?>
                                                @foreach($question->options as $option)
                                                    <p {{ ($option->is_correct) ? 'class=text-success' : ((in_array($option->id, $answers)) ? 'class=text-danger' : '') }}><input type="checkbox" disabled {{ (in_array($option->id, $answers)) ? 'checked=checked' : '' }}>
                                                        {{ $option->option }}
                                                    </p>
                                                @endforeach

                                            @elseif ($question->type === 'true_or_false')

                                                <?php
                                                $answer = (isset($testSessionAnswers[$question->id][0])) ?
                                                    $testSessionAnswers[$question->id][0]['question_option_id'] : '';
                                                ?>
                                                @foreach($question->options as $option)
                                                    <p {{ ($option->is_correct) ? 'class=text-success' : (((int)$option->id === (int)$answer) ? 'class=text-danger' : '') }}><input type="radio" disabled {{ ((int)$option->id === (int)$answer) ? 'checked=checked' : '' }}>
                                                        {{ $option->option }}
                                                    </p>
                                                @endforeach

                                            @elseif($question->type === 'match_the_column')
                                                <?php
                                                $savedAnswers = [];
                                                if (isset($testSessionAnswers[$question->id])) {
                                                    foreach ($testSessionAnswers[$question->id] as $testSessionAnswer) {
                                                        if ((int)$testSessionAnswer['question_id'] === (int)$question->id) {
                                                            $savedAnswers[] = $testSessionAnswer['answer_text'];
                                                        }
                                                    }
                                                }

                                                $optionMatches = $question->options->pluck('option_match');

                                                /*$correctAnswers = [];
                                                foreach ($question->options as $question_option) {
                                                    $correctAnswers[] = $question_option->option.'__'.$question_option->option_match;
                                                }*/
                                                ?>
                                                    @foreach($question->options as $option)
                                                        <div class="row">
                                                            <div class="col-sm-1">
                                                                <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 4px; border-radius: 5px;">
                                                                    {{ $option->option }}
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <select class="form-control-sm" disabled>
                                                                    @foreach($optionMatches as $optionMatch)
                                                                        <option value="{{$option->option}}__{{ $optionMatch }}"
                                                                            {{ (in_array($option->option.'__'.$optionMatch, $savedAnswers)) ? 'selected' : '' }}>
                                                                            {{ $optionMatch }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <p> {{ $option->option }} = {{ $option->option_match }} </p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                            @elseif ($question->type === 'fill_the_blank')

                                                <?php
                                                $answer = (isset($testSessionAnswers[$question->id][0])) ?
                                                    $testSessionAnswers[$question->id][0]['answer_text'] : '';

                                                $correct_answer = $question->options()->first()->option;
                                                ?>

                                                <input class="{{ ($answer == $correct_answer) ? 'text-success' : 'text-danger' }} text-success" type="text" value="{{ $answer }}" disabled>
                                                <p>Correct Answer : {{ $correct_answer }} </p>

                                            @elseif ($question->type === 'essay')
                                                <?php
                                                $answer = (isset($testSessionAnswers[$question->id][0])) ?
                                                    $testSessionAnswers[$question->id][0] : null;
                                                ?>
                                                <textarea class="form-control" name="" id="" cols="30" rows="10" disabled>{{ (!is_null($answer)) ? $answer['answer_text'] : '' }}</textarea>

                                                @if (!is_null($answer) && is_null($answer['score']))
                                                <div class="mt-3">
                                                    <label for="score">Score</label>
                                                    <input type="number" name="score">
                                                    <button class="btn btn-success btn-sm">Save</button>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <?php $num++; ?>
                                @endforeach

                                    <div class="mt-3 questions-number-container mb-5">
                                        <?php  $num = 1; ?>
                                        @foreach($questions as $question)
                                            <button class="btn btn-default btn-sm">{{ $num++ }}</button>
                                        @endforeach
                                    </div>

                                    <a href="" class="btn btn-success"
                                       onclick=" event.preventDefault();
                                       if (confirm('This operation will re calculate the test results. Are you sure ?')) {
                                           document.getElementById('re-process-result-{{$testSession->id}}').submit();
                                       }"
                                    >Re-process result</a>

                                    <form id="re-process-result-{{$testSession->id}}" action="{{ route('admin.test_results.re_process_result', $testSession->id) }}" method="POST">
                                        @csrf
                                    </form>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->



            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('footer-script')
    <script>
        (function(){
            $(".question-container").hide();

            // show the first question container
            $(".question-container").first().show();
        })();

        $(".questions-number-container").on("click", "button", function(event){
            //$(".questions-number-container button").removeClass("btn-primary");
            //$(".questions-number-container button").addClass("btn-default");

            let button = $(event.currentTarget);
            /*if (button.hasClass("btn-default")) {
                button.removeClass("btn-default");
                button.addClass("btn-primary");
            }*/
            $(".question-container").hide();
            $("#question-number-" + button.text()).show();
        });

    </script>
@endsection
