@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quiz Details</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Quiz Name</th>
                                <td>{{ $quiz->name }} </td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a class="btn btn-info" href="{{ route('admin.quiz_questions.edit', $quiz->id) }}">Edit Quiz Questions</a>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Questions</h3>


                        <div class="card-tools">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control input-sm" name="" id="">
                                            <option value="">Mathematics</option>
                                            <option value="">English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group" style="width: 150px; margin-top: 0">
                                        <input type="text" name="table_search" class="form-control" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Subject</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($questions) && !empty($questions))
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ (is_object($question->subject)) ? $question->subject->name : '' }}</td>
                                        <td>{{ $question->created_at->format('l jS \\of F, Y')  }}</td>
                                        <td>

                                            <a data-added-id="{{ $question->id }}"  <?= (in_array($question->id, $question_ids)) ? '' : 'style="display:none;"' ?>
                                                  class="btn btn-primary btn-sm" href="#"> <i class="fa fa-check-circle"></i> Question Added </a>

                                            <a <?= (in_array($question->id, $question_ids)) ? 'style="display:none"' : '' ?>
                                                data-quiz-id="{{ request()->get('quiz_id') }}" data-question-id="{{ $question->id }}" data-question="{{ $question }}" class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#modal-default">Add Question</a>

                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No questions!</td>
                                </tr>

                            @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


    <!-- Modal-->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            {!! Form::open(['route' => 'quiz_questions.create', 'id' => 'add-question-form']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="form-question-id" name="question_id">
                    <input type="hidden" id="form-quiz-id" name="quiz_id">

                    <div class="form-group">
                        <p> <strong>Question</strong></p>
                        <p id="preview_question">

                        </p>
                    </div>

                    <div>
                        <p> Question Type : <span id="preview_question_type"></span> </p>
                    </div>

                    <div class="form-group">
                        <label for="score"> Question Score </label>
                        <input type="number" id="score" name="score" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Question</button>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('footer-script')
    <script>

        $('#modal-default').on('show.bs.modal', function (event) {
            var triggeredElement = $(event.relatedTarget);
            var question = triggeredElement.data('question');
            var question_id = triggeredElement.data('question-id');
            var quiz_id = triggeredElement.data('quiz-id');

            document.getElementById("preview_question").innerText = question.question
            document.getElementById("preview_question_type").innerText = question.type
            document.getElementById("form-question-id").value = question_id;
            document.getElementById("form-quiz-id").value = quiz_id;


            $('#add-question-form').submit(function(event) {
                event.preventDefault();
                var score = document.getElementById('score').value;
                if (score === "") {
                    alert('Score cannot be empty');
                    return false;
                }
                var formData = $(this).serialize();
                $.post(this.action, formData, function(data, statusText) {
                    console.log(data);
                    if (data.response !== undefined) {
                        if (data.response === true) {

                            triggeredElement.hide();
                            $('a[data-added-id='+ question_id +']').first().show();

                            // closing the modal
                            $('#modal-default').modal('hide');

                        } else if (data.response === false) {
                            alert('Could not add the question. Please try again.');
                        }
                    }
                });
            })
        });
    </script>
@stop
