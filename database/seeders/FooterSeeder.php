<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FooterSection;
use App\Models\FooterLink;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        // Company section
        $company = FooterSection::updateOrCreate(
            ['title' => 'Company'],
            [
                'content' => '<p>Webzy is a premium web development and digital services agency committed to delivering outstanding results. Based in Panchkula, we serve clients across India and around the world.</p>',
                'order' => 1,
            ]
        );
        $companyLinks = [
            ['title' => 'About Us', 'url' => '/about-us', 'order' => 1],
            ['title' => 'Portfolio', 'url' => '/portfolio', 'order' => 2],
            ['title' => 'Careers', 'url' => '/careers', 'order' => 3],
        ];
        foreach ($companyLinks as $link) {
            FooterLink::updateOrCreate(
                ['footer_section_id' => $company->id, 'title' => $link['title']],
                array_merge($link, ['footer_section_id' => $company->id])
            );
        }

        // Services section
        $services = FooterSection::updateOrCreate(
            ['title' => 'Services'],
            [
                'content' => null,
                'order' => 2,
            ]
        );
        $serviceLinks = [
            ['title' => 'Web Development', 'url' => '/services#custom-website-development', 'order' => 1],
            ['title' => 'E‑commerce', 'url' => '/services#e-commerce-solutions', 'order' => 2],
            ['title' => 'Mobile Apps', 'url' => '/services#mobile-app-development', 'order' => 3],
            ['title' => 'UI/UX Design', 'url' => '/services#ui-ux-design', 'order' => 4],
            ['title' => 'CMS', 'url' => '/services#content-management-systems', 'order' => 5],
            ['title' => 'SEO & Marketing', 'url' => '/services#seo-and-digital-marketing', 'order' => 6],
        ];
        foreach ($serviceLinks as $link) {
            FooterLink::updateOrCreate(
                ['footer_section_id' => $services->id, 'title' => $link['title']],
                array_merge($link, ['footer_section_id' => $services->id])
            );
        }

        // Resources section
        $resources = FooterSection::updateOrCreate(
            ['title' => 'Resources'],
            [
                'content' => null,
                'order' => 3,
            ]
        );
        $resourceLinks = [
            ['title' => 'Blog', 'url' => '/blog', 'order' => 1],
            ['title' => 'Privacy Policy', 'url' => '/privacy-policy', 'order' => 2],
            ['title' => 'Terms of Service', 'url' => '/terms-of-service', 'order' => 3],
        ];
        foreach ($resourceLinks as $link) {
            FooterLink::updateOrCreate(
                ['footer_section_id' => $resources->id, 'title' => $link['title']],
                array_merge($link, ['footer_section_id' => $resources->id])
            );
        }

        // Contact section
        $contact = FooterSection::updateOrCreate(
            ['title' => 'Contact'],
            [
                'content' => '<p>Panchkula, Haryana, India<br/>Phone: +91 98765 43210<br/><a href="mailto:info@webzy.co.in">info@webzy.co.in</a></p>',
                'order' => 4,
            ]
        );
    }
}