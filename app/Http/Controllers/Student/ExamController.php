<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Option;
use App\Models\Submission;
use App\Models\Test;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $now = now();

        $tests = Test::where('starts_at','<=',$now)
            ->where('ends_at','>=',$now)
            ->get();

        return view('student.tests.index', compact('tests'));
    }

    public function show(Test $test)
    {
        if ($test->submissions()
            ->where('user_id', auth('web')->id())
            ->exists()) {

            return redirect()
                ->route('student.tests.index')
                ->with('error','You already submitted this test');
        }

        $test->load('questions.options');

        return view('student.exam', compact('test'));
    }

    public function submit(Request $request, Test $test)
    {
        $userId = auth('web')->id();

        if (Submission::where('test_id',$test->id)
            ->where('user_id',$userId)
            ->exists()) {

            return redirect()->route('student.tests.index')
                ->with('error','Test already submitted');
        }

        $totalMarks = $test->questions->sum('marks');
        $obtainedMarks = 0;

        $submission = Submission::create([
            'test_id' => $test->id,
            'user_id' => $userId,
            'total_marks' => $totalMarks,
            'obtained_marks' => 0,
        ]);

        foreach ($test->questions as $question) {
            $optionId = $request->answers[$question->id] ?? null;
            if (!$optionId) continue;

            $option = Option::find($optionId);
            $isCorrect = $option && $option->is_correct;

            if ($isCorrect) {
                $obtainedMarks += $question->marks;
            }

            Answer::create([
                'submission_id' => $submission->id,
                'question_id' => $question->id,
                'option_id' => $optionId,
                'is_correct' => $isCorrect,
            ]);
        }

        $submission->update(['obtained_marks'=>$obtainedMarks]);

        return redirect()->route('student.tests.result',$submission);
    }

    public function result(Submission $submission)
    {
        return view('student.tests.result', compact('submission'));
    }
}
