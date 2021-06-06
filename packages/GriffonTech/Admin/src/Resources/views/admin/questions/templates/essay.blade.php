{{ Form::open(['route' => 'admin.questions.store', 'id' => 'question_form', 'role' => 'form']) }}


<div class="form-group">
    <label for="">*Enter Essay Title</label>
    <input type="text" name="question" class="form-control">
</div>

<div>
    <input type="hidden" id="question-subject-id" name="subject_id">
    <input type="hidden" id="question-subject-topic-id" name="topic_id">
    <input type="hidden" name="type" id="type" value="essay">
</div>

<div class="form-group">
    <label for="question">*Essay Entry Option <i class="fa fa-info-circle"></i> </label>
    <textarea id="question" name="description" class="form-control" cols="30" rows="5"></textarea>
</div>



<div class="form-group">
    <label for="tags"> Tags</label>
    <input id="tags" type="text" class="form-control">
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
