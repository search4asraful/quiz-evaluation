<x-app-layout>
    <x-slot name="header">{{ __('Available Tests') }}</x-slot>

    @forelse($tests as $test)
        @php
            $submitted = $test
                ->submissions()
                ->where('user_id', auth()->id())
                ->exists();
        @endphp

        <div class="bg-white p-4 mb-4 shadow rounded relative">
            <h2 class="font-bold text-xl">{{ $test->title }}</h2>
            <p class="text-sm"><strong>Ends at:</strong>
                {{ \Carbon\Carbon::parse($test->ends_at)->toDayDateTimeString() }}</p>

            <p class="mt-2"><strong>Description:</strong> {{ $test->description }}</p>
            <p class="mt-2"><strong>Created by:</strong> {{ $test->creator->name }}</p>
            <div class="mt-2">
                <strong>Status: </strong>
                @if ($test->ongoing())
                    <span class="text-green-600 font-semibold">Ongoing</span>
                @elseif($test->expired())
                    <span class="text-red-600 font-semibold">Expired</span>
                @else
                    <span class="text-red-600 font-semibold">Ongoing</span>
                @endif
                @if ($submitted)
                    <a href="{{ route('student.tests.result', $test) }}"
                        class="text-green-600 absolute top-5 right-5 border px-4 py-2 rounded bg-green-100 hover:bg-green-200">View
                        Result</a>
                @else
                    @if ($test->expired())
                        <span class="text-gray-600 absolute top-5 right-5 border px-4 py-2 rounded bg-gray-100">Test
                            Expired</span>
                    @else
                        <a href="{{ route('student.tests.show', $test) }}"
                            class="text-blue-600 absolute top-5 right-5 border px-4 py-2 rounded bg-blue-100 hover:bg-blue-200">Take
                            Test</a>
                    @endif
                @endif
            </div>
        </div>
    @empty
        <div class="bg-yellow-100 p-4 rounded">
            No active tests available at the moment.
        </div>
    @endforelse
</x-app-layout>
