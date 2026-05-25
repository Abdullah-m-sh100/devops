<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
            <a href="{{ route('companies.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-md">New Company</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domain</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subscription</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($companies as $company)
                            <tr>
                                <td class="px-6 py-4">{{ $company->name }}</td>
                                <td class="px-6 py-4">{{ $company->domains->first()?->domain }}</td>
                                <td class="px-6 py-4">{{ ucfirst($company->status) }}</td>
                                <td class="px-6 py-4">{{ $company->activeSubscription?->plan?->name ?? 'None' }}</td>
                                <td class="px-6 py-4 text-right space-x-3">
                                    <a class="text-indigo-600" href="{{ route('companies.show', $company) }}">View</a>
                                    <a class="text-indigo-600" href="{{ route('companies.edit', $company) }}">Edit</a>
                                    <form class="inline" method="POST" action="{{ route('companies.destroy', $company) }}" onsubmit="return confirm('Delete this company and tenant database?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No companies yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $companies->links() }}</div>
        </div>
    </div>
</x-app-layout>
