<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $message->subject }}</h2></x-slot>
    <div class="py-8"><div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
            <div class="text-sm text-gray-600">
                <div>From: {{ $message->sender?->name }} &lt;{{ $message->sender?->email }}&gt;</div>
                <div>To: {{ $message->recipient?->name }} &lt;{{ $message->recipient?->email }}&gt;</div>
                <div>Date: {{ $message->created_at->format('Y-m-d H:i') }}</div>
            </div>
            <div class="prose max-w-none whitespace-pre-wrap">{{ $message->body }}</div>
            <div class="flex justify-between">
                <a href="{{ route('messages.inbox') }}" class="px-4 py-2 border rounded-md">Back</a>
                <form method="POST" action="{{ route('messages.destroy', $message) }}">@csrf @method('DELETE')<button class="px-4 py-2 bg-red-600 text-white rounded-md">Delete</button></form>
            </div>
        </div>
    </div></div>
</x-app-layout>
