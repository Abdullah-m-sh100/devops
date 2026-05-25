<form method="POST" action="{{ $action }}" class="bg-white shadow-sm sm:rounded-lg p-6 space-y-5">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <x-input-label for="name" value="Company Name" />
        <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name', $company?->name) }}" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="domain" value="Domain" />
        <x-text-input id="domain" name="domain" class="block mt-1 w-full" value="{{ old('domain', $company?->domains?->first()?->domain) }}" placeholder="company.localhost" required />
        <x-input-error :messages="$errors->get('domain')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" value="{{ old('email', $company?->email) }}" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone" value="Phone" />
        <x-text-input id="phone" name="phone" class="block mt-1 w-full" value="{{ old('phone', $company?->phone) }}" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="status" value="Status" />
        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <option value="active" @selected(old('status', $company?->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $company?->status) === 'inactive')>Inactive</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('companies.index') }}" class="px-4 py-2 border rounded-md">Cancel</a>
        <button class="px-4 py-2 bg-gray-900 text-white rounded-md">Save</button>
    </div>
</form>
