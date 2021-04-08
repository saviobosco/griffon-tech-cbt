<?php


namespace GriffonTech\Candidate\Http\Controllers;


class TestSessionsController extends Controller
{

    public function inProgress($testSession)
    {
        // test sessions
        return view('candidate::candidate.test_templates.jamb_template');
    }

}
