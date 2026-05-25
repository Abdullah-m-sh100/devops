<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $company->name }}</h2></x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><dt class="text-sm text-gray-500">Tenant ID</dt><dd>{{ $company->id }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Domain</dt><dd>{{ $company->domains->first()?->domain }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Email</dt><dd>{{ $company->email ?? '-' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Phone</dt><dd>{{ $company->phone ?? '-' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Status</dt><dd>{{ ucfirst($company->status) }}</dd></div>
                </dl>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold mb-3">Subscriptions</h3>
                @forelse ($company->subscriptions as $subscription)
                    <div class="py-2 border-b last:border-b-0">
                        {{ $subscription->plan?->name }} - {{ ucfirst($subscription->status) }}
                    </div>
                @empty
                    <p class="text-gray-500">No subscriptions.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
