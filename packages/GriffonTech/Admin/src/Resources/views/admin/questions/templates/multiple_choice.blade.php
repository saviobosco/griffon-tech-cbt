{{ Form::open(['route' => 'admin.questions.store', 'id' => 'question_form', 'role' => 'form']) }}


<div class="form-group required">
    <label for="question">Type Your Question <i class="fa fa-info-circle"></i> </label>
    <textarea id="question" name="question" class="form-control" cols="30" rows="5"></textarea>
</div>

<div>
    <input type="hidden" id="question-subject-id" name="subject_id">
    <input type="hidden" id="question-subject-topic-id" name="topic_id">
    <input type="hidden" name="type" id="question-type" value="multiple_choice">
</div>

<div class="mb-5">
    <div id="question-options">
        <div class="row">
            <div class="col-sm-2"> <p class="text-uppercase">Correct</p> </div>
            <div class="col-sm-10"><p class="text-uppercase">Question Option</p></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> A </p>
                    <div class="text-center">
                        <label for="option_answer_1">
                            <input id="option_answer_1" name="option_answer_correct" type="radio" value="1">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <textarea id="option_answer_text_1" name="option_answer[1][text]" class="form-control" cols="30" rows="2"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> B </p>
                    <div class="text-center">
                        <label for="option_answer_2">
                            <input id="option_answer_2" name="option_answer_correct" type="radio" value="2">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <textarea id="option_answer_text_2" name="option_answer[2][text]" class="form-control" cols="30" rows="2"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> C </p>
                    <div class="text-center">
                        <label for="option_answer_3">
                            <input id="option_answer_3" name="option_answer_correct" type="radio" value="3">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <textarea id="option_answer_text_3" name="option_answer[3][text]" class="form-control" cols="30" rows="2"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> D </p>
                    <div class="text-center">
                        <label for="option_answer_4">
                            <input id="option_answer_4" name="option_answer_correct" type="radio" value="4">
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <textarea id="option_answer_text_4" name="option_answer[4][text]" class="form-control" cols="30" rows="2"></textarea>
            </div>
        </div>

    </div>
    <div>
        <button class="float-right" id="add-new-option"> <i class="fa fa-plus"></i> Add new option </button>
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
            <option value="normal">normal</option>
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


    $("#add-new-option").click(function(event){
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
    }

    // setting the question-option-subject-id and question-option-subject-topic-id
    function loadForm() {
        var subject_id = $("#question-entry-options-subject-id");
        var topic_id = $("#question-entry-options-topic-id");


        $("#question-subject-id").val(subject_id.val());
        $("#question-subject-topic-id").val(topic_id.val());

        // on changes to any of the inputs? make changes to the hidden inputs.
        $("#question-entry-options-subject-id, #question-entry-options-topic-id").change(function(event) {
            var subject_id = $("#question-entry-options-subject-id");
            var topic_id = $("#question-entry-options-topic-id");
            $("#question-subject-id").val(subject_id.val());
            $("#question-subject-topic-id").val(topic_id.val());
        });
    }

    // add question form handler
    $(document).ready(function() {
        $('#question_form').submit(function(event){
            event.preventDefault();
            // check the question type
            let question_type = $('#question-type').val();
            // if the type is multiple choices or multiple response
            if (question_type === 'multiple_choice') {
                let option_selected = false;
                let options = $('#question_form .question-option-container input');
                options = Array.prototype.slice.call(options);

                options.forEach(function(value) {
                    if ($(value).is(':checked')) {
                        option_selected = true;
                    }
                });
                if (option_selected === false) {
                    toastr.error('Select as least one option as correct answer!');
                    return false;
                }
            }

            // remove the event handler and submit the form;
            $(this).off('submit').submit();
        });
    });

</script>
