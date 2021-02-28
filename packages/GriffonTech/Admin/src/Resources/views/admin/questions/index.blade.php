@extends('admin::layouts.master')

@section('page_title')
    Questions
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <form action="#" class="form-inline">
                                <div class="form-group mr-2">
                                    <select name="" class="form-control">
                                        <option value="0">Select Subject</option>
                                        @if(isset($subjectLists) && !empty($subjectLists))
                                            @foreach($subjectLists as $id => $name)
                                                <option value="{{ $id }}"> {{ $name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group mr-2">
                                    <select name="" class="form-control">
                                        <option value="0">select topic </option>
                                    </select>
                                </div>

                                <div class="form-group mr-3">
                                    <select name="" class="form-control">
                                        <option value="0">select question type </option>
                                        <option value="multiple_choice">Multiple Choices</option>
                                        <option value="multiple_response">Multiple Responses</option>
                                        <option value="true_or_false">True/False</option>
                                        <option value="match_the_column">Match The Following</option>
                                        <option value="fill_the_blank">Fill in the blanks</option>
                                        <option value="essay">Essay</option>
                                    </select>
                                </div>

                                <div class="form-group mr-5">
                                    <select name="" class="form-control">
                                        <option value="en">english </option>
                                    </select>
                                </div>

                                <div class="form-group mr-4">
                                    <input type="text" class="form-control" placeholder="add a tag">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success">Apply</button>
                                </div>
                            </form>
                        </div>

                        <div class="mb-3 float-right">
                            <a class="btn btn-default" href="{{ route('admin.questions.create') }}"> <i class="fa fa-plus"></i> Add New Question </a>
                            <a class="btn btn-default" href="#"> <i class="fa fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Questions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Topic</th>
                                <th>Question Details</th>
                                <th>Difficulty Level</th>
                                <th>Type</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($questions) && !empty($questions))
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ (isset($question->subject)) ? $question->subject->name : " " }}</td>
                                        <td>{{ (isset($question->topic)) ? $question->topic->topic : " " }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ $question->difficulty_level }}</td>
                                        <td>{{ $question->type }}</td>
                                        <td>{{ $question->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a class="text-black-50 mr-3" href="{{ route('admin.questions.edit', $question->id) }}"> <i class="fa fa-pen"> </i> </a>
                                            <a class="text-danger"
                                               href="#"
                                               onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                                   document.getElementById('{{ $question->id }}').submit();
                                               } "
                                            >
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                            <form method="POST" style="display: none;" id="{{$question->id}}" action="{{ route('admin.questions.delete', $question->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Subjects!</td>
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
