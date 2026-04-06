<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['title' => 'Web Development', 'description' => 'Articles on web technologies, frameworks and best practices.'],
            ['title' => 'Design', 'description' => 'Insights on UI/UX design, aesthetics and user experience.'],
            ['title' => 'Marketing', 'description' => 'Tips on SEO, digital marketing and growth strategies.'],
            ['title' => 'Announcements', 'description' => 'News and updates about Webzy and our projects.'],
        ];
        foreach ($categories as $category) {
            $category['slug'] = Str::slug($category['title']);
            BlogCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}