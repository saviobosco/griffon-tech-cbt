@if (isset($questions) && $questions->isNotEmpty())

    {!! Form::open(['route' => ['admin.test_questions.update', $test->id], 'id' => 'test-question-form']) !!}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Questions</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;">

            <table class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <td><input type="checkbox"></td>
                    <th>Question Details</th>
                    <th>Type</th>
                    <th>Right Mark</th>
                    <th>Wrong Mark</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $index => $question)
                    <tr>
                        <td>
                            <input type="checkbox" name="questions[{{$index}}][question_id]" value="{{$question->id}}"  {{ (isset($testQuestions[$question->id])) ? 'checked="checked"' : '' }}>

<!--                            <input type="hidden" name="questions[{{$index}}][question_id]" value="{{$question->id}}">
                            -->
                            @if (isset($testQuestions[$question->id]))
                                <input type="hidden" name="questions[{{$index}}][test_question_id]" value="{{$testQuestions[$question->id][0]['id'] }}">
                            @endif
                        </td>
                        <td>
                            {{ $question->question }}
                        </td>

                        <td>
                            {{ $question->type }}
                        </td>
                        @if ($question->type === 'essay')
                            <td colspan="2"></td>
                        @else
                            <td>

                                <input type="text" class="form-control" name="questions[{{$index}}][right_mark]"
                                       value="{{ (isset($testQuestions[$question->id])) ? $testQuestions[$question->id][0]['right_mark'] : $question->right_mark }}">
                            </td>

                            <td>
                                <input type="text" class="form-control" name="questions[{{$index}}][negative_mark]"
                                       value="{{ (isset($testQuestions[$question->id])) ? $testQuestions[$question->id][0]['negative_mark'] : $question->negative_mark }}">
                            </td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-sm">Add Question</button>
    </div>
    {!! Form::close() !!}


    <div id="pagination-links">
        {{ $questions->links() }}
    </div>
@else

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Questions</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 100%;">

            <table class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>Question Details</th>
                    <th>Type</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="4" class="text-center">No Questions!</td>
                </tr>
                </tbody>

            </table>

        </div>
        <!-- /.card-body -->
    </div>
@endif
