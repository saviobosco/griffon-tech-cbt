@extends('admin::layouts.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">
                        <form action="" class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Product Name">
                            </div>
                            <div class="form-group ml-4">
                                <button class="btn btn-primary"> Search </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">
                        <div class="mb-3 float-right">
                            <a class="btn btn-default btn-sm" href="{{ route('admin.products.create') }}"> <i class="fa fa-plus"></i> Add New Product</a>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 100%;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product Name</th>
                                <th>Product Type</th>
                                <th>Product Cost</th>
                                <th>No of Test</th>
                                <th>Publish Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Recruitment Test</td>
                                <td>Test series</td>
                                <td>2000</td>
                                <td>3</td>
                                <td>02/04/2021</td>
                                <td>15/04/2021</td>
                                <td>
                                    <a data-toggle="dropdown" href="#" aria-expanded="false" style="position: relative">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 30px;">
                                        <a href="#" class="dropdown-item">
                                            hello
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">
                                            You
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">
                                            Yes
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
