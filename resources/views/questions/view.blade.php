@extends('layout.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Question</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th> Question </th>
                                <td> {!! $question->question !!} </td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{ $question->type }}</td>
                            </tr>
                            <tr>
                                <th> Description</th>
                                <td> {!! $question->description !!} </td>
                            </tr>
                            <tr>
                                <th> Total Times Shown</th>
                                <td> 1 </td>
                            </tr>
                            <tr>
                                <th>Total Times Answered</th>
                                <td> 1</td>
                            </tr>
                            <tr>
                                <th>Total Times Answered Correctly</th>
                                <td> 1</td>
                            </tr>
                            <tr>
                                <th>Total Times Answered Failed</th>
                                <td> 1</td>
                            </tr>
                        </table>

                        @if(in_array($question->type, ['multiple_select_single_answer', 'multiple_select_multiple_answer', 'match_the_column']))
                            <div class="mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th> Option</th>
                                        @if ($question->type === 'match_the_column')
                                            <th> Option Match</th>
                                        @endif
                                        <th> Is Correct</th>
                                        <th> Score </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($question->options as $option)
                                        <tr>
                                            <td>{!! $option->option !!}</td>
                                            @if ($question->type === 'match_the_column')
                                                <td> {!! $option->option_match !!}</td>
                                            @endif
                                            <td> {{ ($option->is_correct) ? 'Yes' : 'No' }}</td>
                                            <td> {{ $option->score }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


@endsection
