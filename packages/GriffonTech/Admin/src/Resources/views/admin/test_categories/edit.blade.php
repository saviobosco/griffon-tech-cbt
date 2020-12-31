@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Test Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($testCategory, ['route' => ['admin.test_categories.update', $testCategory], 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="name"> Name </label>
                            {!! Form::text('name', null, ['id' => 'name','class' => 'form-control', 'placeholder' => 'Enter Category Name']) !!}
                        </div>

                        <div class="form-group">
                            <label for="description"> Description </label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 10]) !!}
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
