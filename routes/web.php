<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\ServiceController;
use App\Http\Controllers\Front\PortfolioController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\NewsletterController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front‑facing routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Legacy auth/welcome compatibility routes
Route::get('/home', fn () => redirect()->route('home'))->name('home.redirect');
Route::get('/register', fn () => redirect()->route('login'))->name('register');

// Sitemap
Route::get('/sitemap.xml', function () {
    $pages = \App\Models\Page::all();
    $services = \App\Models\Service::all();
    $projects = \App\Models\Portfolio::all();
    $posts = \App\Models\BlogPost::where('is_published', true)->get();
    return response()->view('sitemap', compact('pages', 'services', 'projects', 'posts'))
        ->header('Content-Type', 'text/xml');
});

// Admin routes (CMS)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Pages management
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class);
        // Services management
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        // Portfolio management
        Route::resource('portfolio', App\Http\Controllers\Admin\PortfolioController::class);
        // Blogs management
        // Additional route for AI blog generation (Phase 6)
        Route::post('blogs/generate', [App\Http\Controllers\Admin\BlogController::class, 'generate'])->name('blogs.generate');
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);
        // Blog categories management
        Route::resource('blog-categories', App\Http\Controllers\Admin\BlogCategoryController::class);
        // Blog tags management
        Route::resource('blog-tags', App\Http\Controllers\Admin\BlogTagController::class);
        // Menus management
        Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);
        Route::resource('menu-items', App\Http\Controllers\Admin\MenuItemController::class)->except(['index']);
        // Footer management
        Route::resource('footer-sections', App\Http\Controllers\Admin\FooterSectionController::class);
        Route::resource('footer-links', App\Http\Controllers\Admin\FooterLinkController::class);
        // Settings
        Route::get('settings/general', [App\Http\Controllers\Admin\SettingController::class, 'general'])->name('settings.general');
        Route::post('settings/general', [App\Http\Controllers\Admin\SettingController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('settings/theme', [App\Http\Controllers\Admin\SettingController::class, 'theme'])->name('settings.theme');
        Route::post('settings/theme', [App\Http\Controllers\Admin\SettingController::class, 'updateTheme'])->name('settings.theme.update');
        Route::get('settings/seo', [App\Http\Controllers\Admin\SettingController::class, 'seo'])->name('settings.seo');
        Route::post('settings/seo', [App\Http\Controllers\Admin\SettingController::class, 'updateSeo'])->name('settings.seo.update');
        Route::get('settings/firebase', [App\Http\Controllers\Admin\SettingController::class, 'firebase'])->name('settings.firebase');
        Route::post('settings/firebase', [App\Http\Controllers\Admin\SettingController::class, 'updateFirebase'])->name('settings.firebase.update');
        Route::get('settings/design', [App\Http\Controllers\Admin\SettingController::class, 'design'])->name('settings.design');
        Route::post('settings/design', [App\Http\Controllers\Admin\SettingController::class, 'updateDesign'])->name('settings.design.update');
        // Media library
        Route::resource('media', App\Http\Controllers\Admin\MediaController::class);
        // Newsletter subscribers
        Route::resource('subscribers', App\Http\Controllers\Admin\SubscriberController::class)->only(['index', 'destroy']);

        // Backward-compatible alias used in legacy admin blade
        Route::get('contact-messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])
            ->name('contact-messages.index');

        // Contact messages
        Route::resource('contacts', App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);
        // Social links
        Route::resource('social-links', App\Http\Controllers\Admin\SocialLinkController::class);
    });

// Authentication routes (Laravel Breeze/Fortify can be used)
require __DIR__.'/auth.php';