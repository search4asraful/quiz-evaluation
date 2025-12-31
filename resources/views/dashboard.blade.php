<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            {!! __("Welcome to <strong>Quiz Evaluation System</strong>") !!}
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
        <div class="p-6 text-gray-900">
            {{ __("You're logged in as " . ucfirst(auth()->user()->role) . '!') }}
        </div>
    </div>
</x-app-layout>
