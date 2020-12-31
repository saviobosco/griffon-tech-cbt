@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        <ul class="form-step-list">
                            <li class="step active" id="create-new-test">
                                <div>
                                    <p class="step-heading">Step 1</p>
                                    <p class="step-desc">
                                        Create a new test
                                    </p>
                                </div>
                            </li>
                            <li class="step" id="test-setting">
                                <div>
                                    <p class="step-heading">Step 2</p>
                                    <p class="step-desc">Test settings</p>
                                </div>
                            </li>
                            <li class="step" id="add-questions">
                                <div>
                                    <p class="step-heading">Step 3</p>
                                    <p class="step-desc">Add questions</p>
                                </div>
                            </li>
                            <li class="step" id="publish-test">
                                <div>
                                    <p class="step-heading">Step 4</p>
                                    <p class="step-desc">Publish</p>
                                </div>
                            </li>
                            <li class="step" id="assign-test">
                                <div>
                                    <p class="step-heading">Step 5</p>
                                    <p class="step-desc">Assign Test</p>
                                </div>
                            </li>
                            <li class="step" id="create-certificate">
                                <div>
                                    <p class="step-heading">Step 6</p>
                                    <p class="step-desc">Create Certificate</p>
                                </div>
                            </li>
                        </ul>
                        <div>
                            <div class="form-tabs">
                                <div class="form-step-tab" id="form-tab">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

@section('footer-script')
    <script>

        var test_id;

        // setting the test id to a test_id var in javascript;
        @if (isset($test))
            test_id = {{ $test->id }}
        @endif

        $('.step').click(function(event) {
            event.preventDefault();

            if (test_id !== undefined) {
                //window.location.hash = event.currentTarget.id;
                displayTab(event.currentTarget.id);
            }
        });


        function displayTab(tabId) {
            $('.step').removeClass('active');

            $('#' + tabId).addClass('active');

            $("#form-tab").load(window.location.origin
                + '/admin/tests/get-step/' + test_id +'?test_step=' + tabId
            );

            /*$('.form-step-tab').hide();
            $("[data-id="+ tabId +"]").show();*/
        }

        /*window.addEventListener('hashchange', function() {
            var tabId = window.location.hash.substr(1);
            displayTab(tabId);
        }, null);*/


        $(window).on("load", function() {
            if (window.location.hash !== "") {
                var tabId = window.location.hash.substr(1);
                displayTab(tabId);
            } else {
                displayTab('create-new-test');
            }
        });
    </script>

@endsection

