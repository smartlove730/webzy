<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\ContactMessage;

/**
 * Allows administrators to view and manage contact form submissions. They
 * can review the message details, mark them as read or delete them.
 */
class ContactMessageController extends Controller
{
    public function index(): View
    {
        // Fetch all contact messages
        $messages = ContactMessage::latest()->paginate(30);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show(int $id): View
    {
        $message = ContactMessage::findOrFail($id);
        // Mark as read if not already
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        return view('admin.contacts.show', compact('message'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted successfully.');
    }
}