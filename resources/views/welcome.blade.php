<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> {{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('front-end/images/logo_200x200.png') }}"/>
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
</head>
<body>

    <header>
        <div class="l-wrap">
            <img src="{{ asset('front-end/images/logo_200x200.png') }}" alt="Griffon CBT Logo">
            <nav>
                <ul>
                    <li> <a href="#">Corporate</a> </li>
                    <li><a href="#"> Features </a> </li>
                    <li> <a href="#">Pricing</a> </li>
                    <li> <a href="#">Clients</a> </li>
                    <li><a href="#">Request demo </a></li>
                    <li><a href="{{ route('candidate.login.index') }}">Log in</a></li>
                    <li> <a href="{{ route('candidate.register.index') }}">Sign up</a> </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="main-hero">
        <div class="hero-text-container">
            <h1>Your ultimate destination for online Assessment</h1>
            <p>Prepare candidates to perform extraodinarily with an easy to use highly interactive platform and
                simplify the Assessment cycle.
            </p>

            <div class="call-for-action">
                <a class="btn btn-primary btn-special" href="#">Get Started for free </a>
            </div>
        </div>

    </div>

    <main>
        <section class="how_it_works">
            <div class="l-wrap">
                <div class="section-heading">
                    <h2> How it works</h2>
                </div>

                <div class="col-grid four-col-grid">
                    <div class="grid-item">
                        <div class="circle-product-img">
                            <div class="product_feature questions_database sprite3">
                            </div>
                        </div>
                        <h3>Create Questions</h3>
                    </div>

                    <div class="grid-item">
                        <div class="circle-product-img">
                            <div class="product_feature design_test sprite3">
                            </div>
                        </div>
                        <h3>Design Test</h3>
                    </div>

                    <div class="grid-item">
                        <div class="circle-product-img">
                            <div class="product_feature assign_test sprite3">
                            </div>
                        </div>
                        <h3>Assign Test</h3>
                    </div>

                    <div class="grid-item">
                        <div class="circle-product-img">
                            <div class="product_feature generate_result sprite3">
                            </div>
                        </div>
                        <h3>Generate Result</h3>
                    </div>
                </div>

            </div>

        </section>

        <section class="main-feature">
            <div class="l-wrap">
                <div class="section-heading">
                    <h2>A new innovation in Online examination</h2>
                    <p> Smooth registration, swift creation <br> of test and synchronised user-interface for you
                        and your candidates.
                    </p>
                </div>

                <div class="col-grid three-col-grid">

                    <div class="grid-item">
                        <div class="feature-img">
                            <img src="{{ asset('front-end/images/easylearning.svg') }}" alt="Easy Learning">
                        </div>
                        <h3>Easy to learn and Use</h3>
                        <p>
                            One-stop-destination for examination, preparation, recruitment,
                            and more. Specially designed online examination system to solve all
                            your preparation worries. The platform is smooth to use with a
                            translational flow of information.
                        </p>
                    </div>

                    <div class="grid-item">
                        <div class="feature-img">
                            <img src="{{ asset('front-end/images/highlyinteractivedesign.svg') }}" alt="Higly Interactive">
                        </div>
                        <h3>Highly Interactive Interface</h3>
                        <p>
                            A click to the next trick, simple registration, easy test and quiz
                            creation, signing- in, synchronized processing, secured encoding and
                            decoding of information and more.
                        </p>
                    </div>

                    <div class="grid-item">
                        <div class="feature-img">
                            <img src="{{ asset('front-end/images/advancedreporting.svg') }}" alt="Advanced Reporting">
                        </div>
                        <h3>Advanced Reporting System</h3>
                        <p>
                            Instant scorecard generation, computational analysis, efficient feedback
                            sharing to boost up your performance and precision. An ultimate
                            combination of detailed and drilled methodologies that will eventually
                            complement your skills and grades.
                        </p>
                    </div>

                    <div class="grid-item">
                        <div class="feature-img">
                            <img src="{{ asset('front-end/images/technicalsupport.svg') }}" alt="Technical Support">
                        </div>
                        <h3> Splendid Support </h3>
                        <p>
                            Your request and our actions to strive triggered support.
                            A dedicated team is working round the clock to provide 24 X 7
                            streamlined access to our technical experts.
                        </p>
                    </div>

                    <div class="grid-item">
                        <div class="feature-img">
                            <img src="{{ asset('front-end/images/smartsubscription.svg') }}" alt="Smart Subscriptions">
                        </div>
                        <h3>Smart Subscriptions</h3>
                        <p>
                            Premium selection to the suited subscription that will match your
                            preferences and priorities of using the online assessment platform.
                        </p>
                    </div>

                    <div class="grid-item">
                        <div class="feature-img">
                            <img src="{{ asset('front-end/images/activeaccessibility.svg') }}" alt="Active Accessibility">
                        </div>
                        <h3>Active Accessibility</h3>
                        <p>
                            Go wherever you want to and practice whenever you want, using the next
                            level online exam platform. Create & assign tests and quiz from anywhere
                            at any time. Experience a lag-free synchronized performance of think
                            exam on your mobile devices.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="l-wrap">
                <div class="section-heading">
                    <h2> A few of the clients who trust on us</h2>
                </div>

                <div>
                    <p> Client logo images </p>
                </div>
            </div>

        </section>

    </main>

    <footer>
        <div class="l-wrap">
            <div>
                <img src="{{ asset('front-end/images/logo_200x200.png') }}" alt="Griffon CBT Logo">

            </div>
            <div class="col-grid five-col-grid">

                <div class="grid-item">
                    <ul class="higher-links">
                        <li> <a href="">About Us</a> </li>
                        <li> <a href="">Advisors</a> </li>
                        <li> <a href="">what's new</a> </li>
                        <li> <a href="">Clients</a> </li>
                        <li> <a href="">Testimonials</a> </li>
                        <li> <a href="">Contact Us</a> </li>
                        <li> Follow Us
                            <div>

                            </div>
                        </li>
                    </ul>
                </div>

                <div class="grid-item">
                    <ul class="footer-links">
                        <li> Platforms </li>
                        <li> <a href="">Online Test Platform</a> </li>
                        <li> <a href="">Coding / Hacking champ</a> </li>
                        <li> <a href="">Skill Assessment Platform </a></li>
                        <li> <a href="{{ route('admin.login.index') }}"> Admin Login </a></li>
                    </ul>
                </div>

                <div class="grid-item">
                    <ul class="footer-links">
                        <li>Products</li>
                        <li><a href="">Test library</a></li>
                        <li><a href="">Psychometric Tests</a></li>
                        <li><a href="">Aptitude Tests</a></li>
                        <li><a href="">National Talent Assessment</a></li>
                        <li><a href="">Recruitment Assessment</a></li>
                    </ul>
                </div>

                <div class="grid-item">
                    <ul class="footer-links">
                        <li>Business</li>
                        <li><a href="">Communication</a></li>
                        <li><a href="">Performance Management</a></li>
                        <li><a href="">Recruitment</a></li>
                        <li><a href="">Talent Management</a></li>
                        <li><a href="">Partner</a></li>
                    </ul>
                </div>

                <div class="grid-item">
                    <ul class="footer-links">
                        <li>Industry</li>
                        <li><a href="">Education</a></li>
                        <li><a href="">Corporate</a></li>
                        <li><a href="">Government</a></li>
                    </ul>

                    <ul class="footer-links m-t-30">
                        <li>Resources</li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">Help & Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="copyright-container">
        <div class="l-wrap">
            <p>
                <a href="">Terms of use</a> |
                <a href="">Privacy Policy</a>
            </p>
            <small> &copy; 2020 Griffon Technologies Nig, All rights reserved | <strong> Powered by <a href="#">prepexams.com</a> </strong> </small>
        </div>
    </div>


{{--<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            {{ config('app.name') }}
        </div>

        <div class="links">
            <a href="https://laravel.com/docs">Docs</a>
            <a href="{{ route('admin.login.index') }}">Admin Login</a>
            <a href="#">News</a>
            <a href="#">Blog</a>
            <a href="{{ route('user.quizzes.index') }}"> Free Quizzes </a>
        </div>
    </div>
</div>--}}
</body>
</html>
