<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query()->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(20);
        
        // Get counts for stats
        $stats = [
            'total' => ContactMessage::count(),
            'new' => ContactMessage::where('status', 'new')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
        ];

        return view('admin.contact-messages.index', compact('messages', 'stats'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contactMessage)
    {
        // Mark as read if it's new
        if ($contactMessage->isNew()) {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Update the specified contact message.
     */
    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,read,replied,archived'],
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        // If status is being changed to replied, update replied_at
        if ($validated['status'] === 'replied' && $contactMessage->status !== 'replied') {
            $validated['replied_at'] = now();
        }

        $contactMessage->update($validated);

        return redirect()
            ->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'Message updated successfully!');
    }

    /**
     * Remove the specified contact message.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully!');
    }

    /**
     * Mark message as replied.
     */
    public function markAsReplied(ContactMessage $contactMessage)
    {
        $contactMessage->markAsReplied();

        return back()->with('success', 'Message marked as replied!');
    }

    /**
     * Archive message.
     */
    public function archive(ContactMessage $contactMessage)
    {
        $contactMessage->update(['status' => 'archived']);

        return back()->with('success', 'Message archived!');
    }
}
