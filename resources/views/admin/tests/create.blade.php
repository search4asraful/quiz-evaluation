<x-app-layout>
    <x-slot name="header">
        {{ __('Create Test') }}
    </x-slot>

    <form method="POST" action="{{ route('admin.tests.store') }}" class="bg-white p-6 shadow rounded">
        @csrf

        <label class="block mb-2">Test Title</label>
        <input type="text" name="title" class="border p-2 w-full mb-4" required>
        {{-- show input error --}}
        @error('title')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <label class="block mb-2">Start Date</label>
        <input type="datetime-local" name="starts_at" class="border p-2 w-full mb-4" required>
        {{-- show input error --}}
        @error('starts_at')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <label class="block mb-2">End Date</label>
        <input type="datetime-local" name="ends_at" class="border p-2 w-full mb-4" required>
        {{-- show input error --}}
        @error('ends_at')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <button class="bg-green-600 text-white px-4 py-2">Create Test</button>
    </form>
</x-app-layout>
