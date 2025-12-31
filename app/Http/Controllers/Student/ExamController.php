<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Submission;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Services\TestSubmissionService;

class ExamController extends Controller
{
    /**
        * Display list of available tests.
    */
    public function index()
    {
        $now = now();
        $tests = Test::orderBy('starts_at', 'desc')->get();

        return view('student.tests.index', compact('tests', 'now'));
    }

    /**
        * Show the test for taking.
    */
    public function show(Test $test)
    {
        if ($test->submissions()
            ->where('user_id', auth('web')->id())
            ->exists()
        ) {
            notyf()->error('You already submitted this test');
            return redirect()->route('student.tests.index');
        } else if ($test->expired()) {
            notyf()->error('This test has expired');
            return redirect()->route('student.tests.index');
        } else if ($test->ongoing()) {
            $test->load('questions.options');
            return view('student.exam', compact('test'));
        } else {
            notyf()->info('This test has not started yet');
            return redirect()->route('student.tests.index');
        }
    }

    /**
        * Submit test answers.
    */
    public function submit(Request $request, Test $test, TestSubmissionService $service)
    {
        $userId = auth('web')->id();

        try {
            $submission = $service->submit($request, $test, $userId);
        } catch (\Exception $e) {
            notyf()->error('An error occurred while submitting the test');
            return redirect()->route('student.tests.index');
        }

        if (!$submission) {
            notyf()->error('You have already submitted this test');
            return redirect()->route('student.tests.index');
        }

        notyf()->success('Test submitted successfully');
        return redirect()->route('student.tests.result', $submission);
    }

    /**
        * Display result based on submissions.
    */
    public function result(Submission $submission)
    {
        return view('student.tests.result', compact('submission'));
    }
}
