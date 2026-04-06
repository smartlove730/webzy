<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Administrative dashboard. Presents an overview of the site including
 * statistics such as number of pages, services, portfolio items and blog
 * posts. Additional widgets can be added to give administrators quick
 * access to important metrics.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        // Collect basic metrics for dashboard widgets
        $metrics = [
            'pages' => \App\Models\Page::count(),
            'services' => \App\Models\Service::count(),
            'portfolio' => \App\Models\Portfolio::count(),
            'blogPosts' => \App\Models\BlogPost::count(),
            'subscribers' => \App\Models\NewsletterSubscriber::count(),
            'contacts' => \App\Models\ContactMessage::count(),
        ];
        return view('admin.dashboard', compact('metrics'));
    }
}