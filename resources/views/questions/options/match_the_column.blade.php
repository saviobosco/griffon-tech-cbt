<div data-container-id="{{ $number }}">
    <div class="form-group">
        <label for="option_answer_text_{{ $number }}"> #Option {{ $number }} </label>
        <div class="row">
            <div class="col-sm-4">
                <input type="text" name="option_answer[{{ $number }}][text_1]" class="form-control">
            </div>
            <div class="col-sm-1 text-center">
                =
            </div>
            <div class="col-sm-4 text-left">
                <input type="text" name="option_answer[{{ $number }}][text_2]" class="form-control">
            </div>
            <div class="col-sm-2">
                <div>
                    <button data-id="{{ $number }}" class="btn btn-danger btn-sm">remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
