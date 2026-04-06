<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogTag;
use Illuminate\Support\Str;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'Vue', 'React', 'Design', 'SEO', 'UX'];
        foreach ($tags as $tagName) {
            BlogTag::updateOrCreate(
                ['slug' => Str::slug($tagName)],
                [
                    'name' => $tagName,
                    'slug' => Str::slug($tagName),
                ]
            );
        }
    }
}