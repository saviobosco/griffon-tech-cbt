@extends('candidate::layouts.auth')

@section('page_title')
    Candidate Log In
@stop

@section('content')
    <div class="registration-holder">
        <div class="registration-form-holder">

            <div>
                <h1>Welcome Back! </h1>
                <p>Log in to resume access to our computer based test platform </p>
            </div>
            <form action="{{ route('candidate.login.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="full_name">Email Address </label>
                    <input type="text" class="form-control" name="email" placeholder="Email Address">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="remember">
                        <input id="remember" type="checkbox" name="remember_me" value="1"> Remember Me
                    </label>
                </div>

                <div>
                    <p> <a href="forget_password.html">Forgot Password ?</a></p>
                </div>

                <div class="form-group m-t-30">
                    <button class="btn btn-primary"> Login </button>
                </div>
            </form>
        </div>
        <div class="registration-sidebar">
            <div>
                <h2> Don’t have an account yet? </h2>
                <p> Get unlimited access to our computer based platform </p>
                <a class="btn btn-primary btn-wide" href="{{ route('candidate.register.index') }}"> Sign Up </a>
            </div>
        </div>
    </div>
@endsection
