<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeoData;
use App\Models\Page;

class SeoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Example SEO record for home page
        $home = Page::where('slug', 'home')->first();
        if ($home) {
            SeoData::updateOrCreate(
                ['model_type' => Page::class, 'model_id' => $home->id],
                [
                    'meta_title' => 'Webzy – Premium Web Development & Digital Services',
                    'meta_description' => 'Webzy creates tailor‑made websites, mobile apps and digital solutions that help businesses grow online.',
                    'meta_keywords' => 'web development, mobile apps, digital agency, UI/UX design',
                    'canonical_url' => url('/'),
                ]
            );
        }
    }
}