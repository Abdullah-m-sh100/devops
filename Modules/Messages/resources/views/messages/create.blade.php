<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Compose Message</h2></x-slot>
    <div class="py-8"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('messages.store') }}" class="bg-white shadow-sm sm:rounded-lg p-6 space-y-5">
            @csrf
            <div><x-input-label for="recipient_id" value="Recipient" /><select id="recipient_id" name="recipient_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">@foreach ($users as $user)<option value="{{ $user->id }}" @selected((int) old('recipient_id') === $user->id)>{{ $user->name }} ({{ $user->email }})</option>@endforeach</select><x-input-error :messages="$errors->get('recipient_id')" class="mt-2" /></div>
            <div><x-input-label for="subject" value="Subject" /><x-text-input id="subject" name="subject" class="block mt-1 w-full" value="{{ old('subject') }}" required /><x-input-error :messages="$errors->get('subject')" class="mt-2" /></div>
            <div><x-input-label for="body" value="Message" /><textarea id="body" name="body" rows="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('body') }}</textarea><x-input-error :messages="$errors->get('body')" class="mt-2" /></div>
            <div class="flex justify-end gap-3"><a href="{{ route('messages.inbox') }}" class="px-4 py-2 border rounded-md">Cancel</a><button class="px-4 py-2 bg-gray-900 text-white rounded-md">Send</button></div>
        </form>
    </div></div>
</x-app-layout>
