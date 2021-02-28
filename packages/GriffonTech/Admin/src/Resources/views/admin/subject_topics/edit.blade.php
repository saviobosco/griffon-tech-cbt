@extends('admin::layouts.master')

@section('page_title')
    Edit Topic: {{ $topic->topic }}
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Topic</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($topic, ['route' => [ 'admin.subject_topics.update', $topic->id], 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="subject_id">Subject</label>
                            <select name="subject_id" id="subject_id" class="form-control" disabled>
                                <option value="{{ $topic->subject->id }}">{{ $topic->subject->name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="topic"> Topic </label>
                            {!! Form::text('topic', null, ['class'=> 'form-control', 'id' => 'topic']) !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update topic</button>
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
