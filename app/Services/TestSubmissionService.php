<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Submission;
use App\Models\Test;
use Illuminate\Http\Request;

class TestSubmissionService
{
    /**
     * Submit test answers.
     *
     * @param Request $request
     * @param Test $test
     * @param int $userId
     * @return Submission
     */
    public function submit(Request $request, Test $test, int $userId): ?Submission
    {
        // Prevent duplicate submissions
        if (Submission::where('test_id', $test->id)->where('user_id', $userId)->exists()) {
            return null; // Controller will handle redirect / error
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
            $selectedOptionIds = $request->answers[$question->id] ?? [];

            $correctOptionIds = $question->options()
                ->where('is_correct', true)
                ->pluck('id')
                ->sort()
                ->values();

            $selectedOptionIds = collect($selectedOptionIds)
                ->sort()
                ->values();

            // Check if all selected options match exactly with correct options
            $isCorrect = $selectedOptionIds->count() &&
                $selectedOptionIds->diff($correctOptionIds)->isEmpty() &&
                $correctOptionIds->diff($selectedOptionIds)->isEmpty();

            if ($isCorrect) {
                $obtainedMarks += $question->marks;
            }

            // Save each selected option
            foreach ($selectedOptionIds as $optionId) {
                Answer::create([
                    'submission_id' => $submission->id,
                    'question_id' => $question->id,
                    'option_id' => $optionId,
                    'is_correct' => $isCorrect
                ]);
            }
        }

        $submission->update(['obtained_marks' => $obtainedMarks]);

        return $submission;
    }
}
