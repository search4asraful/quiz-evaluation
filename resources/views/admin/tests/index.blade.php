<x-app-layout>
    <x-slot name="header">
        {{ __('All Tests') }}
    </x-slot>

    <a href="{{ route('admin.tests.create') }}" class="bg-blue-600 text-white px-4 py-2 mb-4 inline-block">
        + Create Test
    </a>

    @forelse($tests as $test)
        <div class="bg-white p-4 mb-4 shadow">
            <h3 class="font-bold">{{ $test->title }}</h3>
            <p>Starts: {{ $test->starts_at }} | Ends: {{ $test->ends_at }}</p>

            <div class="mt-2 space-x-2">
                <a href="{{ route('admin.tests.edit', $test) }}" class="text-blue-600">Edit</a>
                <a href="{{ route('admin.tests.questions.index', $test) }}" class="text-green-600">Manage Questions</a>
                <form action="{{ route('admin.tests.destroy', $test) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
            No tests created yet.
        </div>
    @endforelse
</x-app-layout>
