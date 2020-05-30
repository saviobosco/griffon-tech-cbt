@extends('layout.master')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Subject</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th> Name </th>
                                <td> {{ $subject->name }} </td>
                            </tr>
                            <tr>
                                <th> Description</th>
                                <td> {{ $subject->description }} </td>
                            </tr>
                            <tr>
                                <th> Total Questions</th>
                                <td> 1 </td>
                            </tr>
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
