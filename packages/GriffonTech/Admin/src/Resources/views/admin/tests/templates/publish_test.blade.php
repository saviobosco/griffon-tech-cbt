
<div class="row">
    <div class="col-sm-6">
        {!! Form::model($test, ['route' => ['admin.tests.update', $test->id], 'role' => 'form']) !!}
        <div>
            <div class="form-group">
                <input type="hidden" name="is_published" value="0">
                <label for="publish_test" class="text-uppercase">
                    {!! Form::checkbox('is_published', 1, null, ['id' => 'publish_test']) !!}
                     Publish Test
                </label>
            </div>
            <p style="margin-bottom: 0">To specify the tentative dates</p>

            <div class="form-group required">
                <label for="start_date_and_end_date">Start & End Date</label>
                <div class="row">
                    <div class="col-sm-6">

                        <div class="input-group date" id="start-date-picker" data-target-input="nearest">
                            <input type="text" name="start_date"
                                   class="form-control datetimepicker-input"
                                   data-target="#start-date-picker"
                            value="{{ $test->start_date }}">
                            <div class="input-group-append"
                                 data-target="#start-date-picker"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="input-group date" id="end-date-picker" data-target-input="nearest">
                            <input type="text" name="end_date"
                                   class="form-control datetimepicker-input"
                                   data-target="#end-date-picker"
                                   value="{{ $test->end_date }}">
                            <div class="input-group-append"
                                 data-target="#end-date-picker"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group required">
                <p style="margin-bottom: 0">Provide the start and end time for the test</p>
                <label for="start_date_and_end_date">Start & End Time</label>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="input-group" id="start-time-picker" data-target-input="nearest">
                            <input type="text" name="start_time" class="form-control datetimepicker-input"
                                   data-target="#start-time-picker" value="{{$test->start_time}}">
                            <div class="input-group-append" data-target="#start-time-picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="input-group" id="end-time-picker" data-target-input="nearest">
                            <input type="text" name="end_time" class="form-control datetimepicker-input"
                                   data-target="#end-time-picker" value="{{$test->end_time}}">
                            <div class="input-group-append" data-target="#end-time-picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            <div class="mt-4">
                <div class="form-group">
                    <label for="advanced_time_option">
                        <input id="advanced_time_option" type="checkbox"
                        {!! ($test->max_submit_date) ? 'checked="checked"' : '' !!}>
                        Advanced Time Option
                    </label>
                </div>

                <div id="advanced-time-option-display" {!! (!$test->max_submit_date) ? 'style="display: none;"' : '' !!}>
                    <div class="form-group required">
                        <label for="start_date_and_end_date">Max Submit Date &Fix End Date</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group date" id="max-submit-date-picker" data-target-input="nearest">
                                    <input type="text" name="max_submit_date"
                                           class="form-control datetimepicker-input"
                                           data-target="#max-submit-date-picker"
                                           value="{{ $test->max_submit_date }}">
                                    <div class="input-group-append"
                                         data-target="#max-submit-date-picker"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group date" id="fix-end-date-picker" data-target-input="nearest">
                                    <input type="text" name="fix_end_date"
                                           class="form-control datetimepicker-input"
                                           data-target="#fix-end-date-picker"
                                           value="{{ $test->fix_end_date }}">
                                    <div class="input-group-append"
                                         data-target="#fix-end-date-picker"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group required">
                        <label for="start_date_and_end_date">Max Submit Time &Fix End Time</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group" id="max-submit-time-picker" data-target-input="nearest">
                                    <input type="text" name="max_submit_time" class="form-control datetimepicker-input"
                                           data-target="#max-submit-time-picker" value="{{$test->max_submit_time}}">
                                    <div class="input-group-append" data-target="#max-submit-time-picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="input-group" id="fix-end-time-picker" data-target-input="nearest">
                                    <input type="text" name="fix_end_time" class="form-control datetimepicker-input"
                                           data-target="#fix-end-time-picker" value="{{$test->fix_end_time}}">
                                    <div class="input-group-append" data-target="#fix-end-time-picker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>
        {!! Form::close() !!}

    </div>
</div>

<script>
    $(function() {
        $('#start-date-picker').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#end-date-picker').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false
        });

        $("#start-date-picker").on("change.datetimepicker", function (e) {
            $('#end-date-picker').datetimepicker('minDate', e.date);
        });

        $("#end-date-picker").on("change.datetimepicker", function (e) {
            $('#start-date-picker').datetimepicker('maxDate', e.date);
        });


        // for the advanced time and date pickers
        $('#max-submit-date-picker').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#fix-end-date-picker').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false
        });

        $("#max-submit-date-picker").on("change.datetimepicker", function (e) {
            $('#fix-end-date-picker').datetimepicker('minDate', e.date);
        });

        $("#fix-end-date-picker").on("change.datetimepicker", function (e) {
            $('#max-submit-date-picker').datetimepicker('maxDate', e.date);
        });


        // time picker
        $('#start-time-picker, #end-time-picker, #fix-end-time-picker, #max-submit-time-picker').datetimepicker({
            format: 'hh:mm:ss'
        });


        $("#advanced_time_option").click(function(){
           var checked = $(this).prop('checked');
           if (checked) {
               $('#advanced-time-option-display').show();
           } else {
               $('#advanced-time-option-display').hide();
           }
        });
    });

</script>

