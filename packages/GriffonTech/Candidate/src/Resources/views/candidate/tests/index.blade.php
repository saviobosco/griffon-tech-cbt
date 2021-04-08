@extends('candidate::layouts.master')

@section('page_title')
    My Tests
@stop


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Tests</h3>
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
                            <div class="col-sm-4">
                                <div class="card" style="border-radius: 3px; border: 1px solid rgba(0, 0, 0, 0.125); box-shadow: none;">
                                    <div class="card-body">
                                        <h4> Jamb Sample Test 1 </h4>
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
                                        <div>
                                            <a class="btn btn-default disabled float-right" href="">Inactive Test</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card" style="border-radius: 3px; border: 1px solid rgba(0, 0, 0, 0.125); box-shadow: none;">
                                    <div class="card-body">
                                        <h4> Jamb Sample Test 2</h4>
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
                                        <div>
                                            <a class="btn btn-primary float-right" href="{{ route('candidate.tests.view', 1) }}">Start Test</a>
                                        </div>
                                    </div>
                                </div>
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
