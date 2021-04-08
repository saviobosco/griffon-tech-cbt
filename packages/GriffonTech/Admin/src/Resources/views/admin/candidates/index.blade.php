@extends('admin::layouts.master')

@section('page_title')
    Candidates
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <form action="" class="form-inline">
                            <div class="form-group mr-4">
                                <select name="" id="" class="form-control">
                                    <option value="">Select Filter</option>
                                    <option value="">Candidate Name</option>
                                    <option value="">E-mail</option>
                                    <option value="">Reg-Date</option>
                                    <option value="">Status</option>
                                    <option value="">Mobile No.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group ml-4">
                                <button class="btn btn-primary"> Search </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-3">
                        <div class="mb-3 float-right">
                            <a class="btn btn-default mr-3" href="{{ route('admin.candidates.create') }}"> Add <i class="fa fa-plus"></i> </a>
                            <a class="btn btn-default" href="javascript:;"> Export <i class="fa fa-upload"></i> </a>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Candidates</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Candidate Name</th>
                                <th>E-mail</th>
                                <th>Mobile No.</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th>Reg Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($groups) && $groups->isNotEmpty())
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->created_at }}</td>
                                        <td>{{ $group->updated_at }}</td>
                                        <td>
                                            <a class="text-gray-dark" href="{{ route('admin.candidate_groups.edit', $group->id) }}">
                                                <i class="fa fa-pen"></i> </a>
                                            <a class="text-danger ml-3"
                                               href="#"
                                               onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                                   document.getElementById('{{ $group->id }}').submit();
                                                   }"
                                            >
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                            <form method="POST" style="display: none;" id="{{$group->id}}" action="{{ route('admin.candidate_groups.delete', $group->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">No Candidates!</td>
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
