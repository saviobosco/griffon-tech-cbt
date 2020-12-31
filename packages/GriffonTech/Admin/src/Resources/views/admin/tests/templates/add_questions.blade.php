<div id="add-question-display">
    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-6">
            <div class="card gray-background">
                <div class="card-body">
                    <ul>
                        <li>Directly add question from question bank.</li>
                        <li>The selected set of questions will be associated with the test.</li>
                    </ul>
                    <div class="text-center">
                        <a id="add-question-bank" class="btn btn-success btn-sm" href="">
                            <i class="fa fa-plus"></i>
                            Select Question
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-3">

        </div>
    </div>
</div>

<script>
    // test_id varraible is a global variable... located in the
    // edit test view.

$('#add-question-bank').click(function(event) {
    // load the new add questions view.
    event.preventDefault();
    $("#add-question-display").load(window.location.origin
        + '/admin/test-questions/edit/' + test_id
    );
});
</script>
