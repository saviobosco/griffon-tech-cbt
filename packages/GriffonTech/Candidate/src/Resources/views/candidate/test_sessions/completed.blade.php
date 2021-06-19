@extends('candidate::layouts.master')

@section('page_title')
    My Tests
@stop


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="jumbotron">
                    <h2 class="text-center text-success">
                        You test was successfully submitted!
                    </h2>
                    <a class="btn btn-default" href="{{ route('candidate.dashboard.index') }}">Return to dashboard</a>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


@endsection
