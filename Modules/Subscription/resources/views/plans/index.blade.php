<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Plans</h2>
            <a href="{{ route('plans.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-md">New Plan</a>
        </div>
    </x-slot>
    <div class="py-8"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>@endif
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead><tr class="bg-gray-50"><th class="px-6 py-3 text-left">Name</th><th class="px-6 py-3 text-left">Price</th><th class="px-6 py-3 text-left">Limits</th><th class="px-6 py-3"></th></tr></thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($plans as $plan)
                        <tr>
                            <td class="px-6 py-4">{{ $plan->name }}</td>
                            <td class="px-6 py-4">${{ $plan->price }} / {{ $plan->billing_period }}</td>
                            <td class="px-6 py-4">{{ $plan->max_users }} users, {{ $plan->max_messages }} messages</td>
                            <td class="px-6 py-4 text-right">
                                <a class="text-indigo-600" href="{{ route('plans.edit', $plan) }}">Edit</a>
                                <form class="inline ml-3" method="POST" action="{{ route('plans.destroy', $plan) }}">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">No plans yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $plans->links() }}</div>
    </div></div>
</x-app-layout>
