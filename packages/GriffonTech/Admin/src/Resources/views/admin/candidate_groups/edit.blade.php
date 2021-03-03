@extends('admin::layouts.master')

@section('page_title')
    Edit Candidate Group : {{ $group->name }}
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Candidate Group</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($group, ['route' => ['admin.candidate_groups.update', $group->id], 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="name"> Name </label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter candidate group name']) !!}
                        </div>

                        <div class="form-group">
                            <label for="description"> Description </label>
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'cols' => 30, 'rows' => 5]) !!}
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
