<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Page;
use App\Models\Section;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\BlogPost;

/**
 * Controller responsible for rendering the public home page and assembling
 * the necessary dynamic data from the CMS. All content displayed on the
 * home page is fetched from the database allowing for full customization
 * through the admin panel.
 */
class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        // Fetch the home page record
        $page = Page::where('slug', 'home')->firstOrFail();
        // Retrieve ordered sections for the home page
        $sections = Section::where('page_id', $page->id)->orderBy('order')->get()->keyBy('identifier');
        // Fetch a subset of services, portfolio items and blog posts to feature
        $services = Service::orderBy('id')->limit(3)->get();
        $projects = Portfolio::orderBy('project_date', 'desc')->limit(3)->get();
        $posts = BlogPost::where('is_published', true)->orderBy('published_at', 'desc')->limit(3)->get();
        return view('front.home', [
            'page' => $page,
            'sections' => $sections,
            'services' => $services,
            'projects' => $projects,
            'posts' => $posts,
        ]);
    }
}
