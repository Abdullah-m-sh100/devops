<div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead><tr class="bg-gray-50"><th class="px-6 py-3 text-left">{{ $mode === 'sent' ? 'To' : 'From' }}</th><th class="px-6 py-3 text-left">Subject</th><th class="px-6 py-3 text-left">Date</th><th class="px-6 py-3"></th></tr></thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($messages as $message)
                <tr class="{{ $mode === 'inbox' && ! $message->read_at ? 'font-semibold' : '' }}">
                    <td class="px-6 py-4">{{ $mode === 'sent' ? $message->recipient?->name : $message->sender?->name }}</td>
                    <td class="px-6 py-4"><a class="text-indigo-600" href="{{ route('messages.show', $message) }}">{{ $message->subject }}</a></td>
                    <td class="px-6 py-4">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-6 py-4 text-right">
                        <form method="POST" action="{{ route('messages.destroy', $message) }}">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-8 text-center text-gray-500">No messages.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $messages->links() }}</div>
