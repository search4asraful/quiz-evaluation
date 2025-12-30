<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Test $test)
    {
        $questions = $test->questions()->with('options')->get();
        return view('admin.questions.index', compact('test','questions'));
    }

    public function store(Request $request, Test $test)
    {
        $request->validate([
            'question_text' => 'required',
            'marks' => 'required|integer|min:1',
            'options.*' => 'required',
            'correct_option' => 'required'
        ]);

        $question = Question::create([
            'test_id' => $test->id,
            'question_text' => $request->question_text,
            'marks' => $request->marks,
        ]);

        foreach ($request->options as $index => $text) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $text,
                'is_correct' => $request->correct_option == $index,
            ]);
        }

        return back()->with('success', 'Question added');
    }

    public function destroy(Test $test, Question $question)
    {
        $question->options()->delete();
        $question->delete();

        return back()->with('success', 'Question deleted');
    }
}
