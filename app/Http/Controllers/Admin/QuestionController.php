<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Option;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of questions for a specific test.
     */
    public function index(Test $test)
    {
        $questions = $test->questions()->with('options')->get();
        return view('admin.questions.index', compact('test','questions'));
    }

    /**
     * Store a newly created question in storage.
     */
    public function store(QuestionStoreRequest $request, Test $test)
    {
        $question = $test->questions()->create([
            'question_text' => $request->question_text,
            'marks' => $request->marks,
        ]);

        foreach ($request->options as $index => $option) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $option['text'],
                'is_correct' => in_array($index, $request->correct_options)
            ]);
        }

        notyf()->success('Question added successfully');
        return back();
    }

    /**
     * Show the form for editing the specified question.
     */
    public function edit(Test $test, Question $question)
    {
        $question->load('options');

        return view('admin.questions.edit', compact('test', 'question'));
    }

    /**
     * Update the specified question in storage.
     */
    public function update(Request $request, Test $test, Question $question)
    {
        $request->validate([
            'question_text' => 'required',
            'marks' => 'required|integer|min:1',
            'options.*.text' => 'required',
            'correct_options' => 'required|array|min:1'
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'marks' => $request->marks,
        ]);

        foreach ($question->options as $index => $option) {
            $option->update([
                'option_text' => $request->options[$index]['text'],
                'is_correct' => in_array($index, $request->correct_options),
            ]);
        }

        notyf()->success('Question updated successfully');
        return redirect()->route('admin.tests.questions.index', $test);
    }

    /**
     * Remove the specified question from storage.
     */
    public function destroy(Question $question)
    {
        $question->options()->delete();
        $question->delete();

        notyf()->success('Question deleted successfully');
        return back();
    }
}
