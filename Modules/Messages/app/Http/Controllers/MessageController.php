<?php

namespace Modules\Messages\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Messages\Models\Message;

class MessageController extends Controller
{
    public function inbox(Request $request)
    {
        $messages = Message::with('sender')
            ->where('recipient_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return view('messages::messages.inbox', compact('messages'));
    }

    public function sent(Request $request)
    {
        $messages = Message::with('recipient')
            ->where('sender_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return view('messages::messages.sent', compact('messages'));
    }

    public function create(Request $request)
    {
        $users = User::whereKeyNot($request->user()->id)->orderBy('name')->get();

        return view('messages::messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'recipient_id' => ['required', 'exists:users,id'],
            'subject' => ['required', 'string', 'max:191'],
            'body' => ['required', 'string'],
        ]);

        Message::create($data + ['sender_id' => $request->user()->id]);

        return redirect()->route('messages.sent')->with('status', 'Message sent successfully.');
    }

    public function show(Request $request, Message $message)
    {
        abort_unless(
            $message->sender_id === $request->user()->id || $message->recipient_id === $request->user()->id,
            403
        );

        if ($message->recipient_id === $request->user()->id && ! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('messages::messages.show', compact('message'));
    }

    public function destroy(Request $request, Message $message)
    {
        abort_unless(
            $message->sender_id === $request->user()->id || $message->recipient_id === $request->user()->id,
            403
        );

        $message->delete();

        return redirect()->route('messages.inbox')->with('status', 'Message deleted successfully.');
    }
}
