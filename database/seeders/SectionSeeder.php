<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $home = Page::where('slug', 'home')->first();
        if (!$home) {
            return;
        }

        $sections = [
            [
                'identifier' => 'hero',
                'title' => 'Crafting Digital Experiences that Inspire',
                'content' => "<p>At Webzy, we transform ideas into beautiful, functional and engaging digital experiences. Whether you need a custom website, an e‑commerce platform or a mobile application, our team of experts is ready to help your business thrive online.</p>\n<p><a href='/contact-us' class='btn btn-primary'>Start Your Project</a></p>",
                'order' => 1,
            ],
            [
                'identifier' => 'about',
                'title' => 'Who We Are',
                'content' => "<p>We are a passionate team of designers, developers and strategists dedicated to delivering high‑quality digital products. Since our founding, we have helped businesses of all sizes establish a strong presence online through custom solutions that are tailored to their unique goals.</p>",
                'order' => 2,
            ],
            [
                'identifier' => 'services',
                'title' => 'Our Services',
                'content' => "<p>From full‑stack web development and e‑commerce to mobile applications and UI/UX design, we offer a comprehensive suite of services to build, launch and grow your digital product.</p>",
                'order' => 3,
            ],
            [
                'identifier' => 'portfolio',
                'title' => 'Featured Work',
                'content' => "<p>Take a look at some of the projects we’ve brought to life for our clients. Each one demonstrates our commitment to quality, innovation and results.</p>",
                'order' => 4,
            ],
            [
                'identifier' => 'testimonials',
                'title' => 'What Our Clients Say',
                'content' => "<blockquote>\"Webzy exceeded our expectations. Their attention to detail and ability to translate our vision into a stunning website helped us increase conversions significantly.\" – Rahul Sharma, CEO of TechSolutions</blockquote>\n<blockquote>\"Working with Webzy was a breeze. Their team was responsive, creative and delivered our project on time and within budget.\" – Priya Kapoor, Founder of FashionHub</blockquote>",
                'order' => 5,
            ],
            [
                'identifier' => 'cta',
                'title' => 'Ready to Start Your Project?',
                'content' => "<p>Let’s collaborate to create something amazing. Contact us today to schedule a consultation and discover how we can help your business grow online.</p>\n<p><a href='/contact-us' class='btn btn-primary'>Get in Touch</a></p>",
                'order' => 6,
            ],
            [
                'identifier' => 'blog',
                'title' => 'From Our Blog',
                'content' => "<p>Stay informed with industry insights, tips and tutorials from our experts. Check out our latest blog posts for inspiration and advice on all things digital.</p>",
                'order' => 7,
            ],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                [
                    'page_id' => $home->id,
                    'identifier' => $section['identifier'],
                ],
                array_merge($section, ['page_id' => $home->id])
            );
        }
    }
}