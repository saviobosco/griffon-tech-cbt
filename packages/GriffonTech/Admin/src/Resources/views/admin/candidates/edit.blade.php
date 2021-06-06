@extends('admin::layouts.master')

@section('page_title')
    Edit Candidate >> {{ $candidate->name }}
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Candidate</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($candidate, ['route' => ['admin.candidates.update', $candidate->id], 'role' => 'form']) !!}

                        <h3>Login Detail</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group required">
                                    <label for="email_address">Email Address</label>
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <h3 class="mb-3 mt-5">Candidate Detail</h3>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group required">
                                            <label for="name">Name</label>
                                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Gender</label>
                                            <div>
                                                <label for="male">
                                                    <input type="radio" name="gender" value="male" {{ ($candidate->gender === 'male') ? 'checked=checked' : '' }}> Male
                                                </label>
                                                <label for="female">
                                                    <input type="radio" name="gender" value="female" {{ ($candidate->gender === 'female') ? 'checked=checked' : '' }}> Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Enrollment Number</label>
                                            {!! Form::text('enrolment_number', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Mobile Number</label>
                                            {!! Form::text('mobile_no', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Date of birth</label>
                                            {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">

                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                <label for="address">Address</label>
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <label for="country">Country</label>
                                {!! Form::select('country', [''=>'Please Select Country'], null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label for="state">State</label>
                                {!! Form::text('state', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label for="state">City</label>
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="state">Zipcode</label>
                                {!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_1">Extra Field 1</label>
                                {!! Form::text('extra_field_1', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_2">Extra Field 2</label>
                                {!! Form::text('extra_field_2', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_3">Extra Field 3</label>
                                {!! Form::text('extra_field_3', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_4">Extra Field 4</label>
                                {!! Form::text('extra_field_4', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_5">Extra Field 5</label>
                                {!! Form::text('extra_field_5', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_6">Extra Field 6</label>
                                {!! Form::text('extra_field_6', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                <label class="text-uppercase" for="extra_field_7">Extra Field 7</label>
                                {!! Form::text('extra_field_7', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <h3 class="mb-3">Groups Detail </h3>
                        <div class="row">
                            <div class="col-sm-7 form-group required">
                                <label for="group">Select Group</label>
                                {!! Form::select('group_id', $groups, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
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
