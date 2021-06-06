@extends('admin::layouts.master')

@section('page_title')
    Dashboard
@endsection


@section('content')

    <div class="container-fluid dashboard-view">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{ number_format($total_candidates) }}</h3>

                        <p>Total Candidates</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer"> <i class="fas fa-plus"></i> Add New Candidate </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3> {{ number_format($total_questions) }}</h3>

                        <p>Total Questions</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-database"></i>
                    </div>
                    <a href="{{ route('admin.questions.create') }}" class="small-box-footer"> <i class="fas fa-plus"></i> Add New Question </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{ number_format($total_tests) }}</h3>

                        <p>Total Tests</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clipboard-check"></i>
                    </div>
                    <a href="{{ route('admin.tests.create') }}" class="small-box-footer"> <i class="fas fa-plus"></i> Add New Test </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{ number_format($total_products) }}</h3>

                        <p>Total Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="small-box-footer"><i class="fas fa-plus"></i> Add New Product</a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            Candidates Registration
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#daily-reg-chart" data-toggle="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#monthly-reg-chart" data-toggle="tab">Monthly</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="daily-reg-chart"
                                 style="position: relative; height: 300px;">
                                <canvas id="daily-registration-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="monthly-reg-chart" style="position: relative; height: 300px;">
                                <canvas id="monthly-registration-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- solid sales graph -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Users Test Rate
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas class="chart" id="test-bar-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card -->

                <!-- Calendar -->
                <div class="card">
                    <div class="card-header border-0">

                        <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendar
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                    <i class="fas fa-bars"></i></button>
                                <div class="dropdown-menu" role="menu">
                                    <a href="#" class="dropdown-item">Add new event</a>
                                    <a href="#" class="dropdown-item">Clear events</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">View calendar</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pt-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

@endsection

@section('footer-script')
    <script>

        var days_ranges = {!! $days_ranges !!};
        var days_reg_count = {!! $real_days !!};

        var month_ranges = {!! $month_ranges !!};
        var months_reg_count = {!! $real_months !!};

        var test_ranges = {!! $test_ranges !!};
        var test_counts = {!! $test_session_counts !!};



        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : true,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : true,
                    }
                }]
            }
        }

        var areaChartData = {
            labels  : days_ranges,
            datasets: [
                {
                    label               : 'Candidate Registrations',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : days_reg_count
                },
                /*{
                    label               : 'Electronics',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : [65, 59, 80, 81, 56, 55, 40]
                },*/
            ]
        }
        var lineChartCanvas = $('#daily-registration-chart-canvas').get(0).getContext('2d')
        var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
        var lineChartData = jQuery.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        //lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        });


        // monthly registrations
        var monthlyRegChartData = {
            labels  : month_ranges,
            datasets: [
                {
                    label               : 'Candidate Registrations',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : months_reg_count
                }
            ]
        }
        var lineMonthlyChartCanvas = $('#monthly-registration-chart-canvas').get(0).getContext('2d')
        var lineMonthlyChartOptions = jQuery.extend(true, {}, areaChartOptions)
        monthlyRegChartData.datasets[0].fill = false;
        //lineChartData.datasets[1].fill = false;
        lineMonthlyChartOptions.datasetFill = false

        var lineMonthlyChart = new Chart(lineMonthlyChartCanvas, {
            type: 'line',
            data: monthlyRegChartData,
            options: lineMonthlyChartOptions
        });

        // test session bar chart.
        var testsChartData = {
            labels  : test_ranges,
            datasets: [
                {
                    label               : 'Test Sessions',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : test_counts
                }
            ]
        }

        var barChartCanvas = $('#test-bar-chart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, testsChartData)
        //var temp0 = barChartData.datasets[0]
        //var temp1 = areaChartData.datasets[1]
        //barChartData.datasets[0] = temp1
        //barChartData.datasets[0] = temp0

        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })


        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        })
    </script>
@endsection
