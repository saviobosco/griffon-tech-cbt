@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Subject</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.subjects.store', 'role' => 'form']) !!}

                            <div class="form-group">
                                <label for="name"> Name </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Subject Name">
                            </div>

                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
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
