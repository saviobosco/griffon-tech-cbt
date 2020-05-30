@extends('layout.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Question</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        {{ Form::model($question, ['route' => ['questions.update', $question->id], 'id' => 'question_form', 'role' => 'form']) }}

                        <div class="form-group">
                            <label for="type"> Subject / Category </label>
                            {!! Form::select('subject_id', $subjects, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="question"> Question </label>
                            {!! Form::textarea('question', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 4]) !!}
                        </div>

                        <div class="form-group">
                            <label for="description"> Description </label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 4]) !!}
                        </div>


                    @if (in_array($question['type'], ['multiple_select_multiple_answer', 'multiple_select_single_answer', 'match_the_column']))
                            <div id="question_options_container">
                                <h2> Question Options </h2>

                            @if(!empty($question->options))
                                    <?php $number = 1;  ?>
                                    @foreach($question->question_options as $index => $option)

                                        @if ($question->type === 'multiple_select_single_answer')
                                            <div data-container-id="{{ $option->id }}">
                                                <div class="form-group">
                                                    <label for="option_answer_text_{{ $option->id }}"> #Option {{ $number }} </label>
                                                    <textarea id="option_answer_text_{{ $option->id }}" name="option_answer[{{ $option->id }}][text]" class="form-control" cols="30" rows="3">{{ $option->option }}</textarea>
                                                    <div class="mt-3">
                                                        <label for="option_answer_{{ $option->id }}">
                                                            <input id="option_answer_{{ $option->id }}"
                                                                   name="option_answer_correct" type="radio"
                                                                   value="{{ $option->id }}"
                                                                   <?= ($option->is_correct) ? 'checked=checked' : '' ?>
                                                            > correct answer
                                                        </label>
                                                        <button data-id="{{ $option->id }}" class="btn btn-danger btn-sm">remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        @if ($question->type === 'multiple_select_multiple_answer')
                                                <div data-container-id="{{ $option->id }}">
                                                    <div class="form-group">
                                                        <label for="option_answer_text_{{ $option->id }}"> #Option {{ $number }} </label>
                                                        <textarea id="option_answer_text_{{ $option->id }}" name="option_answer[{{ $option->id }}][text]" class="form-control" cols="30" rows="3">{{ $option->option }}</textarea>
                                                        <div class="mt-3">
                                                            <label for="option_answer_{{ $option->id }}">
                                                                <input id="option_answer_{{ $option->id }}"
                                                                       name="option_answer[{{ $option->id }}][correct]"
                                                                       <?= ($option->is_correct) ? 'checked=checked' : '' ?>
                                                                       type="checkbox"> correct answer
                                                            </label>
                                                            <button data-id="{{ $option->id }}" class="btn btn-danger btn-sm">remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif

                                        @if ($question->type === 'match_the_column')

                                                <div data-container-id="{{ $option->id }}">
                                                    <div class="form-group">
                                                        <label for="option_answer_text_{{ $option->id }}"> #Option {{ $number }} </label>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <input type="text" name="option_answer[{{ $option->id }}][text_1]" value="{{ $option->option }}" class="form-control">
                                                            </div>
                                                            <div class="col-sm-1 text-center">
                                                                =
                                                            </div>
                                                            <div class="col-sm-4 text-left">
                                                                <input type="text" name="option_answer[{{ $option->id }}][text_2]" value="{{ $option->option_match }}"  class="form-control">
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div>
                                                                    <button data-id="{{ $option->id }}" class="btn btn-danger btn-sm">remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        @endif

                                        <?php $number++; ?>
                                    @endforeach

                                @endif
                            </div>
                        @endif








                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}

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
        $(document).ready(function() {
            $('#question_options_container').click(function (event) {
                // capture all click event in this container.
                //event.preventDefault();
                if (event.target.tagName === "BUTTON") {
                    event.preventDefault();
                    var element_id = event.target.dataset.id;

                    if ( event.target.className.indexOf("btn-danger") !== -1) {
                        if (confirm('Are you sure you want to remove this option? You cannot reverse this operation.')) {

                            $.ajax({
                                url: window.origin + '/question_options/delete/' + element_id,
                               type: 'POST',
                                headers: { 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content },
                                data: {
                                    _method: 'DELETE'
                                },
                                dataType: 'text',
                                success: function(data) {
                                    var element_container = $('div[data-container-id="' + element_id +'"]').first();
                                    if (element_container !== undefined) {
                                        element_container.remove();
                                    }
                                    alert(data);
                                },
                                error: function() {
                                    alert('An error occurred processing your request');
                                }
                            });
                        }



                    }
                }
            });
        });
    </script>
@endsection
