<?php


namespace GriffonTech\Candidate\Http\Controllers;


use GriffonTech\Question\Repositories\QuestionOptionRepository;
use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Subject\Repositories\SubjectRepository;
use GriffonTech\Test\Models\TestSession;
use GriffonTech\Test\Repositories\TestQuestionRepository;
use GriffonTech\Test\Repositories\TestSessionAnswerRepository;
use Illuminate\Http\Request;

class TestSessionsController extends Controller
{

    protected $_config;
    protected $questionRepository;
    protected $subjectRepository;
    protected $testSessionAnswerRepository;
    protected $questionOptionRepository;
    protected $testQuestionRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        SubjectRepository $subjectRepository,
        TestSessionAnswerRepository $testSessionAnswerRepository,
        QuestionOptionRepository $questionOptionRepository,
        TestQuestionRepository $testQuestionRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->subjectRepository = $subjectRepository;
        $this->testSessionAnswerRepository = $testSessionAnswerRepository;
        $this->questionOptionRepository = $questionOptionRepository;
        $this->testQuestionRepository = $testQuestionRepository;

        $this->_config = \request('_config');
    }

    public function inProgress(TestSession $testSession)
    {
        // check if its the same user.
        //
        // test sessions
        // check if the current time is greater than the end time

        // end the test and return user back to the end of the test
        // depending on the test parameters

        // if active, fetch all subjects and all the questions
        // calculate the remaining time, get all previous answers of questions
        // return to the testing session view.

        //dd($testSession->end_time->diffInSeconds(now())); //getting the time difference
        $timeRemaining = $testSession->end_time->diffInSeconds(now());
        $questions = $this->questionRepository->findWhereIn('id', explode(",", $testSession->question_ids));
        $subjects = $this->subjectRepository->findWhereIn('id', explode(",", $testSession->subject_ids));
        $testSessionAnswers = $this->testSessionAnswerRepository
            ->findWhere([
                'test_session_id' => $testSession->id
            ]);
        $testSessionAnswersText = $testSessionAnswers->pluck('answer_text', 'question_id');

        $testSessionAnswerOptions = $testSessionAnswers
            ->pluck('question_option_id')
            ->toArray();

        return view('candidate::candidate.test_templates.default')
            ->with(compact('testSession',
                'questions',
                'subjects', 'timeRemaining', 'testSessionAnswers',
                'testSessionAnswerOptions', 'testSessionAnswersText'));
    }


    public function saveAnswer(Request $request, TestSession $testSession)
    {
        // get all answers
        // and save the
        $answers = $request->input('answers');
        if (is_array($answers)) {
            $answer = $answers[$request->input('question_id')];

            if (isset($answer['answer'])) {
                // if the question type is multiple_choice
                if ($answer['type'] === 'multiple_choice') {
                    $testQuestion = $this->testQuestionRepository
                        ->findWhere([
                            'test_id' => $testSession->test_id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    $testSessionAnswerOption = $this->testSessionAnswerRepository
                        ->findWhere([
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    if ($testSessionAnswerOption) {
                        if ((int)$answer['answer'] !== (int)$testSessionAnswerOption->question_option_id) {
                            $correctOption = $this->questionOptionRepository
                                ->findWhere([
                                    'question_id' => $request->input('question_id'),
                                    'is_correct' => 1
                                ],['id'])->first();

                            $updateData = ['question_option_id' => $answer['answer']];
                            if ((int)$correctOption->id === (int)$answer['answer']) {
                                $updateData['score'] = $testQuestion->right_mark;
                            } else {
                                $updateData['score'] = $testQuestion->negative_mark;
                            }
                            $testSessionAnswerOption->update($updateData);
                        }

                    } else {
                        $correctOption = $this->questionOptionRepository
                            ->findWhere([
                                'question_id' => $request->input('question_id'),
                                'is_correct' => 1
                            ],['id'])->first();
                        $updateData = [
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id'),
                            'question_option_id' => $answer['answer']
                        ];
                        if ((int)$correctOption->id === (int)$answer['answer']) {
                            $updateData['score'] = $testQuestion->right_mark;
                        } else {
                            $updateData['score'] = $testQuestion->negative_mark;
                        }
                        $this->testSessionAnswerRepository->create($updateData);
                    }

                } elseif ($answer['type'] === 'multiple_response') {
                    $testQuestion = $this->testQuestionRepository
                        ->findWhere([
                            'test_id' => $testSession->test_id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    $testSessionAnswerOptions = $this->testSessionAnswerRepository
                        ->findWhere([
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id')
                        ]);

                    $correctOptions = $this->questionOptionRepository
                        ->findWhere([
                            'question_id' => $request->input('question_id'),
                            'is_correct' => 1
                        ],['id'])
                        ->pluck('id')
                        ->toArray();

                    if ($testSessionAnswerOptions->isNotEmpty()) {
                        foreach ($testSessionAnswerOptions as $testSessionAnswerOption) {
                            // remove any previously scored answer that is not in the submitted answer array
                            if (!in_array($testSessionAnswerOption->question_option_id, $answer['answer'])) {
                                $testSessionAnswerOption->delete();
                            }
                        }
                    }
                    foreach ($answer['answer'] as $selectedOption) {
                        // check if the option answer exists
                        $testSessionAnswerOption = $this->testSessionAnswerRepository
                            ->findWhere([
                                'test_session_id' => $testSession->id,
                                'question_id' => $request->input('question_id'),
                                'question_option_id' => $selectedOption
                            ])->first();

                        if (!$testSessionAnswerOption) {
                            if (in_array($selectedOption, $correctOptions)) {
                                $score =  intval($testQuestion->right_mark) / count($correctOptions);
                            } else {
                                $score =  intval($testQuestion->negative_mark) / count($correctOptions);
                            }
                            $this->testSessionAnswerRepository->create([
                                'test_session_id' => $testSession->id,
                                'question_id' => $request->input('question_id'),
                                'question_option_id' => $selectedOption,
                                'score' => $score
                            ]);
                        }
                    }

                } elseif ($answer['type'] === 'true_or_false') {
                    $testQuestion = $this->testQuestionRepository
                        ->findWhere([
                            'test_id' => $testSession->test_id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    $testSessionAnswerOption = $this->testSessionAnswerRepository
                        ->findWhere([
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    if ($testSessionAnswerOption) {
                        if ((int)$answer['answer'] !== (int)$testSessionAnswerOption->question_option_id) {
                            $correctOption = $this->questionOptionRepository
                                ->findWhere([
                                    'question_id' => $request->input('question_id'),
                                    'is_correct' => 1
                                ],['id'])->first();

                            $updateData = ['question_option_id' => $answer['answer']];
                            if ((int)$correctOption->id === (int)$answer['answer']) {
                                $updateData['score'] = $testQuestion->right_mark;
                            } else {
                                $updateData['score'] = $testQuestion->negative_mark;
                            }
                            $testSessionAnswerOption->update($updateData);
                        }

                    } else {
                        $correctOption = $this->questionOptionRepository
                            ->findWhere([
                                'question_id' => $request->input('question_id'),
                                'is_correct' => 1
                            ],['id'])->first();
                        $updateData = [
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id'),
                            'question_option_id' => $answer['answer']
                        ];
                        if ((int)$correctOption->id === (int)$answer['answer']) {
                            $updateData['score'] = $testQuestion->right_mark;
                        } else {
                            $updateData['score'] = $testQuestion->negative_mark;
                        }
                        $this->testSessionAnswerRepository->create($updateData);
                    }

                } elseif ($answer['type'] === 'fill_the_blank') {
                    $testQuestion = $this->testQuestionRepository
                        ->findWhere([
                            'test_id' => $testSession->test_id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    $testSessionAnswerOption = $this->testSessionAnswerRepository
                        ->findWhere([
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    $correctOption = $this->questionOptionRepository
                        ->findWhere([
                            'question_id' => $request->input('question_id'),
                            'is_correct' => 1
                        ])->first();

                    if (strtolower(trim($answer['answer'])) == strtolower(trim($correctOption->option))) {
                        $score = $testQuestion->right_mark;
                    } else {
                        $score = $testQuestion->negative_mark;
                    }

                    if ($testSessionAnswerOption) {
                        // if the submitted answer is same as correct answer
                        // mark score and update the answer
                        $testSessionAnswerOption->update([
                            'score' => $score,
                            'answer_text' => $answer['answer']
                        ]);
                    } else {
                        $updateData = [
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id'),
                            'answer_text' => $answer['answer'],
                            'score' => $score
                        ];
                        $this->testSessionAnswerRepository->create($updateData);
                    }

                } elseif ($answer['type'] === 'match_the_column') {
                    $testSessionAnswers = $this->testSessionAnswerRepository->findWhere([
                        'test_session_id' => $testSession->id,
                        'question_id' => $request->input('question_id')
                    ]);

                    if ($testSessionAnswers->isNotEmpty()) {
                        $diff = array_diff($answer['answer'], $testSessionAnswers->pluck('answer_text')->toArray());
                        if (empty($diff)) {
                            return ; // meaning the results a still same.
                        }
                    }

                    // delete the previous answers
                    foreach ($testSessionAnswers as $testSessionAnswer) {
                        $testSessionAnswer->delete();
                    }

                    $testQuestion = $this->testQuestionRepository
                        ->findWhere([
                            'test_id' => $testSession->test_id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    // load the correct answers
                    $correctOptions = $this->questionOptionRepository
                        ->findWhere([
                            'question_id' => $request->input('question_id'),
                        ])->map(function($option) {
                            $option->main_option = $option->option.'__'.$option->option_match;
                            return $option;
                        })->pluck('main_option', 'id')->toArray();


                    foreach ($answer['answer'] as $submittedAnswer) {
                        if (in_array($submittedAnswer, $correctOptions)) {
                            $score = intval($testQuestion->right_mark) / count($correctOptions);
                        } else {
                            $score = intval($testQuestion->negative_mark) / count($correctOptions);
                        }

                        $this->testSessionAnswerRepository->create([
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id'),
                            'answer_text' => $submittedAnswer,
                            'score' => $score
                        ]);
                    }

                } elseif ($answer['type'] === 'essay') {
                    $testSessionAnswer = $this->testSessionAnswerRepository
                        ->findWhere([
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id')
                        ])->first();

                    if ($testSessionAnswer) {
                        // if the submitted answer is same as correct answer
                        // mark score and update the answer
                        $testSessionAnswer->update([
                            'answer_text' => $answer['answer']
                        ]);
                    } else {
                        $updateData = [
                            'test_session_id' => $testSession->id,
                            'question_id' => $request->input('question_id'),
                            'answer_text' => $answer['answer'],
                        ];
                        $this->testSessionAnswerRepository->create($updateData);
                    }
                }

                // save time spent
                if (!$testSession->individual_time) {
                    $individual_time = [];
                } else {
                    $individual_time = unserialize($testSession->individual_time);
                }
                if (isset($individual_time[$request->input('question_id')])) {
                    $individual_time[$request->input('question_id')] =
                        intval($individual_time[$request->input('question_id')]) + intval($request->input('time_spent'));
                } else {
                    $individual_time[$request->input('question_id')] = intval($request->input('time_spent'));
                }
                $testSession->update([
                    'individual_time' => serialize($individual_time)
                ]);
            }
        }
    }

    public function submitTest(TestSession $testSession)
    {
        // process the test and show result based on the test parameters.
        $testSession->submit();

        session()->flash('success', 'Your test was successfully submitted!.');

        return [
            'redirect_url' => route('candidate.test_reports.show_report', $testSession->id)
        ];
    }


    public function showReport(TestSession $testSession)
    {
        return view($this->_config['view']);
    }
}
