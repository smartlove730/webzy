<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Page;
use App\Models\ContactMessage;
use App\Models\Setting;

/**
 * Presents the contact form and processes submissions. Validated contact
 * messages are stored in the `contact_messages` table and can be viewed
 * by administrators in the CMS.
 */
class ContactController extends Controller
{
    /**
     * Display the contact page and form.
     */
    public function index(): View
    {
        // Fetch the contact page
        $page = Page::where('slug', 'contact-us')->first();
        // Load contact details from settings
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('front.contact', compact('page', 'settings'));
    }

    /**
     * Handle form submission.
     */
    public function submit(Request $request): View
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);
        $data['is_read'] = false;
        ContactMessage::create($data);
        // Prepare page and settings for re-rendering contact page
        $page = Page::where('slug', 'contact-us')->first();
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('front.contact', [
            'page' => $page,
            'settings' => $settings,
            'status' => 'Thank you for contacting us! We will respond shortly.',
        ]);
    }
}