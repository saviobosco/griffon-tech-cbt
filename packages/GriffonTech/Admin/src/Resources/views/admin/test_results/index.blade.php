@extends('admin::layouts.master')

@section('page_title')
    Test Results
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <form action="" class="form-inline">
                            <div class="form-group mr-4">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Filter</option>
                                    <option value="">Candidate Name</option>
                                    <option value="">E-mail</option>
                                    <option value="">Reg-Date</option>
                                    <option value="">Status</option>
                                    <option value="">Mobile No.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group ml-4">
                                <button class="btn btn-primary"> Search </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-3">
                        <div class="mb-3 float-right">
                            <a class="btn btn-default" href="javascript:;"> Export <i class="fa fa-upload"></i> </a>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Test Results</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Candidate Name</th>
                                <th>Test Name</th>
                                <th>Subjects</th>
                                <th>Date Taken</th>
                                <th>Time Spent</th>
                                <th>Start Time</th>
                                <th>Score</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($testSessions) && $testSessions->isNotEmpty())
                                @foreach($testSessions as $testSession)
                                    <tr>
                                        <td>{{ $testSession->id }}</td>
                                        <td>{{ ($testSession->candidate) ? $testSession->candidate->name : "" }}</td>
                                        <td>{{ ($testSession->test) ? $testSession->test->name : ""}}</td>
                                        <td></td>
                                        <td>{{ $testSession->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $testSession->total_time }}</td>
                                        <td>{{ $testSession->start_time->format('H:i A') }}</td>
                                        <td>{{ $testSession->total_score }}</td>
                                        <td>{{ $testSession->status }} </td>
                                        <td>
                                            <a class="text-gray-dark" href="{{ route('admin.test_results.view', $testSession->id) }}"> View result
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">No Test Results!</td>
                                </tr>

                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
