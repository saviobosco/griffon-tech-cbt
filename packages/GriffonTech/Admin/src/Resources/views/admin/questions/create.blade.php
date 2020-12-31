@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Question Entry Options</h3>
                    </div>
                    <div class="card-body">
                        <form action="" class="question-entry-options">
                            <div class="form-group">
                                <label for="question-entry-options-subject-id" class="text-uppercase">
                                    *Select Subject
                                    <i class="fa fa-info-circle ml-3" data-toggle="tooltip" data-placement="top" title="Select the subject for this question"></i>
                                </label>
                                <select name="subject_id" id="question-entry-options-subject-id" class="form-control">
                                    @if(isset($subjects))
                                        @foreach($subjects as $id => $name)
                                            <option value="{{ $id }}"> {{ $name }}</option>
                                        @endforeach
                                    @endif
                                    <option value="add-subject" class="text-bold">Add Subject</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="question-entry-options-topic-id" class="text-uppercase">*Select Topic <i class="fa fa-info-circle ml-3"></i> </label>
                                <select name="subject_topic_id" id="question-entry-options-topic-id" class="form-control">
                                    <option value="0">Select Topic</option>
                                    <option class="text-bold" value="add-topic">Add Topic</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="question-entry-options-question-type-id" class="text-uppercase">*Question Type <i class="fa fa-info-circle ml-3"></i> </label>
                                <select name="question_type_id" id="question-entry-options-question-type-id" class="form-control">
                                    <option value="0">Select Question Type</option>
                                    <option value="multiple_choice">Multiple Choices</option>
                                    <option value="multiple_response">Multiple Responses</option>
                                    <option value="true_or_false">True/False</option>
                                    <option value="match_the_column">Match The Following</option>
                                    <option value="fill_the_blank">Fill in the blanks</option>
                                    <option value="essay">Essay</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="question-type-id" class="text-uppercase">Language <i class="fa fa-info-circle ml-3"></i> </label>
                                <select name="question_type_id" id="question-type-id" class="form-control">
                                    <option value="english">English</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="total-questions-no" class="text-uppercase">Total Question</label>
                                <input type="text" id="total-questions-no" class="form-control" readonly>
                            </div>

                            <div class="form-group">
                                <label for="current-question-no" class="text-uppercase">Current Question No</label>
                                <input type="text" id="current-question-no" class="form-control" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="card question-details-container">
                    <div class="card-header">
                        <h4 class="card-title"> Question Details </h4>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="question-details">


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- Modal-->
    <div class="modal" id="add-subject-modal">
        <div class="modal-dialog modal-sm">
            {!! Form::open(['route' => 'admin.subjects.store', 'id' => 'add-subject-modal-form']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Subject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject-name">Subject Name</label>
                        <input id="subject-name" name="name" type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Add Subject</button>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal-->
    <div class="modal" id="add-topic-modal">
        <div class="modal-dialog modal-md">
            {!! Form::open(['route' => 'admin.subject_topics.store', 'id' => 'add-topic-form']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Topic</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject-topic">Topic</label>
                        <input id="subject-topic" name="topic" type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Add Topic</button>
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
        $(document).ready(function() {
            var question_data = {
                type: null,
                options: []
            };

            // bind to the change event on the question-entry-option
            $("#question-entry-options-subject-id").on("change", function(event) {

               var value = (event.target.value !== undefined) ? event.target.value : false;

               if (value === 'add-subject') { // if value is to add new subject, open the modal.
                   $('#add-subject-modal').modal({backdrop: 'static', keyboard: true});
                   event.target.value = 0;
                   $(this).trigger("change"); // manually trigger the change event.
               } else {
                   // clear the topic input select
                   clearTopicInputOptions();
                   // load the subject topics
                   if (event.target.value > 0) {
                       getSubjectTopics(event.target.value);
                   }
               }
            });

            // add new topic modal.
            $("#question-entry-options-topic-id").on("change", function(event) {
                var value = (event.target.value !== undefined) ? event.target.value : false;
                if (value === 'add-topic') {
                    $('#add-topic-modal').modal({backdrop: 'static', keyboard: true});
                    event.target.value = 0;
                }
            });


            // on the add subject modal.
            // on input blur check if the input contains a value
            $("#subject-name").blur(function(event) {
                var subject_name = event.target.value;
                subject_name = (subject_name !== undefined && subject_name.trim().length > 0) ? subject_name : false;
                if (subject_name) {
                    $("#subject-name").removeClass('is-invalid').addClass('is-valid');
                } else {
                    $("#subject-name").addClass('is-invalid');
                }
            });

            // add the subject modal form
            $("#add-subject-modal-form").submit(function(event) {
                event.preventDefault();

                var subject_name_input = $("#subject-name");
                var subject_name_value = subject_name_input.val();
                subject_name_value = (subject_name_value !== undefined && subject_name_value.trim().length > 0) ? subject_name_value : false;
                if (subject_name_value) {
                    $.post('{{route('admin.subjects.store')}}', {name: subject_name_value}, function(response) {
                        if (response) {
                            if (response.type === "subject") {
                                var subject_new_option = document.createElement("OPTION");
                                subject_new_option.setAttribute("value", response.data.id);
                                var subject_name = document.createTextNode(response.data.name);
                                subject_new_option.appendChild(subject_name);
                                $("option[value='add-subject']").before(subject_new_option);
                                subject_new_option.selected = true;
                                $("#question-entry-options-subject-id").trigger("change");
                                $("#subject-name").removeClass("is-valid").val("");
                                $('#add-subject-modal').modal('hide');
                            }
                        }
                    });
                } else {
                    subject_name.addClass('is-invalid');
                }
            });


            // add the subject modal form
            $("#add-topic-form").submit(function(event) {
                event.preventDefault();

                var subject_id = $("#question-entry-options-subject-id").val();
                subject_id = (subject_id !== undefined && subject_id > 0) ? parseInt(subject_id) : false;
                if (subject_id === false) {
                    toastr.error('Select Subject.');
                    return;
                }
                var subject_topic_input = $("#subject-topic");
                var subject_topic_value = subject_topic_input.val();
                subject_topic_value = (subject_topic_value !== undefined && subject_topic_value.trim().length > 0)
                    ? subject_topic_value : false;
                if (subject_topic_value) {
                    var postData = {topic: subject_topic_value, subject_id: subject_id};
                    $.post('{{route('admin.subject_topics.store')}}', postData, function(response) {
                        if (response) {
                            if (response.type === "subject_topic") {
                                var new_topic = document.createElement("OPTION");
                                new_topic.setAttribute("value", response.data.id);
                                var topic_name = document.createTextNode(response.data.topic);
                                new_topic.appendChild(topic_name);
                                $("option[value='add-topic']").before(new_topic);
                                new_topic.selected = true;

                                $("#question-entry-options-topic-id").trigger("change");
                                $("#subject-topic").removeClass("is-valid").val("");
                                $('#add-topic-modal').modal('hide');
                            }
                        }
                    });
                } else {
                    toastr.error('No Topic entered!')
                }
            });




            $("#question-entry-options-question-type-id").change(function (event) {
                if (!checkIfSubjectIdExists()) {
                    toastr.error('Select Subject.');
                    event.target.value = 0;
                    return ;
                }

                var question_type = event.target.value;
                question_type = (question_type !== undefined && question_type.length > 0) ? question_type : false;
                if (question_type) {
                    // load the template
                    $("#question-details").load(window.location.origin
                        + '/admin/questions/get-template?question_type=' + question_type
                    );
                }
            });
        });


        // clear all option values in the topic select input
        function clearTopicInputOptions() {
            var topic_options = $("#question-entry-options-topic-id option").toArray();
            topic_options.forEach(function(topic){
                topic = $(topic);
                if (topic.val() !== "0" && topic.val() !== "add-topic") {
                    topic.remove();
                }
            });
        }

        // load the subject topics via ajax
        function getSubjectTopics(subject_id) {
            $.get(window.location.origin + '/admin/subjects/' + subject_id + '/subject-topics/index', function(response){
                if (response && response.type !== undefined) {
                    if (response.data.length > 0) {
                        response.data.forEach(function(topic){
                            var new_topic = document.createElement("OPTION");
                            new_topic.setAttribute("value", topic.id);
                            var topic_name = document.createTextNode(topic.topic);
                            new_topic.appendChild(topic_name);
                            $("option[value='add-topic']").before(new_topic);
                        });
                    }
                }
            })
        }

        function checkIfSubjectIdExists() {
            var subject_id_element =  $("#question-entry-options-subject-id");
            if (subject_id_element.val() <= 0) {
                subject_id_element.focus();
                return false;
            }
            return true;
        }

    </script>
@endsection
