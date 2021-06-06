<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} | Test Session - In Progress | {{ $testSession->test->name }} </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .question-lists {
            padding-left: 0;
        }
        .question-lists li{
            display: inline;
        }
        .question-lists a {
            display: inline-block;
            margin: 5px 5px ;
            border: 1px solid rgba(0,0,0,.325);
            padding: 1px 8px;
            border-radius: 2px;
        }
        label {
            font-weight: 500 !important;
        }

        .question-options-container, .answer-container {
            margin-top: 40px;
        }
        .save_answer_signal {
            float: right;
            width: 6px;
            height: 6px;
            border-radius: 2px;
            background-color: #666666;
            margin: 2px;
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">GriffonTech-CBT</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-lg">
                            <i class="fa-italic fa fa-info-circle"></i>Instructions
                        </a>
                    </li>

                </ul>
            </div>


            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <div>
                        <div class="save_answer_signal" id="save_answer_signal2"></div>
                        <div class="save_answer_signal" id="save_answer_signal1"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> Recruitment Test 1</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <p style="font-size: 1.5em;" class="float-right">
                            Time Remaining :
                            <span id="timer" class="text-success">00:00</span>
                        </p>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <span class="text-bold">Question No. <span id="question-number-header">0</span></span>
                                <div class="float-right text-sm">
                                    <span style="display:inline-block; margin-right: 10px;">Maximum mark mark: <span class="text-success">10</span> </span>
                                    <span>Minimum mark: <span class="text-danger">1</span> </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('candidate.test_sessions.save_answer', $testSession->id) }}" id="test-session-form" method="POST">
                                    @csrf

                                    @if (isset($questions))

                                        <?php
                                        $optionChars = ['A','B','C','D','E','F','G']
                                        ?>

                                        @foreach($questions as $index => $question)

                                            <div class="question-container" id="question-{{$index}}" data-question-id="{{ $question->id }}">
                                                <p class="card-text">
                                                    {{ $question->question }}
                                                </p>
                                                <input type="hidden" name="answers[{{$question->id}}][type]" value="{{ $question->type }}">
                                                @if ($question->type === 'multiple_choice')
                                                    <div class="question-options-container">
                                                        @foreach($question->options as $optionIndex => $option)
                                                            <div>
                                                                {{ $optionChars[$optionIndex] }}. &nbsp;&nbsp;&nbsp;

                                                                <label for="{{ $question->id }}-{{$option->id}}" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                                    <input id="{{ $question->id }}-{{$option->id}}" type="radio" name="answers[{{$question->id}}][answer]" value="{{ $option->id }}" {{ (in_array($option->id, $testSessionAnswerOptions)) ? 'checked=checked' : '' }}>
                                                                    {{ $option->option }}
                                                                </label>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                @elseif ($question->type === 'multiple_response')
                                                    <div class="question-options-container">
                                                        @foreach($question->options as $optionIndex => $option)
                                                            <div>
                                                                {{ $optionChars[$optionIndex] }}
                                                                <label for="{{ $question->id }}-{{$option->id}}" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                                    <input id="{{ $question->id }}-{{$option->id}}" type="checkbox" name="answers[{{$question->id}}][answer][]" value="{{ $option->id }}" {{ (in_array($option->id, $testSessionAnswerOptions)) ? 'checked=checked' : '' }}>
                                                                    {{ $option->option }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @elseif ($question->type === 'true_or_false')

                                                    <div class="question-options-container">
                                                        @foreach($question->options as $option)
                                                            <div>
                                                                <label for="{{ $question->id }}-{{$option->id}}" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                                    <input id="{{ $question->id }}-{{$option->id}}" type="radio" name="answers[{{$question->id}}][answer]" value="{{ $option->id }}" {{ (in_array($option->id, $testSessionAnswerOptions)) ? 'checked=checked' : '' }}>
                                                                    {{ strtoupper($option->option) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @elseif ($question->type === 'match_the_column')
                                                    <?php
                                                    $savedAnswers = [];
                                                    if (isset($testSessionAnswers)) {
                                                        foreach ($testSessionAnswers as $testSessionAnswer) {
                                                            if ((int)$testSessionAnswer->question_id === (int)$question->id) {
                                                                $savedAnswers[] = $testSessionAnswer->answer_text;
                                                            }
                                                        }
                                                    }

                                                    $options =  $question->options->pluck('option')->shuffle();
                                                    $optionMatches = $question->options->pluck('option_match')->shuffle();
                                                    ?>
                                                    @foreach($options as $index =>  $option)
                                                        <div class="row">
                                                            <div class="col-sm-1">
                                                                <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                                    {{ $option }}
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-1">=</div>
                                                            <div class="col-sm-3">
                                                                <select name="answers[{{ $question->id }}][answer][]" id="{{$question->id}}-{{$index}}" class="form-control">
                                                                    <option value="">Select</option>
                                                                    @foreach($optionMatches as $optionMatch)
                                                                        <option value="{{$option}}__{{ $optionMatch }}"  {{ (in_array($option.'__'.$optionMatch, $savedAnswers)) ? 'selected' : '' }} >{{ $optionMatch }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                @elseif ($question->type === 'fill_the_blank')

                                                    <div class="answer-container">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="answers[{{ $question->id }}][answer]" value="{{ (isset($testSessionAnswersText[$question->id])) ? $testSessionAnswersText[$question->id] : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @elseif ($question->type === 'essay')

                                                    <div class="answer-container">
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="" cols="30" rows="10" name="answers[{{ $question->id }}][answer]">{{ (isset($testSessionAnswersText[$question->id])) ? $testSessionAnswersText[$question->id] : '' }}</textarea>
                                                        </div>
                                                    </div>

                                                @endif
                                            </div>

                                        @endforeach
                                    @endif
                                </form>

                            </div>
                            <div class="card-footer">
                                <button id="back-button" style="border-radius: 0;" onclick="javascript:back();" class="btn btn-danger">Back</button>
                                <button id="next-button" style="border-radius: 0; margin-left: 20px;" onclick="javascript:saveAndNext();" class="btn btn-info">Save & Next</button>
                                <div class="float-right">
                                    <label for="">
                                        <input type="checkbox"> Review Later
                                    </label>
                                </div>

                            </div>
                        </div>


<!--                        <div class="card">
                            <div class="card-header">
                                <span class="text-bold">Question No. 2</span>
                                <div class="float-right text-sm">
                                    <span style="display:inline-block; margin-right: 10px;">Maximum mark mark: <span class="text-success">10</span> </span>
                                    <span>Minimum mark: <span class="text-danger">1</span> </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Pick the options that are synonymous with the word "Go"?
                                </p>

                                <div style="margin-top: 40px;">
                                    <div>
                                        <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                            <input type="checkbox">
                                            A noun is a name of a place, person, animal or thing.
                                        </label>
                                    </div>
                                    <div>
                                        <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                            <input type="checkbox">
                                            A noun is a name of a place, person, animal or thing.
                                        </label>
                                    </div>
                                    <div>
                                        <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                            <input type="checkbox">
                                            A noun is a name of a place, person, animal or thing.
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <span class="text-bold">Question No. 3</span>
                                <div class="float-right text-sm">
                                    <span style="display:inline-block; margin-right: 10px;">Maximum mark mark: <span class="text-success">10</span> </span>
                                    <span>Minimum mark: <span class="text-danger">1</span> </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Match the options accordingly.
                                </p>

                                <div style="margin-top: 40px;">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                Dog
                                            </label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="" id="" class="form-control">
                                                <option value="">Bark</option>
                                                <option value="">Woof!</option>
                                                <option value="">Meo Meo!</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                Cat
                                            </label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="" id="" class="form-control">
                                                <option value="">Bark</option>
                                                <option value="">Woof!</option>
                                                <option value="">Meo Meo!</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="" style="display: inline-block; border: 1px solid rgba(0, 0, 0, .125); padding: 10px; border-radius: 5px;">
                                                Fowl
                                            </label>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="" id="" class="form-control">
                                                <option value="">Bark</option>
                                                <option value="">Woof!</option>
                                                <option value="">Meo Meo!</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <span class="text-bold">Question No. 4</span>
                                <div class="float-right text-sm">
                                    <span style="display:inline-block; margin-right: 10px;">Maximum mark mark: <span class="text-success">10</span> </span>
                                    <span>Minimum mark: <span class="text-danger">1</span> </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    What is the best answer to this question and also type it here in full please.
                                </p>

                                <div style="margin-top: 40px;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <span class="text-bold">Question No. 5</span>
                                <div class="float-right text-sm">
                                    <span style="display:inline-block; margin-right: 10px;">Maximum mark mark: <span class="text-success">10</span> </span>
                                    <span>Minimum mark: <span class="text-danger">1</span> </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    Write an essay about your self here.
                                </p>

                                <div style="margin-top: 40px;">
                                    <div class="form-group">
                                        <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>-->

                    </div>
                    <!-- /.col-md-9 -->



                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">

                                <div>
<!--                                    <div class="subject-lists">
                                        <ul>
                                            <li>
                                                <a class="" href="">Mathematics</a>
                                            </li>
                                        </ul>
                                    </div>-->
                                    <ul class="question-lists">
                                        @for($num = 0; $num < $questions->count(); $num++)
                                            <li><a href="javascript:;" onclick="javascript:goToQuestion({{$num}})">{{ $num + 1 }}</a> </li>
                                        @endfor
                                    </ul>
                                </div>

                                <div style="margin-top: 50px;" class="row">
                                    <div class="col-sm-6">
                                        <p> <span style="display: inline-block; height: 10px; width: 10px; background-color: blue; border-radius: 50%"></span> Attempted </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p> <span style="display: inline-block; height: 10px; width: 10px; background-color: inherit; border-radius: 50%; border: 1px solid rgba(0, 0, 0, .125);"></span> Unattempted </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p> <span style="display: inline-block; height: 10px; width: 10px; background-color: cyan; border-radius: 50%;"></span> Review </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p> <span style="display: inline-block; height: 10px; width: 10px; background-color: rgba(0, 0, 0, .125); border-radius: 50%;"></span> Skipped </p>
                                    </div>
                                </div>


                                <div>
                                    <button class="btn btn-success" onclick="javascript:submitTest();">Submit Test</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="#"> {{ config('app.name') }} </a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Test Instructions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $testSession->test->test_instruction->instruction !!}
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>


<script>
    var ctime=0;
    function increasectime(){
        ctime+=1;
    }

    function resetQuestionTimer() {
        ctime = 0;
    }
    setInterval(increasectime,1000);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
    });


    var no_of_questions = "{{ $questions->count() }}";
    var current_question_index = 0;
    var question_id = undefined;
    var test_session_id = {{ $testSession->id }};


    function back()
    {
        // save result
        saveAnswer();
        if (current_question_index !== 0) {
            resetQuestionTimer();
            hideQuestions();
            $('#question-'+ --current_question_index).show();
            $('#question-number-header').text(current_question_index + 1);
        }
        changeButtonsState();
    }

    function saveAndNext()
    {
        // save result.
        saveAnswer();
        if (current_question_index < (no_of_questions - 1)) {
            resetQuestionTimer();
            hideQuestions();
            current_question_index += 1;
            console.log(current_question_index);
            $('#question-'+ current_question_index).show();
            $('#question-number-header').text(current_question_index + 1);
        }
        changeButtonsState();
    }

    function changeButtonsState()
    {
        if (current_question_index === no_of_questions - 1) {
            $('#next-button').attr('disabled', true);
        } else {
            $('#next-button').attr('disabled', false);
        }

        if (current_question_index === 0) {
            $('#back-button').attr('disabled', true);
        } else {
            $('#back-button').attr('disabled', false);
        }

    }


    function hideQuestions()
    {
        $('.question-container').hide();
        // iterate and hide all questions
    }

    function showQuestion()
    {
        // move to the next question and show it.
    }

    function saveAnswer()
    {
        $('#save_answer_signal1').css('backgroundColor','#00ff00');
        setTimeout(function(){
            $('#save_answer_signal1').css('backgroundColor','#666666');
        },5000);

        let question = $('#question-' + current_question_index);
        question_id = question[0].dataset.questionId;

        let test_session_form = $('#test-session-form');

        let post_data =  test_session_form.serialize();
        console.log(post_data);

        $.ajax({
            type: "POST",
            url: test_session_form[0].action,
            data: post_data + '&' + $.param({'question_id': question_id, 'time_spent': ctime}),
            success: function(data){
                $('#save_answer_signal2').css('backgroundColor','#00ff00');
                setTimeout(function(){
                    $('#save_answer_signal2').css('backgroundColor','#666666');
                },5000);
            },
            error: function(xhr, status, errStr) {
                $('#save_answer_signal2').css('backgroundColor', '#ff0000');
                setTimeout(function () {
                    $('#save_answer_signal2').css('backgroundColor', '#666666');
                }, 5500);
            }
        });
    }

    function submitTest()
    {
        saveAnswer();
        if (confirm('Are you sure you would like to submit this test ?')) {
            $.post(window.origin + '/candidate/test-sessions/submit/' + test_session_id, function(data, statusText, xhr){
                console.log(data);
                if (data.redirect_url !== undefined && data.hasOwnProperty('redirect_url')) {
                    window.location = data.redirect_url;
                }
            });
            // submit test here
        }
    }

    function goToQuestion(number) {
        // saveResult

        hideQuestions();
        $('#question-'+ number).show();
        $('#question-number-header').text(number + 1);
        current_question_index = number;
        changeButtonsState();
    }

    function initialize()
    {
        hideQuestions();
        let question = $('#question-0'); // show the default question.
        question_id = question[0].dataset.questionId;
        question.show();
        $('#question-number-header').text('1');
    }

    initialize();
    /*function connectionSignal() {
        $('#save_answer_signal1').css('backgroundColor','#00ff00');
        setTimeout(function(){

            $('#save_answer_signal1').css('backgroundColor','#666666');

            $('#save_answer_signal2').css('backgroundColor','#00ff00');
            setTimeout(function(){
                $('#save_answer_signal2').css('backgroundColor','#666666');

                connectionSignal();
            },5000);
        },5000);
        //connectionSignal();
    }
    connectionSignal();*/
</script>

<script>
    var Timer;
    var TotalSeconds;


    function CreateTimer(TimerID, Time) {
        Timer = document.getElementById(TimerID);
        TotalSeconds = Time;

        UpdateTimer()
        window.setTimeout("Tick()", 1000);
    }

    function Tick() {
        if (TotalSeconds <= 0) {
            alert("Time's up!")
            return;
        }

        TotalSeconds -= 1;
        UpdateTimer()
        window.setTimeout("Tick()", 1000);
    }

    function UpdateTimer() {
        var Seconds = TotalSeconds;

        var Days = Math.floor(Seconds / 86400);
        Seconds -= Days * 86400;

        var Hours = Math.floor(Seconds / 3600);
        Seconds -= Hours * (3600);

        var Minutes = Math.floor(Seconds / 60);
        Seconds -= Minutes * (60);

        Timer.innerHTML = ((Days > 0) ? Days + " days " : "") + LeadingZero(Hours) + ":" + LeadingZero(Minutes) + ":" + LeadingZero(Seconds);
    }


    function LeadingZero(Time) {

        return (Time < 10) ? "0" + Time : +Time;

    }
    /*setTimeout(submitform, '0');

    function submitform() {
        alert('Time Over');
        window.location = "";
    }*/

    window.onload = CreateTimer("timer", {{ $timeRemaining }});

    setTimeout(function(){
        alert("Time Over");

        submitTest();
    }, {{ $timeRemaining }} * 1000);

</script>

</body>
</html>
