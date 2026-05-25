<form method="POST" action="{{ $action }}" class="bg-white shadow-sm sm:rounded-lg p-6 space-y-5">
    @csrf
    @if ($method !== 'POST') @method($method) @endif
    <div><x-input-label for="name" value="Name" /><x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name', $plan?->name) }}" required /><x-input-error :messages="$errors->get('name')" class="mt-2" /></div>
    <div><x-input-label for="price" value="Price" /><x-text-input id="price" name="price" type="number" step="0.01" class="block mt-1 w-full" value="{{ old('price', $plan?->price ?? 0) }}" required /></div>
    <div><x-input-label for="billing_period" value="Billing Period" /><select id="billing_period" name="billing_period" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"><option value="monthly" @selected(old('billing_period', $plan?->billing_period ?? 'monthly') === 'monthly')>Monthly</option><option value="yearly" @selected(old('billing_period', $plan?->billing_period) === 'yearly')>Yearly</option></select></div>
    <div><x-input-label for="max_users" value="Max Users" /><x-text-input id="max_users" name="max_users" type="number" class="block mt-1 w-full" value="{{ old('max_users', $plan?->max_users ?? 10) }}" required /></div>
    <div><x-input-label for="max_messages" value="Max Messages" /><x-text-input id="max_messages" name="max_messages" type="number" class="block mt-1 w-full" value="{{ old('max_messages', $plan?->max_messages ?? 1000) }}" required /></div>
    <label class="flex gap-2 items-center"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $plan?->is_active ?? true))> Active</label>
    <div class="flex justify-end gap-3"><a href="{{ route('plans.index') }}" class="px-4 py-2 border rounded-md">Cancel</a><button class="px-4 py-2 bg-gray-900 text-white rounded-md">Save</button></div>
</form>
