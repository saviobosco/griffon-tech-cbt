@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Topic</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.subject_topics.store', 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="subject_id">Subject</label>
                            <select name="subject_id" id="subject_id" class="form-control">
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="topic"> Topic </label>
                            <input type="text" class="form-control" name="topic" id="topic" placeholder="Enter Topic">
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
