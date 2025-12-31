<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Test') }}
    </x-slot>

    <div class="bg-white p-6 shadow rounded max-w-lg mx-auto">
        <form method="POST" action="{{ route('admin.tests.update', $test) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Test Title</label>
                <input type="text" name="title" value="{{ old('title', $test->title) }}" class="border p-2 w-full"
                    required>
                {{-- show input error --}}
                @error('title')
                    <div class="text-red-600 mb-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Start Date & Time</label>
                <input type="datetime-local" name="starts_at"
                    value="{{ old('starts_at', \Carbon\Carbon::parse($test->starts_at)->format('Y-m-d\TH:i')) }}"
                    class="border p-2 w-full" required>
                {{-- show input error --}}
                @error('starts_at')
                    <div class="text-red-600 mb-4">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">End Date & Time</label>
                <input type="datetime-local" name="ends_at"
                    value="{{ old('ends_at', \Carbon\Carbon::parse($test->ends_at)->format('Y-m-d\TH:i')) }}"
                    class="border p-2 w-full" required>
                {{-- show input error --}}
                @error('ends_at')
                    <div class="text-red-600 mb-4">{{ $message }}</div>
                @enderror
            </div>

            <button class="bg-green-600 text-white px-4 py-2">Update Test</button>
        </form>
    </div>
</x-app-layout>
