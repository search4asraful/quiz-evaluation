<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Question') }}
    </x-slot>

    <div class="bg-white p-6 shadow max-w-3xl mx-auto">
        <form method="POST" action="{{ route('admin.tests.questions.update', [$test, $question]) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-semibold block mb-1">Question</label>
                <input type="text" name="question_text" value="{{ old('question_text', $question->question_text) }}"
                    class="border p-2 w-full" required>
            </div>

            <div class="mb-4">
                <label class="font-semibold block mb-1">Marks</label>
                <input type="number" name="marks" value="{{ old('marks', $question->marks) }}"
                    class="border p-2 w-full" required>
            </div>

            <label class="font-semibold block mb-2">Options (tick all correct)</label>

            @foreach ($question->options as $i => $opt)
                <div class="flex items-center mb-2">
                    <input type="text" name="options[{{ $i }}][text]"
                        value="{{ old("options.$i.text", $opt->option_text) }}" class="border p-2 w-full" required>

                    <input type="checkbox" name="correct_options[]" value="{{ $i }}" class="ml-2"
                        {{ $opt->is_correct ? 'checked' : '' }}>
                </div>
            @endforeach

            @error('correct_options')
                <p class="text-red-600 mb-3">{{ $message }}</p>
            @enderror

            <div class="mt-4">
                <button class="bg-green-600 text-white px-4 py-2">
                    Update Question
                </button>

                <a href="{{ route('admin.tests.questions.index', $test) }}" class="ml-3 text-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
