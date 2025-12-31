<x-app-layout>
    <x-slot name="header">
        {{ __('Questions for: ') . $test->title }}
    </x-slot>

    <a href="#" onclick="document.getElementById('create-form').classList.toggle('hidden');" class="bg-blue-600 text-white px-4 py-2 mb-4 inline-block">
        + Add Question
    </a>

    {{-- Create Question Form --}}
    <div id="create-form" class="hidden bg-gray-50 p-4 mb-4 shadow">
        <form method="POST" action="{{ route('admin.tests.questions.store', $test) }}">
            @csrf

            <input type="text" name="question_text" placeholder="Question Text" class="border p-2 w-full mb-2" required>
            <input type="number" name="marks" placeholder="Marks" class="border p-2 w-full mb-2" required>

            @for ($i = 0; $i < 4; $i++)
                <div class="flex items-center mb-2">
                    <input type="text"
                        name="options[{{ $i }}][text]"
                        class="border p-2 w-full"
                        placeholder="Option {{ $i + 1 }}"
                        required>

                    <input type="checkbox"
                        name="correct_options[]"
                        value="{{ $i }}"
                        class="ml-2">
                </div>
                {{-- show input error --}}
                @error('options.' . $i . '.text')
                    <div class="text-red-600 mb-4">{{ $message }}</div>
                @enderror
            @endfor

            <button class="bg-green-600 text-white px-4 py-2 mt-2">Save Question</button>
        </form>
    </div>

    {{-- Existing Questions --}}
    @forelse($questions as $q)
        <div class="bg-white p-4 mb-4 shadow">
            <p class="font-semibold">{{ $q->question_text }} ({{ $q->marks }} marks)</p>
            <ul class="mt-1 ml-4 list-disc">
                @foreach($q->options as $opt)
                    <li class="{{ $opt->is_correct ? 'text-green-600 font-semibold' : '' }}">
                        {{ $opt->option_text }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-2 space-x-3">
                <a href="{{ route('admin.tests.questions.edit', [$test, $q]) }}"
                class="text-blue-600">
                    Edit
                </a>

                <form method="POST"
                    action="{{ route('admin.tests.questions.destroy', [$test,$q]) }}"
                    class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-yellow-100 p-4 rounded">
            No questions added for this test yet.
        </div>
    @endforelse
</x-app-layout>
