@extends('admin::layouts.master')

@section('page_title')
    Admins
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
                                    <option value="">Name</option>
                                    <option value="">E-mail</option>
                                    <option value="">Status</option>
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
                            <a class="btn btn-default mr-3" href="{{ route('admin.admins.create') }}"> Add <i class="fa fa-plus"></i> </a>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Users </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone Number</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($admins) && $admins->isNotEmpty())
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone_number }}</td>
                                        <td>{{ $admin->created_at->format('d-m-Y h:i A') }}</td>
                                        <td> <span class="text-success">Active  <i class="fa fa-circle"></i> </span> </td>
                                        <td>
                                            <a class="text-gray-dark" href="{{ route('admin.admins.edit', $admin->id) }}">
                                                <i class="fa fa-pen"></i> </a>
                                            <a class="text-danger ml-3"
                                               href="#"
                                               onclick="event.preventDefault(); if (confirm('Are you sure?')) {
                                                   document.getElementById('{{ $admin->id }}').submit();
                                                   }"
                                            >
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                            <form method="POST" style="display: none;" id="{{$admin->id}}" action="{{ route('admin.admins.delete', $admin->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">No Users!</td>
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
