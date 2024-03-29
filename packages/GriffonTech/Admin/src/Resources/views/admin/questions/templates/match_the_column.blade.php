{{ Form::open(['route' => 'admin.questions.store', 'id' => 'question_form', 'role' => 'form']) }}


<div class="form-group required">
    <label for="question">Type Your Question <i class="fa fa-info-circle"></i> </label>
    <textarea id="question" name="question" class="form-control" cols="30" rows="5"></textarea>
</div>

<div>
    <input type="hidden" id="question-subject-id" name="subject_id">
    <input type="hidden" id="question-subject-topic-id" name="topic_id">
    <input type="hidden" name="type" id="type" value="match_the_column">
</div>

<div class="mb-5">
    <div id="question-options">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5">S.NO CHOICE</div>
            <div class="col-sm-5">S.NO CHOICE</div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> A </p>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="option_answer[1][text_1]" class="form-control">
                    </div>
                    <div class="col-sm-1 text-center"> <p> = </p></div>
                    <div class="col-sm-5">
                        <input type="text" name="option_answer[1][text_2]" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter">B</p>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="option_answer[2][text_1]" class="form-control">
                    </div>
                    <div class="col-sm-1 text-center"> <p> = </p></div>
                    <div class="col-sm-5">
                        <input type="text" name="option_answer[2][text_2]" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter">C</p>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="option_answer[3][text_1]">
                    </div>
                    <div class="col-sm-1 text-center"> <p> = </p></div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="option_answer[3][text_2]">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> D </p>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="option_answer[4][text_1]">
                    </div>
                    <div class="col-sm-1 text-center"> <p> = </p></div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="option_answer[4][text_2]">
                    </div>
                </div>
            </div>
        </div>

<!--        <div>
            <button class="float-right" id="add-new-option"> <i class="fa fa-plus"></i> Add new option </button>
        </div>-->
    </div>
</div>

<div class="form-group">
    <label for="description"> Add Explanation </label>
    <textarea id="description" name="description" class="form-control" cols="30" rows="5"></textarea>
</div>

<div class="form-group">
    <label for="tags"> Tags</label>
    <input id="tags" type="text" name="tags" class="form-control">
</div>

<div class="form-group row">
    <div class="col-sm-3">
        <label class="text-uppercase" for="">Right Marks <i class="fa fa-info-circle ml-3"></i> </label>
        <input type="text" class="form-control" name="right_mark">
    </div>

    <div class="col-sm-3">
        <label class="text-uppercase" for="">Negative Marks <i class="fa fa-info-circle ml-3"></i> </label>
        <input type="text" class="form-control" name="negative_mark">
    </div>

    <div class="col-sm-3 required">
        <label class="text-uppercase" for="question-difficulty">Difficulty <i class="fa fa-info-circle ml-3"></i> </label>
        <select class="form-control" name="difficulty_level" id="question-difficulty">
            <option value="">Select Difficulty</option>
            <option value="difficulty">Difficulty</option>
            <option value="easy">easy</option>
            <option value="normal" selected="selected">normal</option>
        </select>
    </div>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
{!! Form::close() !!}

<script>
    var letters = ['A','B','C','D','E','F','G','H'];
    var next_letter_index = 4;
    var option_index = 5;

    loadForm();


    /*$("#add-new-option").click(function(event){
        event.preventDefault();
        var all_option_letters = $(".option-letter").toArray();
        if (all_option_letters.length >= 8) { return; }
        var template = '<div class="form-group row">\n' +
            '            <div class="col-sm-2">\n' +
            '                <div class="question-option-container">\n' +
            '                    <p class="option-letter">'+ letters[next_letter_index] +'</p>\n' +
            '                    <div class="text-center">\n' +
            '                        <label for="option_answer_' + option_index +'">\n' +
            '                            <input id="option_answer_'+ option_index +'" name="option_answer_correct" type="radio" value="'+ option_index +'">\n' +
            '                        </label>\n' +
            '                    </div>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '            <div class="col-sm-10">\n' +
            '                <textarea id="option_answer_text_'+ option_index +'" name="option_answer['+ option_index +'][text]" class="form-control" cols="30" rows="2"></textarea>\n' +
            '                <button class="remove-option"> <i class="fa fa-trash-alt text-danger"></i> </button>'+
            '            </div>\n' +
            '        </div>';

        next_letter_index++;
        $("#question-options").append(template);
    });

    // removing an option from dom
    $("#question-options").on("click", ".remove-option", function(event) {
        event.preventDefault();
        event.currentTarget.parentElement.parentElement.remove();
        updateView();
    });

    // reordering the option letters ...
    function updateView() {
        next_letter_index = 0;
        var all_option_letters = $(".option-letter").toArray();
        for (var num = 0; num < all_option_letters.length; num++) {
            $(all_option_letters[num]).text(letters[next_letter_index])
            next_letter_index++;
        }
    }*/

    // setting the question-option-subject-id and question-option-subject-topic-id
    function loadForm() {
        var subject_id = $("#question-entry-options-subject-id");
        var topic_id = $("#question-entry-options-topic-id");


        $("#question-subject-id").val(subject_id.val());
        $("#question-subject-topic-id").val(topic_id.val());


        $("#question-entry-options-subject-id, #question-entry-options-topic-id").change(function(event) {
            var subject_id = $("#question-entry-options-subject-id");
            var topic_id = $("#question-entry-options-topic-id");
            $("#question-subject-id").val(subject_id.val());
            $("#question-subject-topic-id").val(topic_id.val());
        });
    }
</script>

