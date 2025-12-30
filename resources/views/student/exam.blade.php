<x-app-layout>
    <x-slot name="header">{{ __('MCQ Exam: ') . $test->title }}</x-slot>

    <form method="POST" action="{{ route('student.tests.submit', $test) }}">
        @csrf

        @forelse($test->questions as $q)
            <div class="bg-white p-4 mb-4 shadow">
                <p class="font-semibold">{{ $q->question_text }} ({{ $q->marks }} marks)</p>

                @if($q->options->isEmpty())
                    <p class="text-red-600">No options available for this question.</p>
                @else
                    @foreach($q->options as $opt)
                        <label class="block">
                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opt->id }}">
                            {{ $opt->option_text ?? 'Option missing' }}
                        </label>
                    @endforeach
                @endif
            </div>
        @empty
            <div class="bg-yellow-100 p-4 rounded">No questions available for this test.</div>
        @endforelse

        @if($test->questions->isNotEmpty())
            <button class="bg-green-600 text-white px-4 py-2">Submit Exam</button>
        @endif
    </form>
</x-app-layout>
