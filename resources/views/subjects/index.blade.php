@extends('layout.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <a class="btn btn-primary" href="{{ route('admin.subjects.create') }}">Add New Subject</a>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Subjects</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>


                        <div class="card-tools">
                            <ul class="pagination pagination-sm">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($subjects) && !empty($subjects))
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->id }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->created_at->format('d-m-Y') }}</td>
                                        <td><span class="tag tag-success">Approved</span></td>
                                        <td> {{ substr($subject->description, 0, 50) }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('subjects.edit', $subject->id) }}">Edit</a>
                                            <a class="btn btn-info btn-sm" href="{{ route('subjects.view', $subject->id) }}">View</a>
                                            <a class="btn btn-danger btn-sm"
                                               href="{{ route('questions.edit', $subject->id) }}"
                                               onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                                   document.getElementById('{{ $subject->id }}').submit();
                                                   } "
                                            >
                                                Delete
                                            </a>
                                            <form method="POST" style="display: none;" id="{{$subject->id}}" action="{{ route('subjects.delete', $subject->id) }}">
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
