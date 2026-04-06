<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\NewsletterSubscriber;

/**
 * Displays newsletter subscribers and allows administrators to remove
 * subscribers from the list or export the list for marketing campaigns.
 */
class SubscriberController extends Controller
{
    public function index(): View
    {
        // Retrieve the list of newsletter subscribers
        $subscribers = NewsletterSubscriber::latest()->paginate(30);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();
        return redirect()->route('admin.subscribers.index')->with('success', 'Subscriber removed successfully.');
    }
}