<x-app-layout>
    <x-slot name="header">{{ __('Result of ' . $submission->test->title) }}</x-slot>

    <div class="bg-white p-6 shadow rounded">
        <p><strong>Total Marks:</strong> {{ $submission->total_marks }}</p>
        <p><strong>Obtained Marks:</strong> {{ $submission->obtained_marks }}</p>
        <p><strong>Total Questions:</strong> {{ $submission->test->questions->count() }}</p>
        <p><strong>Submitted by:</strong>
            {{ auth()->user()->id === $submission->user_id ? 'You' : $submission->submittedBy->name }}</p>
        <p><strong>Submitted at:</strong> {{ $submission->created_at->toDayDateTimeString() }}</p>

        <h3 class="mt-4 font-semibold text-xl underline underline-offset-3">Answers:</h3>
        @forelse($submission->answers->groupBy('question_id') as $answers)
            <div class="border-b py-3">
                <p class="font-semibold">
                    {{ $answers->first()->question->question_text }}
                </p>
                <p><strong>Mark:</strong> {{ $answers->first()->question->marks }}</p>

                <p><strong>Your Answer(s):</strong></p>
                <ul class="ml-4 list-disc">
                    @foreach ($answers as $ans)
                        <li>{{ $ans->option->option_text }}</li>
                    @endforeach
                </ul>

                <p class="mt-1">
                    Status:
                    <span class="{{ $answers->first()->is_correct ? 'text-green-600' : 'text-red-600' }}">
                        {{ $answers->first()->is_correct ? 'Correct' : 'Incorrect' }}
                    </span>
                </p>
            </div>
        @empty
            <p>No answers found.</p>
        @endforelse
    </div>
</x-app-layout>
