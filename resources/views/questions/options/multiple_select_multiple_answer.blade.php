<div data-container-id="{{ $number }}">
    <div class="form-group">
        <label for="option_answer_text_{{ $number }}"> #Option {{ $number }} </label>
        <textarea id="option_answer_text_{{ $number }}" name="option_answer[{{ $number }}][text]" class="form-control" cols="30" rows="5"></textarea>
        <div class="mt-3">
            <label for="option_answer_{{ $number }}">
                <input id="option_answer_{{ $number }}" name="option_answer[{{ $number }}][correct]" type="checkbox"> correct answer
            </label>
            <button data-id="{{ $number }}" class="btn btn-danger btn-sm">remove</button>
        </div>
    </div>
</div>
