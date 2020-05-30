<?php


namespace App\Http\Controllers;


use App\QuestionOption;

class QuestionOptionsController extends Controller
{

    public function create()
    {
        $getQuery = request()->query();
        if (view()->exists("questions.options.{$getQuery['question_type']}")) {
            return view("questions.options.{$getQuery['question_type']}")
                ->with(['number' => $getQuery['number']]);
        }
        return '<p> cant find the right view </p>';
    }

    public function destroy(QuestionOption $questionOption)
    {
        // check if the question belong to the user
        // check if the question has been answered before
        // if true stop the request
        // else continue with the question option delete
        try {
            if ($questionOption->delete()) {
                return 'Option was successfully deleted';
            } else {
                return 'Option could not be deleted';
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
