<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Models\QuestionOption;

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
            $questionOption->delete();
            return response()->json([
                'data' => [
                    'message' => 'Successfully deleted!'
                ]
            ], 204);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => [
                    'message' => $exception->getMessage()
                ]
            ], 500);
        }
    }
}
