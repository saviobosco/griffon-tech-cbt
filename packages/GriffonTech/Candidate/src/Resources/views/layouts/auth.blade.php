<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield('page_title') </title>
    <link href="{{ asset('front-end/css/style.css') }}" rel="stylesheet">
</head>

<body>
<!--<header>
    <div class="l-wrap">
        <img src="{{ asset('front-end/images/logo_200x200.png') }}" alt="{{ config('app.name') }}">
    </div>
</header>-->
<main>
    <div class="l-wrap registration-container">
        <div style="width: 80%; margin: 0 auto;">

            @if(Session::has('success'))
                <div class="alert alert-success mt-2" role="alert">
                    <i class="fa fa-check-circle"></i>
                    <strong>Success:</strong>
                    {{ Session::get('success') }}
                </div>
            @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger mt-2" role="alert">
                        <i class="fa fa-warning"></i>
                        <strong>Error - </strong>
                        {{ Session::get('error') }}
                    </div>
                @endif

            @yield('content')
        </div>
    </div>
</main>

</body>
</html>
