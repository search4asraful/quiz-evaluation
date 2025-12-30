<x-app-layout>
    <x-slot name="header">{{ __('Exam Result') }}</x-slot>

    <div class="bg-white p-6 shadow rounded">
        <p class="text-xl"><strong class="underline underline-offset-3">Test:</strong> {{ $submission->test->title }}</p>
        <p><strong>Total Marks:</strong> {{ $submission->total_marks }}</p>
        <p><strong>Obtained Marks:</strong> {{ $submission->obtained_marks }}</p>

        <h3 class="mt-4 font-semibold text-xl underline underline-offset-3">Answers:</h3>
        @forelse($submission->answers as $ans)
            <div class="border-b py-2">
                <p><strong>Question:</strong> {{ $ans->question->question_text }}</p>
                <p><strong>Your Answer:</strong> {{ $ans->option->option_text ?? 'N/A' }}</p>
                <p><strong>Status:</strong>
                    <span>
                        @if($ans->is_correct)
                            <span class="text-green-600 font-semibold">Correct</span>
                        @else
                            <span class="text-red-600 font-semibold">Incorrect</span>
                        @endif
                    </span>
                </p>
            </div>
        @empty
            <p>No answers found.</p>
        @endforelse
    </div>
</x-app-layout>
