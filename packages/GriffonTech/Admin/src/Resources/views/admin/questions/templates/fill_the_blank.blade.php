{{ Form::open(['route' => 'admin.questions.store', 'id' => 'question_form', 'role' => 'form']) }}

<div class="form-group required">
    <label for="question">Type Your Question <i class="fa fa-info-circle"></i> </label>
    <textarea id="question" name="question" class="form-control" cols="30" rows="5"></textarea>
</div>

<div>
    <input type="hidden" id="question-subject-id" name="subject_id">
    <input type="hidden" id="question-subject-topic-id" name="topic_id">
    <input type="hidden" name="type" id="type" value="fill_the_blank">
</div>

<div class="mb-5">
    <div data-container-id="">
        <div class="row">
            <div class="col-sm-2"> <p class="text-uppercase">Correct</p> </div>
            <div class="col-sm-10"><p class="text-uppercase">Question option/correct answer</p></div>
        </div>

        <div class="form-group row">
            <div class="col-sm-2">
                <div class="question-option-container">
                    <p class="option-letter"> 01 </p>
                </div>
            </div>
            <div class="col-sm-10">
                <textarea id="" name="option_answer[1][text]" class="form-control" cols="30" rows="2"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description"> Add Explanation </label>
    <textarea id="description" name="description" class="form-control" cols="30" rows="5"></textarea>
</div>

<div class="form-group">
    <label for="tags"> Tags</label>
    <input id="tags" type="text" class="form-control">
</div>

<div class="form-group row">
    <div class="col-sm-3">
        <label class="text-uppercase" for="right_mark">Right Marks <i class="fa fa-info-circle ml-3"></i> </label>
        <input type="text" class="form-control" id="right_mark" name="right_mark">
    </div>

    <div class="col-sm-3">
        <label class="text-uppercase" for="negative_mark">Negative Marks <i class="fa fa-info-circle ml-3"></i> </label>
        <input type="text" class="form-control" id="negative_mark" name="negative_mark">
    </div>

    <div class="col-sm-3 required">
        <label class="text-uppercase" for="difficulty_level">Difficulty <i class="fa fa-info-circle ml-3"></i> </label>
        <select class="form-control" name="difficulty_level" id="difficulty_level">
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
