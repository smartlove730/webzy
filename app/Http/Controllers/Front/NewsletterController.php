<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\NewsletterSubscriber;

/**
 * Handles newsletter subscription submissions. Email addresses are stored
 * in the `newsletter_subscribers` table and can be exported by admins.
 */
class NewsletterController extends Controller
{
    /**
     * Store a new newsletter subscription.
     */
    public function subscribe(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
        ]);
        // Check if already subscribed
        NewsletterSubscriber::firstOrCreate(['email' => $data['email']]);
        return back()->with('status', 'You have been subscribed to the newsletter.');
    }
}