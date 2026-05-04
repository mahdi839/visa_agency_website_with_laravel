<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MessageThread;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MessageThreadController extends Controller
{
    public function index(Request $request)
    {
        $query = MessageThread::with(['customer', 'messages' => fn ($q) => $q->latest()->limit(1)])
            ->withCount(['messages as customer_unread_count' => fn ($q) => $q->where('is_admin', false)->whereNull('read_at')]);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                    ->orWhereHas('customer', fn ($customer) => $customer
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $threads = $query->latest('last_message_at')->latest()->paginate(12)->withQueryString();

        return view('admin_dashboard.messages.index', compact('threads'));
    }

    public function show(MessageThread $messageThread)
    {
        $messageThread->load(['customer', 'messages.sender']);
        $messageThread->messages()
            ->where('is_admin', false)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('admin_dashboard.messages.show', compact('messageThread'));
    }

    public function update(Request $request, MessageThread $messageThread)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(MessageThread::STATUSES))],
        ]);

        $messageThread->update($validated);

        return back()->with('success', 'Message status has been updated.');
    }

    public function reply(Request $request, MessageThread $messageThread)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:5000'],
        ]);

        $messageThread->messages()->create([
            'sender_id' => $request->user()->id,
            'body' => $validated['body'],
            'is_admin' => true,
        ]);

        $messageThread->update([
            'status' => 'open',
            'last_message_at' => now(),
        ]);

        return back()->with('success', 'Reply has been sent.');
    }

    public function destroy(MessageThread $messageThread)
    {
        $messageThread->delete();

        return redirect()->route('dashboard.messages.index')
            ->with('success', 'Message thread has been deleted.');
    }
}
