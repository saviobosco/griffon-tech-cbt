@extends('candidate::layouts.auth')

@section('page_title')
    Create Candidate Account
@stop

@section('content')
    <div class="registration-holder">
        <div class="registration-form-holder">
            <div>
                <h1>Sign up to get started </h1>
                <p> Get unlimited access to our computer based test platform </p>
            </div>

            <form action="{{ route('candidate.register.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Full Name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <div>
                        <label for="male">
                            <input type="radio" id="male" name="gender" value="male"> Male
                        </label>

                        <label>
                            <input type="radio" id="female" name="gender" value="female"> Female
                        </label>
                    </div>
                    @if ($errors->has('gender'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group m-t-30">
                    <button class="btn btn-primary"> Create Account </button>
                </div>
            </form>
        </div>
        <div class="registration-sidebar">
            <div>
                <a href="/">
                    <img src="{{ asset('/front-end/images/logo_200x200.png') }}" alt="{{ config('app.name') }} Logo">
                </a>
                <h2> Already have an Account ?</h2>
                <p>Welcome back! Sign in with your credentials </p>
                <a class="btn btn-primary btn-wide" href="{{ route('candidate.login.index') }}"> Login </a>
            </div>
        </div>
    </div>
@endsection
