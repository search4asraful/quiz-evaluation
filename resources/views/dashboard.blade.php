<x-app-layout>
    <x-slot name="header">
        @if (auth()->user()->role === 'admin')
            {{ __('Dashboard') }}
        @elseif(auth()->user()->role === 'student')
            {{ __('Available Tests') }}
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as " . ucfirst(auth()->user()->role)."!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
