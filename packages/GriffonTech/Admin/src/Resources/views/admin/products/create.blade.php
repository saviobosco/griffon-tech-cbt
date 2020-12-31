@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create a Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.products.store', 'role' => 'form']) !!}

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">*Product Name </label>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Quiz Name']) !!}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="product_code">*Product Code </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Group Name</label>
                                    <select name="group_name" id="" class="form-control">
                                        <option value="">Select Group</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="test_template">Product Type </label>
                                    <select name="group_name" id="" class="form-control">
                                        <option value="">Test Series</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">*Product Description</label>
                            <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">*Image</label>
                            <input type="file">
                        </div>

                        <div>
                            <h6>Step 2: Decide the cost</h6>
                            <div class="form-group">
                                <label for="">*Price to Compare</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">*Price</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div>
                            <h6>Step 3: Add Test</h6>
                            <div class="form-group">
                                <label for="">Test Category</label>
                                <select name="" id="">
                                    <option value="">category</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div>
                                    Test in category
                                </div>
                                <div>
                                    Test in product
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6>Step 6: Publish</h6>
                            <div class="form-group">
                                <label for="">
                                    <input type="checkbox"> Publish
                                </label>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="">Publish Date</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Expiry Date</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


@endsection

