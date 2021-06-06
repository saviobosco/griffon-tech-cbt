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
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/60a78ac2b1d5182476bb2265/1f677c39u';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
