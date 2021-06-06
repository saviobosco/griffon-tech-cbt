@extends('candidate::layouts.master')

@section('page_title')
    Candidate Dashboard
@stop


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Tests</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-3">
                            <form class="form-inline" action="">
                                <div class="form-group">
                                    <select name="" id="" class="form-control">
                                        <option value="">Active</option>
                                        <option value="">Upcoming</option>
                                        <option value="">Missed</option>
                                        <option value="">Completed</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                        <div class="row">
                            @if ($tests->isNotEmpty())
                                @foreach($tests as $test)

                                    <div class="col-sm-4">
                                        <div class="card" style="border-radius: 3px; border: 1px solid rgba(0, 0, 0, 0.125); box-shadow: none;">
                                            <div class="card-body">
                                                <h4> {{ $test->name }} </h4>
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

                                                @if ($test->end_date)
                                                    @if ($test->end_date->timestamp > now()->timestamp )
                                                        <div>
                                                            <a class="btn btn-primary float-right" href="{{ route('candidate.tests.view', $test->id) }}">Start Test</a>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <a class="btn btn-default disabled float-right" title="This test is not available" href="javascript:;">Inactive Test</a>
                                                        </div>
                                                    @endif

                                                @else
                                                    <div>
                                                        <a class="btn btn-primary float-right" href="{{ route('candidate.tests.view', $test->id) }}">Start Test</a>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

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
