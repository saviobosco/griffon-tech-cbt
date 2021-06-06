@extends('candidate::layouts.master')

@section('page_title')
    {{ $test->name }}
@stop


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $test->name }}</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <p>
                            <i class="fa fa-calendar-alt"></i> Start Date: {{ $test->start_date->format('d-m-Y') }}
                        </p>
                        <p>
                            <i class="fa fa-calendar-alt"></i> End Date: {{ $test->end_date->format('d-m-Y') }}
                        </p>
                        <p>
                            <i class="fa fa-clock"></i> Time: {{ $test->start_time }} to {{ $test->end_time }}
                        </p>
                        <p>
                            <i class="fa fa-clock"></i> Duration: {{ $test->duration }} Minutes
                        </p>
                        <p>
                            <strong>No of Questions</strong>: {{ $test->total_question }}
                        </p>
                        <p>
                            <strong>Total Score</strong>: {{ $test->total_mark }}
                        </p>
                        <p>
                            <strong>Difficulty Level</strong>: {{ ucfirst($test->difficulty_level) }}
                        </p>

                        <div>
                            <h3 class="text-center"> Test Instruction</h3>
                            <div style="overflow: auto;
                            max-height: 20rem;
                             margin-bottom: 2rem;
                              background-color: #f4f6f9;
                               padding: 1rem;
                                border: 1px solid rgba(0, 0, 0, 0.125);">
                                @if ($test->test_instruction)
                                    {!! $test->test_instruction->instruction !!}
                                @else
                                    <p class="text-center">No Instruction!</p>
                                @endif
                            </div>
                        </div>

                        {!! Form::open(['route'=> ['candidate.tests.start', $test->id]]) !!}
                            <div>
                                <label for="instruction_agreement">
                                    <input type="checkbox" name="instruction_agreement" value="1" id="instruction_agreement" required>
                                    I have read all instructions properly.
                                </label>
                            </div>
                            <div>
                                {!! Form::submit('Start Test', ['class' => 'float-right btn btn-success']) !!}
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
