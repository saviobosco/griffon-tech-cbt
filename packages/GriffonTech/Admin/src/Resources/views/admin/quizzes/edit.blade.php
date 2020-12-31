@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Quiz</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model( $quiz, ['route' =>['quizzes.update', $quiz->id], 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="name"> Name </label>
                            {!! FOrm::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Quiz Name']) !!}
                        </div>

                        <div class="form-group">
                            <label for="description"> Description </label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 4]) !!}
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            {!! Form::text('start_date', null, [
                                'class' => 'form-control quiz_date']) !!}
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            {!! Form::text('end_date', null, ['class' => 'form-control quiz_date']) !!}
                        </div>

                        <div class="form-group">
                            <label for="end_date">Duration (minutes)</label>
                            {!! Form::text('duration', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="ip_addresses">IP Addresses</label>
                            {!! Form::text('ip_addresses', '*', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="end_date">Pass Percentage</label>
                            {!! Form::text('pass_percentage', 50, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="end_date">Maximum Attempts</label>
                            {!! Form::text('maximum_attempts', 1, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="view_answer"> View Answer</label>
                            {!! Form::select('view_answer', ['1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="require_camera"> Require Camera </label>
                            {!! Form::select('require_camera', ['1' => 'Yes', '0' => 'No'], null, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group">
                            <label for="question_selection"> Question Selection </label>
                            {!! Form::select('question_selection', ['1' => 'Yes', '0' => 'No'], '0', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="requires_login"> Requires Login </label>
                            {!! Form::select('requires_login', ['1' => 'Yes', '0' => 'No'], '1', ['class' => 'form-control']) !!}

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
        // date time picker
        /*var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){ dd='0'+dd }
        if(mm<10){ mm='0'+mm }
        var today = dd+'/'+mm+'/'+yyyy;
        var today = mm+'/'+dd+'/'+yyyy;*/

        $('.quiz_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                'format': 'DD-MM-YYYY'
            },
            minYear: parseInt(moment().format('YYYY'), 10),
            maxYear: parseInt(moment().format('YYYY'),10) + 5
        });
    </script>

@stop
