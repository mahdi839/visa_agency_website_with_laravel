<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\MessageThread;
use Illuminate\Http\Request;

class MessageThreadController extends Controller
{
    public function index(Request $request)
    {
        $threads = $request->user()->messageThreads()
            ->with(['messages' => fn ($q) => $q->latest()->limit(1)])
            ->withCount(['messages as admin_unread_count' => fn ($q) => $q->where('is_admin', true)->whereNull('read_at')])
            ->latest('last_message_at')
            ->latest()
            ->paginate(10);

        return view('portal.messages.index', compact('threads'));
    }

    public function create()
    {
        return view('portal.messages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $thread = $request->user()->messageThreads()->create([
            'subject' => $validated['subject'],
            'status' => 'open',
            'last_message_at' => now(),
        ]);

        $thread->messages()->create([
            'sender_id' => $request->user()->id,
            'body' => $validated['body'],
            'is_admin' => false,
        ]);

        return redirect()->route('portal.messages.show', $thread)
            ->with('success', 'Your message has been sent.');
    }

    public function show(Request $request, MessageThread $messageThread)
    {
        abort_unless($messageThread->user_id === $request->user()->id, 404);

        $messageThread->load('messages.sender');
        $messageThread->messages()
            ->where('is_admin', true)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('portal.messages.show', compact('messageThread'));
    }

    public function reply(Request $request, MessageThread $messageThread)
    {
        abort_unless($messageThread->user_id === $request->user()->id, 404);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $messageThread->messages()->create([
            'sender_id' => $request->user()->id,
            'body' => $validated['body'],
            'is_admin' => false,
        ]);

        $messageThread->update([
            'status' => 'open',
            'last_message_at' => now(),
        ]);

        return back()->with('success', 'Your reply has been sent.');
    }
}
