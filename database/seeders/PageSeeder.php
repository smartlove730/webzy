<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'content' => null,
                'meta_title' => 'Webzy – Premium Web Development Agency',
                'meta_description' => 'Webzy crafts bespoke web solutions that drive digital transformation and business growth.',
                'meta_keywords' => 'web development, custom websites, digital agency',
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => "<p>Webzy is a full-service digital agency based in Panchkula, Haryana. We specialize in crafting custom websites, e‑commerce platforms, mobile applications and digital experiences that help businesses succeed in the online world. Our multidisciplinary team of strategists, designers and developers work closely with clients to transform ideas into intuitive, high‑performing products.</p>\n<p>Our mission is to empower organizations with technology that scales. We believe in transparent communication, user‑centric design and delivering measurable results. With years of experience across industries, we have become a trusted partner for startups, SMEs and enterprises looking to leverage the web to grow their business.</p>\n<p>At Webzy, we are passionate about innovation and continuous improvement. We stay up to date with the latest technologies and design trends to ensure that each solution we build is future‑proof and aligned with our clients’ goals.</p>",
                'meta_title' => 'About Webzy – Learn About Our Digital Agency',
                'meta_description' => 'Discover how Webzy helps businesses succeed with custom web development, mobile apps and digital transformation services.',
                'meta_keywords' => 'about webzy, digital agency, web development company',
            ],
            [
                'title' => 'Services',
                'slug' => 'services',
                'content' => "<p>At Webzy, we offer a comprehensive suite of services designed to cover every stage of your digital journey. From initial strategy and branding to development and ongoing maintenance, our team delivers full‑stack expertise to ensure your project succeeds.</p>\n<p>Explore our range of services including custom web development, e‑commerce solutions, mobile app development, UI/UX design, content management systems and SEO & digital marketing. Each service is tailored to your specific needs to deliver maximum return on investment.</p>",
                'meta_title' => 'Our Services – Web Development, Design, Mobile Apps & More',
                'meta_description' => 'Learn about Webzy’s range of services including custom website development, e‑commerce, mobile apps, UI/UX design and digital marketing.',
                'meta_keywords' => 'web development services, e‑commerce solutions, mobile app development, UI/UX design',
            ],
            [
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'content' => "<p>We are proud of the work we have delivered for clients across diverse industries. Our portfolio showcases a selection of custom websites, e‑commerce platforms, mobile applications and branding projects that demonstrate our ability to solve complex business challenges with elegant solutions.</p>\n<p>Browse through our recent projects to see how we combine technical excellence with design expertise to create digital experiences that drive results.</p>",
                'meta_title' => 'Our Portfolio – Webzy Projects & Case Studies',
                'meta_description' => 'Explore the portfolio of Webzy to see examples of our web development, e‑commerce, mobile app and branding work.',
                'meta_keywords' => 'portfolio, web development case studies, design projects',
            ],
            [
                'title' => 'Blog',
                'slug' => 'blog',
                'content' => "<p>Stay informed with insights and resources from the Webzy team. Our blog covers the latest trends in web development, design, digital marketing and technology. Whether you are a business owner, marketer or developer, you will find valuable knowledge to help you stay ahead in the digital landscape.</p>",
                'meta_title' => 'Webzy Blog – Insights on Web Development & Digital Trends',
                'meta_description' => 'Read Webzy’s blog for the latest articles on web development, design, UX, e‑commerce and digital marketing.',
                'meta_keywords' => 'web development blog, digital marketing articles, design insights',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => "<p>We would love to hear about your project! Whether you have a question about our services or need a custom solution, our team is here to help. Fill out the contact form and we will get back to you promptly.</p>\n<p>You can also reach us via email at <a href='mailto:info@webzy.co.in'>info@webzy.co.in</a> or call us at +91 98765 43210. We look forward to collaborating with you and turning your ideas into reality.</p>",
                'meta_title' => 'Contact Webzy – Get in Touch',
                'meta_description' => 'Contact Webzy to discuss your web development and digital needs. Our team is ready to help you start your next project.',
                'meta_keywords' => 'contact webzy, get in touch, web development enquiry',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}