<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Page;

/**
 * Generic pages controller. Handles static pages such as About Us. Each
 * page record in the database can be retrieved based on its slug and
 * displayed using a common template.
 */
class PageController extends Controller
{
    /**
     * Display the About Us page.
     */
    public function about(): View
    {
        // Fetch the About Us page by slug
        $page = Page::where('slug', 'about-us')->firstOrFail();
        return view('front.about', compact('page'));
    }
}