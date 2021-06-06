@extends('admin::layouts.master')

@section('page_title')
    Edit Test Instruction
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Test Instruction</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($testInstruction, ['route' => ['admin.test_instructions.update', $testInstruction->id], 'role' => 'form']) !!}

                        <div class="form-group">
                            <label for="name"> Name </label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                        </div>

                        <div class="form-group">
                            <label for="instruction"> Instruction </label>
                            {!! Form::textarea('instruction', null, ['class' =>'form-control textarea', 'cols' => 30, 'rows' =>10]) !!}
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
