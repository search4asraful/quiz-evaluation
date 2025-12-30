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

            @for ($i=0; $i<4; $i++)
                <div class="flex mb-2 items-center">
                    <input type="text" name="options[{{ $i }}]" placeholder="Option {{ $i+1 }}" class="border p-2 w-full" required>
                    <input type="radio" name="correct_option" value="{{ $i }}" class="ml-2">
                </div>
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

            <form method="POST" action="{{ route('admin.tests.questions.destroy', [$test,$q]) }}">
                @csrf @method('DELETE')
                <button class="text-red-600 mt-2">Delete</button>
            </form>
        </div>
    @empty
        <div class="bg-yellow-100 p-4 rounded">
            No questions added for this test yet.
        </div>
    @endforelse
</x-app-layout>
