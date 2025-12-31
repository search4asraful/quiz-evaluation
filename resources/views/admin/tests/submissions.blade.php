<x-app-layout>
    <x-slot name="header">
        {{ __('All Submissions') }}
    </x-slot>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Test Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Marks Obtained
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Submitted By
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Submitted At
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($submissions as $submission)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                            {{ ucfirst($submission->test->title) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                            {{ ucfirst($submission->total_marks) }} / {{ ucfirst($submission->obtained_marks) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $submission->submittedBy->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $submission->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4 text-sm text-right space-x-3">
                            <a href="{{ route('admin.tests.result', $submission) }}"
                                class="text-blue-600 hover:text-blue-800 font-medium">
                                View Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center">
                            <span
                                class="inline-block text-yellow-800 text-sm font-medium">
                                No Response/submissions yet.
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>
