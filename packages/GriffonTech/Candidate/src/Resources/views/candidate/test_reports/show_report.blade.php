@extends('candidate::layouts.master')

@section('page_title')
    Test Report - 101
@stop


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Test Report - 101 (Jamb Sample 1)</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3>101 - Jamb Sample 1</h3>
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
                                    <i class="fa fa-clock"></i> Date Taken: 20-03-2020
                                </p>
                                <p>
                                    <i class="fa fa-clock"></i> Time Started: 20-03-2020 09:45:00
                                </p>
                                <p>
                                    <i class="fa fa-clock"></i> Time Ended 20-03-2020 10:45:00
                                </p>

                                <p>
                                    <strong>Score</strong> : 85
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <p>
                                    A graph chart will be placed here.
                                </p>

                                <p><span class="text-success">Passed</span> : 40%</p>
                                <p><span class="text-danger">Failed</span> : 60%</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Questions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Score</th>
                                <th>Correct Answer</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>What is the meaning of HTML</td>
                                <td>Hyper text markup language</td>
                                <td>2</td>
                                <td>Hyper text markup language</td>
                                <td>
                                    <a href="">view detail</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


@endsection
