@extends('layout.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Quiz</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'quizzes.store', 'role' => 'form']) !!}

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
                            {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
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
                            <select id="view_answer" name="view_answer" class="form-control">
                                <option value="1"> Yes </option>
                                <option selected value="0" > No </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="require_camera"> Require Camera </label>
                            <select id="require_camera" name="require_camera" class="form-control">
                                <option value="1"> Yes </option>
                                <option selected value="0" > No </option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="question_selection"> Question Selection </label>
                            <select id="question_selection" name="question_selection" class="form-control">
                                <option value="1"> Yes </option>
                                <option selected value="0" > No </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="requires_login"> Requires Login </label>
                            <select id="requires_login" name="requires_login" class="form-control">
                                <option value="1" selected> Yes </option>
                                <option value="0" > No </option>
                            </select>
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
