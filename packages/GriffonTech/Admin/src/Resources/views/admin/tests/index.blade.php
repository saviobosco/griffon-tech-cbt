@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <form action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Test Name">
                            </div>
                            <div class="form-group ml-4">
                                <button class="btn btn-primary"> Search </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">
                        <div class="mb-3 float-right">
                            <a class="btn btn-default btn-sm" href="{{ route('admin.tests.create') }}"> <i class="fa fa-plus"></i> Add Test</a>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tests</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Test Name</th>
                                    <th>Total Questions</th>
                                    <th>Difficulty Level</th>
                                    <th>Associated Product</th>
                                    <th>Test Category</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @if ($tests->isNotEmpty())

                                @foreach($tests as $test)
                                    <tr class="text-center">
                                        <td>{{ $test->id }}</td>
                                        <td>{{ $test->name }}</td>
                                        <td>{{ $test->total_question }}</td>
                                        <td>{{ $test->difficulty_level }}</td>
                                        <td>-</td>
                                        <td>{{ $test->test_category->name }} </td>
                                        <td>
                                            {{ ($test->is_published) ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tests.edit', ['test' => $test->id]) }}"> Edit Test </a> |
                                            <a href="{{ route('admin.tests.edit', ['test' => $test->id, '#publish-test']) }}"> Publish Test </a> |
                                            <a href="#"> Delete Test </a> |
                                            <a href="#"> Export Test </a> |
                                            <a href="{{ route('admin.tests.edit', ['test' => $test->id, '#assign-test']) }}"> Assign Test</a> |
                                            <a href="#"> Notifications </a> |
                                            <a href=""> Duplicate Test</a> |
                                            <a class="text-danger" href="#"
                                               onclick="event.preventDefault();
                                               if (confirm('Are you sure ?')) {
                                                   document.getElementById('delete-form-{{$test->id}}').submit();
                                               }
                                                ">Delete Test</a>
                                            <form id="delete-form-{{$test->id}}" method="POST" action="{{ route('admin.tests.delete', $test->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach

                            @else
                                <tr class="text-center">
                                    <td colspan="7"> No Tests!</td>
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
