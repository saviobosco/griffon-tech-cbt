@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <form action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Category">
                            </div>
                            <div class="form-group ml-4">
                                <button class="btn btn-primary"> Search </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">
                        <div class="mb-3 float-right">
                            <a class="btn btn-default btn-sm" href="{{ route('admin.test_categories.create') }}"> <i class="fa fa-plus"></i> Add Category</a>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Test Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($testCategories) && !empty($testCategories))
                                @foreach($testCategories as $testCategory)
                                    <tr>
                                        <td>{{ $testCategory->id }}</td>
                                        <td>{{ $testCategory->name }}</td>
                                        <td>
                                            <a class="text-gray-dark" href="{{ route('admin.test_categories.edit', $testCategory->id) }}"> <i class="fa fa-pen"></i> </a>
                                            <a class="text-danger ml-3"
                                               href="#"
                                               onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                                   document.getElementById('{{ $testCategory->id }}').submit();
                                                   }"
                                            >
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                            <form method="POST" style="display: none;" id="{{$testCategory->id}}" action="{{ route('admin.test_categories.delete', $testCategory->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Test Categories!</td>
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
