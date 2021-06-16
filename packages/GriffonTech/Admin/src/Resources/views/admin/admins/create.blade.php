@extends('admin::layouts.master')

@section('page_title')
    Add New User
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.admins.store', 'role' => 'form', 'autocomplete' => 'off']) !!}

                        <div class="col-sm-8">
                            <h3>Login Detail</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group required">
                                        <label for="email_address">Email Address</label>
                                        {!! Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group required">
                                        <label for="email_address">Password</label>
                                        {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h3 class="mb-3 mt-5">User Detail</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group required">
                                            <label for="name">Name</label>
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Phone Number</label>
                                            {!! Form::text('mobile_number', null, ['class' => 'form-control']) !!}
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-4">

                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add user</button>
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
