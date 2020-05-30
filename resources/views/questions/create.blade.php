@extends('layout.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Question</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" role="form" id="select_question_type_form">
                            <div class="form-group">
                                <label for="type">Question Type</label>
                                <select class="form-control" name="type" id="question_type">
                                    <option value="multiple_select_single_answer">Multiple Select Single Answer</option>
                                    <option value="multiple_select_multiple_answer">Multiple Select Multiple Answer</option>
                                    <option value="match_the_column"> Match The Column </option>
                                    <option value="short_answer">Short Answer </option>
                                    <option value="long_answer">Long Answer </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Next >> </button>
                            </div>
                        </form>



                        {{ Form::open(['route' => 'questions.store', 'id' => 'question_form', 'role' => 'form', 'style' => 'display:none']) }}

                            <input type="hidden" name="type" id="type" value="">

                            <div class="form-group">
                                <label for="type"> Subject / Category </label>
                                {!! Form::select('subject_id', $subjects, null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="question"> Question </label>
                                <textarea id="question" name="question" class="form-control" cols="30" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea id="description" name="description" class="form-control" cols="30" rows="5"></textarea>
                            </div>



                            <div id="question_options_container" style="display: none">
                                <h2> Question Options </h2>
                                <div class="mb-2">
                                    <button id="add_new_option" class="btn btn-primary"> Add New Option</button>
                                </div>



                            </div>



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
            var question_data = {
                type: null,
                options: []
            };

            $('#select_question_type_form').submit(function(event) {
                event.preventDefault();
               $(this).hide();
                var question_type = $('#question_type').val();
               $('#type').val(question_type);
               question_data.type = question_type;

               if ($.inArray(question_type, ['multiple_select_multiple_answer', 'multiple_select_single_answer', 'match_the_column']) !== -1) {
                   // show the options
                   $('#question_options_container').show();
               }
               $('#question_form').show();


               function addNewOption(event) {
                   event.preventDefault();
                   event.stopPropagation();
                   $.get(window.origin + '/question_options/create',
                       {'question_type': question_data.type,
                           'number': question_data.options.length + 1 },
                       function(data){
                           question_data.options.push({'id': question_data.options.length + 1 });
                           $('#question_options_container').append(data);
                       });
               }

               $('#add_new_option').click(addNewOption);


               $('#question_options_container').click(function (event) {
                    // capture all click event in this container.
                    //event.preventDefault();
                    if (event.target.tagName === "BUTTON") {
                        event.preventDefault();

                        if ( event.target.className.indexOf("btn-danger") !== -1) {
                            var element_id = event.target.dataset.id;
                            var element_container = $('div[data-container-id="' + event.target.dataset.id +'"]').first();

                            if (element_container !== undefined) {
                                var text_area = element_container.find("textarea").first();

                                if ( text_area.val() !== undefined && text_area.val() !== "" ) {
                                    if(confirm('Are you sure you want to remove this option?')) {
                                        element_container.remove();
                                        question_data.options = question_data.options.filter(function(element){
                                            return +element.id !== +element_id;
                                        });
                                    }
                                } else {
                                    element_container.remove();
                                    question_data.options = question_data.options.filter(function(element){
                                        return +element.id !== +element_id;
                                    });
                                }
                            }


                        }
                    }
               });

            });
        });
    </script>
@endsection
