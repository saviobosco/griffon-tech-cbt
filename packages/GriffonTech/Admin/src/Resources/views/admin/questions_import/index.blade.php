@extends('admin::layouts.master')

@section('page_title')
    Import Questions
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Import Questions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="height: 100%;">

                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::open(['route' => 'admin.questions_import.import', 'enctype' => 'multipart/form-data']) !!}

                                <div class="form-group">
                                    <label for="file_type">File</label>
                                    <input type="file" name="import_file" required>
                                </div>

                                <div class="form-group">
                                    <label for="file_type">File Type</label>
                                    <select name="file_type" id="file_type" class="form-control">
                                        <option value="json">JSON</option>
                                        <option value="json">Excel(.xlsx)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question-entry-options-subject-id" class="text-uppercase">
                                        *Select Subject
                                    </label>
                                    <select name="subject_id" id="question-entry-options-subject-id" class="form-control">
                                        <option value="0">Select Subject</option>
                                    @if(isset($subjects))
                                            @foreach($subjects as $id => $name)
                                                <option value="{{ $id }}"> {{ $name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question-entry-options-topic-id" class="text-uppercase">
                                        *Select Topic
                                    </label>
                                    <select
                                        name="topic_id"
                                        id="question-entry-options-topic-id"
                                        class="form-control">
                                        <option value="0">Select Topic</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question_type">Question Type</label>
                                    <select name="question_type" class="form-control" id="question_type">
                                        <option value="multiple_choice">Multiple Choices</option>
                                        <option value="multiple_response">Multiple Responses</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question_type">Difficulty Level</label>
                                    <select name="difficulty_level" class="form-control" id="difficulty_level">
                                        <option value="normal" selected="selected">Normal</option>
                                        <option value="easy">Easy</option>
                                        <option value="difficult">Difficult</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>


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
        $("#question-entry-options-subject-id").on("change", function(event) {

            var value = (event.target.value !== undefined) ? event.target.value : false;
            // clear the topic input select
            clearTopicInputOptions();
            // load the subject topics
            if (event.target.value > 0) {
                getSubjectTopics(event.target.value);
            }
        });

        // clear all option values in the topic select input
        function clearTopicInputOptions() {
            var topic_options = $("#question-entry-options-topic-id option").toArray();
            topic_options.forEach(function(topic){
                topic = $(topic);
                topic.remove();
            });
        }

        // load the subject topics via ajax
        function getSubjectTopics(subject_id) {
            $.get(window.location.origin + '/admin/subjects/' + subject_id + '/topics/index', function(response, statusCode, xhr){
                if (xhr.status === 200 && response.type !== undefined) {
                    if (response.data.length > 0) {
                        response.data.forEach(function(topic){
                            var new_topic = document.createElement("OPTION");
                            new_topic.setAttribute("value", topic.id);
                            var topic_name = document.createTextNode(topic.topic);
                            new_topic.appendChild(topic_name);
                            $("#question-entry-options-topic-id").append(new_topic);
                        });
                    }
                }
            }).fail(function (jqXHR){
                toastr.error('Response code:' + jqXHR.status);
            });
        }
    </script>

@endsection
