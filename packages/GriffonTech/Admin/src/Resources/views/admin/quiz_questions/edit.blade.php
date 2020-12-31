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
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Questions</h3>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Subject</th>
                                <th>Score</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($quiz->questions) && !empty($quiz->questions))

                                @foreach($quiz->questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ $question->question->question }}</td>
                                        <td>{{ (!is_null($question->question->subject)) ? $question->question->subject->name : '' }}</td>
                                        <td>
                                            <div class="form-group">
                                                <input
                                                    data-original-value="{{ $question->score }}"
                                                    data-action="{{ route('quiz_questions.update', $question->id) }}"
                                                    value="{{ $question->score }}" type="number" class="form-control" name="score">
                                            </div>
                                        </td>
                                        <td>
                                            <a
                                                onclick="event.preventDefault();
                                                if (confirm('Are you sure ?')) {
                                                    document.getElementById('{{ $question->id }}').submit();
                                                }
                                                "
                                                href="#"
                                                class="btn btn-danger btn-sm">
                                                Remove Question
                                            </a>

                                            <form style="display: none" method="POST" id="{{ $question->id }}" action="{{ route('quiz_questions.delete', $question->id) }}">
                                                @csrf
                                                <input name="_method" value="DELETE" type="hidden">
                                            </form>
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


@endsection

@section('footer-script')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $(document).ready(function() {
            $('input[name="score"]').on("blur", function(event) {
                var input = event.target;
                var action = event.target.dataset.action;
                var original_value = event.target.dataset.originalValue;
                var value = event.target.value;
                if (original_value !== value) {
                    $.post(action, {score: value}, function (data) {
                        if (data.message === 'updated') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Score was successfully updated'
                            });
                            $(input).attr('data-original-value', value);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Score could not be updated.'
                            })
                        }
                    })
                }
                console.log({action, original_value, value});

            });
        });
    </script>
@stop
