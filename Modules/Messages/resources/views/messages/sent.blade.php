<x-app-layout>
    <x-slot name="header"><div class="flex items-center justify-between"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Sent</h2><a href="{{ route('messages.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-md">Compose</a></div></x-slot>
    <div class="py-8"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>@endif
        <div class="mb-4 space-x-4"><a class="text-indigo-600" href="{{ route('messages.inbox') }}">Inbox</a><a class="text-indigo-600" href="{{ route('messages.sent') }}">Sent</a></div>
        @include('messages::messages.list', ['messages' => $messages, 'mode' => 'sent'])
    </div></div>
</x-app-layout>
