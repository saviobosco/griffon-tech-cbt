{!! Form::model($test, ['route' => ['admin.tests.update', $test->id], 'role' => 'form']) !!}

<div>
    <div class="row">
        <div class="col-sm-5 assign-test-links">
            <fieldset class="normal-fieldset">
                <legend>Active Link</legend>
                <div class="text-right" style="border-bottom: 1px solid rgba(0, 0, 0, 0.3); padding: 5px;">
                    <label class="text-uppercase" for="">
                        Disable all active links
                        <input type="checkbox">
                    </label>
                </div>
                <div class="p-2">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Email Link To Test Takers </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Email Addresses : (Separated by Comma)</label>
                                <textarea class="form-control" name="email_addresses" id="" cols="30" rows="5"></textarea>
                            </div>

                            <div class="form-group float-right">
                                <button class="btn btn-primary btn-sm">send</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Add Link To Test On Your Website </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p> Provide link to the test, on an external website</p>
                            <p>Once a candidate clicks the link, he will be redirected to this platform</p>
                            <div class="form-group">
                                <input type="text" class="form-control" style="width: 95%; display: inline-block">
                                <i class="fa fa-info-circle" title="Link to the test"></i>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="p-2">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Access/Common Code </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <select name="" id="" class="form-control">
                                    <option value="access_code">Access Code</option>
                                    <option value="common_code">Common Code</option>
                                </select>
                            </div>
                            <div id="access_code_widget form-group">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" placeholder="Enter Quantity">
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-4">
                                        <button class="btn btn-success btn-block" style="border-radius: 0;">Export</button>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: 25px; border: 1px solid rgba(0, 0, 0, 0.3); padding: 5px;">
                                <p>If you want to download all access/common code generated till now.Please click on the button.</p>

                                <a class="text-uppercase text-bold" href="#"> Download all access/common codes <i class="fa fa-arrow-alt-circle-down"></i></a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="col-sm-4">
            <fieldset class="normal-fieldset">
                <legend>Assign to group</legend>
                <div class="p-2">
                    <label for="">
                        <input type="checkbox">
                        JSS 1
                    </label>
                </div>
            </fieldset>
        </div>

        <div class="col-sm-3">
            <fieldset class="normal-fieldset">
                <legend>Assign to product</legend>

                <div class="p-2">
                    <div>
                        <label for="">
                            <input type="checkbox">
                            Recruitment Test
                        </label>
                    </div>
                    <div>
                        <label for="">
                            <input type="checkbox">
                            Recruitment Test 2
                        </label>
                    </div>
                    <div>
                        <label for="">
                            <input type="checkbox">
                            Recruitment Test 3
                        </label>
                    </div>

                </div>
            </fieldset>
        </div>
    </div>

</div>
{{--<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>--}}

{!! Form::close() !!}
