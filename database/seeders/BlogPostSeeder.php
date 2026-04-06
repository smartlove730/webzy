<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::first();
        $postsData = [
            [
                'title' => 'Custom Website vs. Template: Why Going Bespoke Matters',
                'category_slug' => 'web-development',
                'featured_image' => 'blog/custom-vs-template.jpg',
                'short_description' => 'Understand the differences between custom websites and off‑the‑shelf templates, and why a bespoke solution can better serve your business.',
                'content' => "<p>In today’s digital landscape, having a website is essential. But not all websites are created equal. While templates offer a quick and inexpensive way to get online, they often lack the flexibility and unique branding that a custom website provides.</p><p>A bespoke website is built specifically for your business, taking into account your goals, audience and competitive advantage. With custom design and development, you have full control over functionality, performance and scalability.</p><p>In this article, we explore the pros and cons of templates vs. custom websites to help you decide which option is right for you.</p>",
                'meta_title' => 'Custom Website vs Template – Advantages of Bespoke Development',
                'meta_description' => 'Learn why investing in a custom website can give your business a competitive edge over using a generic template.',
                'meta_keywords' => 'custom website, website templates, bespoke web development',
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'tags' => ['Laravel', 'Design'],
            ],
            [
                'title' => 'Top Web Development Trends in 2026',
                'category_slug' => 'web-development',
                'featured_image' => 'blog/web-trends-2026.jpg',
                'short_description' => 'Discover the key trends shaping web development in 2026, from AI‑driven experiences to progressive web apps and beyond.',
                'content' => "<p>The world of web development is constantly evolving. In 2026, we expect to see even greater emphasis on performance, personalization and user experience. Technologies like artificial intelligence, serverless architecture, Jamstack and progressive web apps will continue to gain momentum.</p><p>Developers will also focus on accessibility, security and sustainability as core pillars of modern web projects. In this post, we highlight the trends and technologies that will define the next generation of web experiences.</p>",
                'meta_title' => 'Web Development Trends 2026 – What to Expect',
                'meta_description' => 'Explore the latest trends and technologies that will shape the future of web development in 2026.',
                'meta_keywords' => 'web development trends, 2026 tech trends, progressive web apps',
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'tags' => ['Laravel', 'React', 'Vue'],
            ],
            [
                'title' => 'Designing for User Engagement: UI/UX Best Practices',
                'category_slug' => 'design',
                'featured_image' => 'blog/ui-ux-best-practices.jpg',
                'short_description' => 'Learn how to design interfaces that captivate users and keep them coming back for more.',
                'content' => "<p>User engagement is the lifeblood of digital products. Great UI/UX design not only attracts users but also guides them through meaningful interactions that lead to conversion.</p><p>From clear navigation and micro‑interactions to responsive layouts and accessibility, this article covers best practices for designing user experiences that are intuitive and delightful.</p>",
                'meta_title' => 'UI/UX Design Best Practices for High User Engagement',
                'meta_description' => 'Discover best practices in UI/UX design to enhance user engagement and satisfaction.',
                'meta_keywords' => 'UI/UX best practices, user engagement, design tips',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'tags' => ['Design', 'UX'],
            ],
        ];

        foreach ($postsData as $postData) {
            $category = BlogCategory::where('slug', $postData['category_slug'])->first();
            if (!$category) {
                continue;
            }
            $slug = Str::slug($postData['title']);
            $post = BlogPost::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'author_id' => $author ? $author->id : null,
                    'title' => $postData['title'],
                    'slug' => $slug,
                    'featured_image' => $postData['featured_image'],
                    'short_description' => $postData['short_description'],
                    'content' => $postData['content'],
                    'meta_title' => $postData['meta_title'],
                    'meta_description' => $postData['meta_description'],
                    'meta_keywords' => $postData['meta_keywords'],
                    'is_published' => $postData['is_published'],
                    'published_at' => $postData['published_at'],
                ]
            );
            // Attach tags
            $tagIds = BlogTag::whereIn('name', $postData['tags'])->pluck('id');
            $post->tags()->sync($tagIds);
        }
    }
}