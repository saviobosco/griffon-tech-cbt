{!! Form::model($test, ['route' => ['admin.tests.update', $test->id], 'role' => 'form']) !!}

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group required">
            <label for="name">Test Name </label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Quiz Name']) !!}
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="test_category_id">Select Category</label>
                    {!! Form::select('test_category_id', $testCategories, null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="test_instructions">Test Instructions</label>
                    <select name="test_instruction" id="test_instructions" class="form-control">
                        <option value="">Select Instruction</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group required">
                    <label for="duration">Duration(In Min.)</label>
                    {!! Form::number('duration', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="form-group required">
                    <label for="difficulty_level">Difficulty Level</label>
                    {!! Form::select('difficulty_level', [
                        'difficulty' => 'Difficulty',
                        'easy' => 'easy',
                        'normal' => 'normal'
                    ], null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group required">
                    <label for="total_question">Total Question</label>
                    {!! Form::number('total_question', null, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="form-group required">
                    <label for="total_mark">Total Marks</label>
                    {!! Form::number('total_mark', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group required">
            <label for="test_template">Test Template</label>

            <select name="template" id="test_template" class="form-control">
                <option value="default_template">Default</option>
            </select>
        </div>
    </div>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
{!! Form::close() !!}
