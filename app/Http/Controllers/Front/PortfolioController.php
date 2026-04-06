<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Portfolio;
use App\Models\Page;

/**
 * Controller responsible for listing and showing portfolio projects. Each
 * project showcases a completed case study or previous client engagement.
 */
class PortfolioController extends Controller
{
    /**
     * Display a list of portfolio items.
     */
    public function index(): View
    {
        $projects = Portfolio::orderBy('project_date', 'desc')->paginate(6);
        $page = Page::where('slug', 'portfolio')->first();
        return view('front.portfolio.index', compact('projects', 'page'));
    }

    /**
     * Display a single portfolio entry.
     */
    public function show(string $slug): View
    {
        $project = Portfolio::where('slug', $slug)->firstOrFail();
        return view('front.portfolio.show', compact('project'));
    }
}