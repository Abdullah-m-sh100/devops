<form method="POST" action="{{ $action }}" class="bg-white shadow-sm sm:rounded-lg p-6 space-y-5">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div><x-input-label for="tenant_id" value="Company" /><select id="tenant_id" name="tenant_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">@foreach ($companies as $company)<option value="{{ $company->id }}" @selected(old('tenant_id', $subscription?->tenant_id) === $company->id)>{{ $company->name }}</option>@endforeach</select></div>
    <div><x-input-label for="plan_id" value="Plan" /><select id="plan_id" name="plan_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">@foreach ($plans as $plan)<option value="{{ $plan->id }}" @selected((int) old('plan_id', $subscription?->plan_id) === $plan->id)>{{ $plan->name }}</option>@endforeach</select></div>
    <div><x-input-label for="status" value="Status" /><select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">@foreach (['active', 'trialing', 'past_due', 'canceled'] as $status)<option value="{{ $status }}" @selected(old('status', $subscription?->status ?? 'active') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>@endforeach</select></div>
    <div><x-input-label for="starts_at" value="Starts At" /><x-text-input id="starts_at" name="starts_at" type="date" class="block mt-1 w-full" value="{{ old('starts_at', optional($subscription?->starts_at)->format('Y-m-d')) }}" /></div>
    <div><x-input-label for="ends_at" value="Ends At" /><x-text-input id="ends_at" name="ends_at" type="date" class="block mt-1 w-full" value="{{ old('ends_at', optional($subscription?->ends_at)->format('Y-m-d')) }}" /></div>
    <div class="flex justify-end gap-3"><a href="{{ route('subscriptions.index') }}" class="px-4 py-2 border rounded-md">Cancel</a><button class="px-4 py-2 bg-gray-900 text-white rounded-md">Save</button></div>
</form>
