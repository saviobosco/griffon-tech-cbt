<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <form action="#" class="form-inline">
                            <div class="form-group mr-2">
                                <select id="question-bank-subject-id" name="" class="form-control">
                                    <option value="0">Select Subject</option>
                                    @if(isset($subjects) && !empty($subjects))
                                        @foreach($subjects as $id => $name)
                                            <option value="{{ $id }}"> {{ $name }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <select id="question-bank-topic-id" name="" class="form-control">
                                    <option value="0">select topic </option>
                                </select>
                            </div>

                            <div class="form-group mr-3">
                                <select id="question-type" name="" class="form-control">
                                    <option value="0">select question type </option>
                                    <option value="multiple_choice">Multiple Choices</option>
                                    <option value="multiple_response">Multiple Responses</option>
                                    <option value="true_or_false">True/False</option>
                                    <option value="match_the_column">Match The Following</option>
                                    <option value="fill_the_blank">Fill in the blanks</option>
                                    <option value="essay">Essay</option>
                                </select>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div id="display-questions">
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

            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->


<script>
    $("#question-bank-subject-id").change(function (event) {
        var subject_id = this.value;
        if (subject_id > 0) {
            getSubjectTopics(subject_id);
        }
    });

    $("#question-bank-topic-id").change(function(event) {
        var topic_id = this.value;
        if (topic_id > 0) {
            fetchQuestion();
        }
    })


    $("#question-type").change(function(event) {
        // check if the requirements are selected.
        var subject_id = $("#question-bank-subject-id").val();
        subject_id = (subject_id !== undefined && subject_id > 0) ? subject_id : false;
        if (subject_id === false) {
            $("#question-bank-subject-id").focus();
            this.value = 0; // change it back;
            return;
        }

        var topic_id = $("#question-bank-topic-id").val();
        topic_id = (topic_id !== undefined && topic_id > 0) ? topic_id : false;
        if (topic_id === false) {
            $("#question-bank-topic-id").focus();
            this.value = 0; // change it back;
            return;
        }

        fetchQuestion();
    });

    function fetchQuestion() {
        // check if the requirements are selected.
        var subject_id = $("#question-bank-subject-id").val();
        subject_id = (subject_id !== undefined && subject_id > 0) ? subject_id : false;

        var topic_id = $("#question-bank-topic-id").val();
        topic_id = (topic_id !== undefined && topic_id > 0) ? topic_id : false;

        var question_type = $("#question-type").val();
        question_type = (question_type !== undefined && question_type !== 0) ? question_type : false;

        if (question_type !== false && topic_id !== false && subject_id !== false) {
            $.get(window.location.origin + '/admin/test-questions/get-questions/' + test_id, {
                subject_id: subject_id,
                topic_id: topic_id,
                question_type: question_type
            }, function(response) {
                $('#display-questions').html(response);
            });
        }
    }

    // load the subject topics via ajax
    function getSubjectTopics(subject_id) {
        var topic_options = $("#question-bank-topic-id option").toArray();
        topic_options.forEach(function(topic){
            topic = $(topic);
            if (topic.val() !== "0") {
                topic.remove();
            }
        });

        $.get(window.location.origin + '/admin/subjects/' + subject_id + '/topics/index', function(response){
            if (response && response.type !== undefined) {
                if (response.data.length > 0) {
                    response.data.forEach(function(topic){
                        var new_topic = document.createElement("OPTION");
                        new_topic.setAttribute("value", topic.id);
                        var topic_name = document.createTextNode(topic.topic);
                        new_topic.appendChild(topic_name);
                        $("#question-bank-topic-id").append(new_topic);
                    });
                }
            }
        })
    }


    $('#display-questions').on("submit",'#test-question-form', function (event) {
        event.preventDefault();

        $.post(this.action, $(this).serialize(), function(response) {
            toastr.success('Saved!');
            fetchQuestion();
        });
    });
</script>
