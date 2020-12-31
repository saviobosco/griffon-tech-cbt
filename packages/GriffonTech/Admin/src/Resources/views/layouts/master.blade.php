<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ config('app.name') }} | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{{--
    <link rel="stylesheet" href="{{ asset('assets/plugins/ion-icons/2.0.1/css/ionicons.min.css') }}">
--}}
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <style>
        .card {
            border-radius: 0;
        }
        div.form-group label {
            font-weight: 500 !important;
        }
        .form-control {
            border-radius: 0;
        }
        .question-entry-options label ,
        .question-entry-options .form-control {
            font-size: .95em;
        }
        .question-entry-options label {
            margin-bottom: 0;
        }
        #add-subject-modal .modal-title {
            font-size: 1.2rem;
        }
        .question-details-container {
            min-height: 60vh;
        }
        .question-option-container {
            width: 60%;
        }
        .question-option-container p {
            background-color: #343a40;
            text-align: center;
            padding: 2px;
            color: #fff;
            margin-bottom: 0;
            font-weight: 700;
            font-size: 0.8em;
        }
        .question-option-container  div {
            border: 1px solid #cad1d7;
        }
        .question-option-container div label {
            margin-bottom: 0;
        }
        .question-option-container div input {
            margin-top: 5px;
            margin-bottom: 0;
        }
        .dashboard-view .small-box {
            border-radius: 0;
        }
        .dashboard-view .small-box-footer {
            background-color: #4caf50;
            color: #ffffff !important;
            padding-top: 8px;
            padding-bottom: 8px;
            text-transform: uppercase;
        }
        .dashboard-view .small-box-footer:hover {
            background-color: #28a52c;
        }
        .tooltip-inner {
            background-color: rgba( 0, 0, 0, 0.8);
            font-size: .9em;
            padding: 4px;
        }
        .required > label::before {
            content: " * ";
            color: red;
        }

        .form-step-list {
            padding: 0;
            list-style: none;
            width: 100%;
        }

        .form-step-list .step {
            display: inline-block;
            border-right: 1px solid rgba(0, 0, 0, 0.125);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            background-color: rgba(0, 0, 0, 0.03);
            margin-right: -4px;
            padding: 10px 5px 10px 15px;
            width: 16.66%;
            cursor: pointer;
            color: rgba(0, 0, 0, 0.5);
        }

        .form-step-list .step p {
            margin-bottom: 0;
        }
        .form-step-list .step p.step-heading {
            font-size: 1.1em;
            font-weight: 600;
        }
        .form-step-list .step p.step-desc {
            font-size: 0.9em;
            font-weight: 600;
        }


        .form-step-list .step:last-child {
            border-right: none;
        }
        .form-step-list .step.active {
            background-color: #ffffff;
            border-bottom: none;
            color: #212529;
        }
        .form-tabs {
            padding: 1.25rem;
        }

        /* btn */
        .btn {
            border-radius: 0;
        }

        /*.form-step-tab {
            display: none;
        }*/
        .gray-background {
            background-color: rgba(0, 0, 0, 0.03);
        }
        fieldset.normal-fieldset {
            border: 1px solid rgba(0, 0, 0, 0.3);
            min-height: 300px;
            font-size: 13px;
        }

        fieldset.normal-fieldset legend {
            margin-left: 20px;
            display: inline;
            width: auto;
            font-size: 13px;
            color: rgba(0, 0, 0, 0.8);
            text-transform: uppercase;
            font-weight: 600;
            vertical-align: center;
            margin-bottom: 0;
        }
        .input-group-text {
            border-radius: 0;
        }

        .assign-test-links .card {
            box-shadow: none;
        }
        .assign-test-links .card-body {
            border: 1px solid #007bff;
        }
        .assign-test-links .card-title {
            font-size: 1.1em;
            font-weight: 600;
        }
        .assign-test-links .card-header {
            padding: 10px 10px;
            border-radius: 0;
        }

        .assign-test-links .collapsed-card .card-header {
            background-color: rgba(0, 0, 0, 0.1);
            color: #212529;
            border: 1px solid rgba(0, 0, 0, 0.3);
        }
        .assign-test-links .collapsed-card i {
            color: rgba(0, 0, 0, 0.3);
        }

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('admin::layouts.header.index')

@include('admin::layouts.sidebar.index')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @include('admin::layouts.page_header.index')

    <!-- Main content -->
        <section class="content">

            @include('admin::layouts.flash_messages')

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@include('admin::layouts.footer.index')

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
{{--
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
--}}
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
--}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
    });
    $(document).ajaxError(function(event, jqXHR){
        // if use is not logged in redirect.
        if (jqXHR.status === 403) {
            window.location = window.location.origin + '/admin/login';
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });


</script>
@yield('footer-script')
</body>
</html>
