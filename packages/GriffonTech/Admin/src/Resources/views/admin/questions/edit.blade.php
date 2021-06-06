@extends('admin::layouts.master')


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

                        {{ Form::model($question, ['route' => ['admin.questions.update', $question->id], 'id' => 'question_form', 'role' => 'form']) }}

                        @if ($question->type === 'essay')
                            <div class="form-group">
                                <label for="type"> Subject / Category </label>
                                {!! Form::select('subject_id', $subjects, null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="question"> Topic </label>
                                {!! Form::select('topic_id', $topics, null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="">*Enter Essay Title</label>
                                {!! Form::textarea('question', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 4]) !!}
                            </div>


                            <div class="form-group">
                                <label for="question">*Essay Entry Option <i class="fa fa-info-circle"></i> </label>
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 4]) !!}
                            </div>



                            <div class="form-group">
                                <label for="tags"> Tags</label>
                                {!! Form::text('tags', $question->tagString, ['class' => 'form-control']) !!}
                            </div>

                        @else

                            <div class="form-group">
                                <label for="type"> Subject / Category </label>
                                {!! Form::select('subject_id', $subjects, null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="question"> Topic </label>
                                {!! Form::select('topic_id', $topics, null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="question"> Question </label>
                                {!! Form::textarea('question', null, ['class' => 'form-control textarea', 'cols' => 30, 'rows' => 4]) !!}
                            </div>

                            {!! Form::hidden('type',null,['id' => 'question-type']) !!}

                            <?php $texts = ['A','B','C','D','E','F','G','H'] ?>

                            @if ($question['type'] === 'multiple_choice')

                                <div class="mb-5">
                                    <div id="question-options">

                                        <div class="row">
                                            <div class="col-sm-2"> <p class="text-uppercase">Correct</p> </div>
                                            <div class="col-sm-10"><p class="text-uppercase">Question Option</p></div>
                                        </div>
                                        @foreach($question->options as $index => $option)

                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <div class="question-option-container">
                                                        <p class="option-letter"> {{ $texts[$index] }} </p>
                                                        <div class="text-center">
                                                            <label for="option_answer_{{$index}}">
                                                                <input id="option_answer_{{$index}}"
                                                                       name="option_answer_correct"
                                                                       type="radio" value="{{$index}}"  {{ ($option['is_correct']) ? 'checked' : '' }} >
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="option_answer[{{$index}}][id]" value="{{$option['id']}}">
                                                    <textarea id="option_answer_text_{{$index}}" name="option_answer[{{$index}}][text]" class="form-control textarea-option" cols="30" rows="2">{{$option['option']}}</textarea>
                                                    @if ($index > 3)
                                                        <button class="remove-option-from-db" data-id="{{$option['id']}}"> <i class="fa fa-trash-alt text-danger"></i> </button>
                                                    @endif
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>
                                    <div>
                                        <button class="float-right" id="add-new-option"> <i class="fa fa-plus"></i> Add new option </button>
                                    </div>
                                </div>

                            @elseif ($question['type'] === 'multiple_response')

                                <div class="mb-5">
                                    <div id="question-options">
                                        <div class="row">
                                            <div class="col-sm-2"> <p class="text-uppercase">Correct</p> </div>
                                            <div class="col-sm-10"><p class="text-uppercase">Question Option</p></div>
                                        </div>

                                        @forelse($question->options as $index => $option)

                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <div class="question-option-container">
                                                        <p class="option-letter"> {{ $texts[$index] }} </p>
                                                        <div class="text-center">
                                                            <label for="option_answer_{{$index}}">
                                                                <input id="option_answer_{{$index}}" name="option_answer_correct[]"
                                                                       type="checkbox"
                                                                       value="{{$index}}"
                                                                    {{ ($option['is_correct']) ? 'checked' : '' }} >
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="option_answer[{{$index}}][id]" value="{{$option['id']}}">
                                                    <textarea id="option_answer_text_{{$index}}" name="option_answer[{{$index}}][text]" class="form-control" cols="30" rows="2">{{$option['option']}}</textarea>
                                                    @if ($index > 3)
                                                        <button class="remove-option-from-db" data-id="{{$option['id']}}"> <i class="fa fa-trash-alt text-danger"></i> </button>
                                                    @endif
                                                </div>
                                            </div>

                                            @endforeach

                                    </div>

                                    <div>
                                        <button id="add-new-option" class="float-right"> <i class="fa fa-plus"></i> Add new option </button>
                                    </div>
                                </div>

                            @elseif($question['type'] === 'true_or_false')


                                <div class="mb-5">
                                    <div data-container-id="">
                                        <div class="row">
                                            <div class="col-sm-2"> <p class="text-uppercase">Correct</p> </div>
                                            <div class="col-sm-10"></div>
                                        </div>

                                        @foreach($question->options as $option)

                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <div class="question-option-container">
                                                        <div class="text-center">
                                                            <label for="option_answer_{{$option['option']}}">
                                                                <input id="option_answer_{{$option['option']}}"
                                                                       name="option_answer_correct"
                                                                       type="radio"
                                                                       value="{{$option['option']}}"
                                                                    {{ ($option['is_correct']) ? 'checked' : '' }}>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <textarea disabled class="form-control" cols="30" rows="1">{{ucfirst($option['option'])}}</textarea>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>


                            @elseif ($question->type === "match_the_column")
                                <div class="mb-5">
                                    <div id="question-options">
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-5">S.NO CHOICE</div>
                                            <div class="col-sm-5">S.NO CHOICE</div>
                                        </div>

                                        @foreach($question->options as $index => $option)
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <div class="question-option-container">
                                                        <p class="option-letter"> {{$texts[$index]}} </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="option_answer[{{$index}}][id]" value="{{$option['id']}}">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <input type="text" name="option_answer[{{$index}}][text_1]" value="{{$option['option']}}" class="form-control">
                                                        </div>
                                                        <div class="col-sm-1 text-center"> <p> = </p></div>
                                                        <div class="col-sm-5">
                                                            <input type="text" name="option_answer[{{$index}}][text_2]" value="{{$option['option_match']}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    @if ($index > 3)
                                                        <button class="remove-option-from-db" data-id="{{$option['id']}}"> <i class="fa fa-trash-alt text-danger"></i> </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        <button class="float-right" id="add-new-option"> <i class="fa fa-plus"></i> Add new option </button>
                                    </div>
                                </div>


                            @elseif($question->type === 'fill_the_blank')

                                <div class="mb-5">
                                    <div data-container-id="">
                                        <div class="row">
                                            <div class="col-sm-2"> <p class="text-uppercase">Correct</p> </div>
                                            <div class="col-sm-10"><p class="text-uppercase">Question option/correct answer</p></div>
                                        </div>

                                        @if($question->options->isNotEmpty())
                                            <?php $option = $question->options->toArray()[0]; ?>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <div class="question-option-container">
                                                        <p class="option-letter"> 01 </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="option_answer[1][id]" value="{{$option['id']}}">
                                                    <textarea id="" name="option_answer[1][text]" class="form-control" cols="30" rows="2">{{ $option['option'] }} </textarea>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            @endif

                            <div class="form-group">
                                <label for="description"> Add Explanation </label>
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 4]) !!}
                            </div>

                            <div class="form-group">
                                <label for="tags"> Tags</label>
                                {!! Form::text('tags', $question->tagString, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label class="text-uppercase" for="">Right Marks <i class="fa fa-info-circle ml-3"></i> </label>
                                    {!! Form::text('right_mark', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="col-sm-3">
                                    <label class="text-uppercase" for="">Negative Marks <i class="fa fa-info-circle ml-3"></i> </label>
                                    {!! Form::text('negative_mark', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="col-sm-3 required">
                                    <label class="text-uppercase" for="question-difficulty">Difficulty <i class="fa fa-info-circle ml-3"></i> </label>
                                    {!! Form::select('difficulty_level', [
                                    '' => 'Select Difficulty',
                                    'difficulty' => 'Difficulty',
                                    'easy' => 'Easy',
                                    'normal' => 'Normal'], null, ['class' => 'form-control']) !!}
                                </div>
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
        var letters = ['A','B','C','D','E','F','G','H'];
        var next_letter_index = 4;


        $("#add-new-option").click(function(event){
            event.preventDefault();

            var all_option_letters = $(".option-letter").toArray();
            if (all_option_letters.length >= 8) { return; }

            var question_type = $("#question-type").val();
            var template;
            if (question_type === "multiple_choice") {
                template = '<div class="form-group row">\n' +
                    '            <div class="col-sm-2">\n' +
                    '                <div class="question-option-container">\n' +
                    '                    <p class="option-letter">'+ letters[next_letter_index] +'</p>\n' +
                    '                    <div class="text-center">\n' +
                    '                        <label for="option_answer_' + next_letter_index +'">\n' +
                    '                            <input id="option_answer_'+ next_letter_index +'" name="option_answer_correct" type="radio" value="'+ next_letter_index +'">\n' +
                    '                        </label>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '            <div class="col-sm-10">\n' +
                    '                <textarea id="option_answer_text_'+ next_letter_index +'" name="option_answer['+ next_letter_index +'][text]" class="form-control" cols="30" rows="2"></textarea>\n' +
                    '                <button class="remove-option"> <i class="fa fa-trash-alt text-danger"></i> </button>'+
                    '            </div>\n' +
                    '        </div>';

            } else if (question_type === 'multiple_response') {
                template = '<div class="form-group row">\n' +
                    '            <div class="col-sm-2">\n' +
                    '                <div class="question-option-container">\n' +
                    '                    <p class="option-letter">'+ letters[next_letter_index] +'</p>\n' +
                    '                    <div class="text-center">\n' +
                    '                        <label for="option_answer_' + next_letter_index +'">\n' +
                    '                            <input id="option_answer_'+ next_letter_index +'" name="option_answer_correct[]" type="checkbox" value="'+ next_letter_index +'">\n' +
                    '                        </label>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>\n' +
                    '            <div class="col-sm-10">\n' +
                    '                <textarea id="option_answer_text_'+ next_letter_index +'" name="option_answer['+ next_letter_index +'][text]" class="form-control" cols="30" rows="2"></textarea>\n' +
                    '                <button class="remove-option"> <i class="fa fa-trash-alt text-danger"></i> </button>'+
                    '            </div>\n' +
                    '        </div>';
            }else if (question_type === 'match_the_column') {
                template = '<div class="form-group row">\n' +
                    '                                        <div class="col-sm-2">\n' +
                    '                                            <div class="question-option-container">\n' +
                    '                                                <p class="option-letter"> ' + letters[next_letter_index] + ' </p>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                        <div class="col-sm-10">\n' +
                    '                                            <div class="row">\n' +
                    '                                                <div class="col-sm-5">\n' +
                    '                                                    <input type="text" name="option_answer[' + next_letter_index + '][text_1]" class="form-control">\n' +
                    '                                                </div>\n' +
                    '                                                <div class="col-sm-1 text-center"> <p> = </p></div>\n' +
                    '                                                <div class="col-sm-5">\n' +
                    '                                                    <input type="text" name="option_answer[' + next_letter_index +'][text_2]" class="form-control">\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                            <button class="remove-option"> <i class="fa fa-trash-alt text-danger"></i> </button>\n' +
                    '                                        </div>\n' +
                    '                                    </div>'
            }

            next_letter_index++;
            $("#question-options").append(template);
        });

        // removing an option from dom
        $("#question-options").on("click", ".remove-option", function(event) {
            event.preventDefault();
            event.currentTarget.parentElement.parentElement.remove();
            updateView();
        });

        $("#question-options").on("click", ".remove-option-from-db", function(event) {
            event.preventDefault();
            if (confirm('Are you sure ? it will be deleted from the database.')) {
                if (event.currentTarget.dataset.id !== undefined) {
                    $.post(window.location.origin
                        + '/admin/question-options/delete/' + event.currentTarget.dataset.id,
                        {_method: 'DELETE'}, function(responseData, statusText, xhr){
                            if (xhr.status === 204) {
                                event.currentTarget.parentElement.parentElement.remove();
                                updateView();
                            }
                    });
                }
            }
        });

        // reordering the option letters ...
        function updateView() {
            next_letter_index = 0;
            var all_option_letters = $(".option-letter").toArray();
            for (var num = 0; num < all_option_letters.length; num++) {
                $(all_option_letters[num]).text(letters[next_letter_index])
                next_letter_index++;
            }
        }
    </script>

    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote({
                height: 150
            });

            /*$('.textarea-option').summernote({
                height: 50
            });*/
        })
    </script>
@endsection
