@extends('candidate::layouts.master')

@section('page_title')
    Jamb Sample 1
@stop


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jamb Sample 1</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <p>
                            <i class="fa fa-calendar-alt"></i> Start Date: 21/03/2021
                        </p>
                        <p>
                            <i class="fa fa-calendar-alt"></i> End Date: 22-03-2021
                        </p>
                        <p>
                            <i class="fa fa-clock"></i> Time: 21:00:00 to 22:00:00
                        </p>
                        <p>
                            <i class="fa fa-clock"></i> Duration: 20 Minutes
                        </p>
                        <p>
                            <strong>No of Questions</strong>: 10
                        </p>
                        <p>
                            <strong>Total Score</strong>: 80
                        </p>
                        <p>
                            <strong>Difficulty Level</strong>: Normal
                        </p>

                        <div>
                            <h3 class="text-center"> Test Instruction</h3>
                            <div style="overflow: auto;
                            max-height: 15rem;
                             margin-bottom: 2rem;
                              background-color: #f4f6f9;
                               padding: 1rem;
                                border: 1px solid rgba(0, 0, 0, 0.125);">
                                <p>This test contains the details to the next level</p>
                                <p>
                                    This are the instructions.
                                </p>
                                <ol>
                                    <li> Hello world</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                    <li> Yes oo</li>
                                </ol>
                            </div>
                        </div>

                        {!! Form::open() !!}
                            <div>
                                <label for="instruction_agreement">
                                    <input type="checkbox" name="instruction_agreement" value="1" id="instruction_agreement" required>
                                    I have read all instructions properly.
                                </label>
                            </div>
                            <div>
                                {!! Form::button('Start Test', ['class' => 'float-right btn btn-success']) !!}
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
