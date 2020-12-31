@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Quiz</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th> Question </th>
                                <td> {{ $quiz->name }} </td>
                            </tr>
                            <tr>
                                <th> Description</th>
                                <td> {!! $quiz->description !!} </td>
                            </tr>
                            <tr>
                                <th> Start Date </th>
                                <td> {{ $quiz->start_date->format('l jS \\of F, Y') }} </td>
                            </tr>
                            <tr>
                                <th> End Date </th>
                                <td> {{ ($quiz->end_date) ? $quiz->end_date->format('l jS \\of F, Y') : '' }} </td>
                            </tr>
                            <tr>
                                <th> Duration </th>
                                <td> {{ $quiz->duration }} mins </td>
                            </tr>

                            <tr>
                                <th> Total Time Taken </th>
                                <td> 1 </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Questions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Number</td>
                                    <td>Question</td>
                                    <td> Subject </td>
                                    <td>Type</td>
                                    <td> Score </td>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($questions) && !$questions->isEmpty())
                                <?php $number = 1; ?>
                                @foreach($questions as $question)
                                    <tr>
                                        <td> {{ $number }}</td>
                                        <td>{{ $question->question->question }} </td>
                                        <td> {{ ($question->question->subject) ? $question->question->subject->name : '' }} </td>
                                        <td> {{ $question->question->type }} </td>
                                        <td> {{ $question->score }} </td>
                                    </tr>
                                    <?php $number++; ?>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


@endsection
