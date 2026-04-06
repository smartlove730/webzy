<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\Page;

/**
 * Handles the listing and display of service offerings on the website. Service
 * definitions are stored in the `services` table and can be managed via
 * the admin panel.
 */
class ServiceController extends Controller
{
    /**
     * Display a list of all services.
     */
    public function index(): View
    {
        $services = Service::orderBy('id')->paginate(6);
        // Retrieve page meta for services page
        $page = Page::where('slug', 'services')->first();
        return view('front.services.index', compact('services', 'page'));
    }

    /**
     * Show a single service by its slug.
     */
    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('front.services.show', compact('service'));
    }
}