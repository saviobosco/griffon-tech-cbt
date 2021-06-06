@extends('admin::layouts.master')

@section('page_title')
    Create Test Instruction
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Test Instruction</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.test_instructions.store', 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="name"> Name </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label for="instruction"> Instruction </label>
                            <textarea  id="instruction" name="instruction" class="form-control textarea" cols="30" rows="10"></textarea>
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

@section('footer-script')
    <script>
        $(function () {
            // Summernote
            $('.textarea').summernote({
                height: 200
            });
        })
    </script>
@stop
