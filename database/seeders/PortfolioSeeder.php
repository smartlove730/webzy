<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Corporate Website for ABC Industries',
                'client_name' => 'ABC Industries',
                'category' => 'Corporate Website',
                'project_date' => '2025-05-15',
                'location' => 'Delhi, India',
                'image' => 'portfolio/abc-industries.jpg',
                'short_description' => 'A modern corporate website designed to showcase ABC Industries’ services, team and achievements.',
                'description' => "<p>ABC Industries approached us to revamp their outdated website. We crafted a sleek, responsive design that reflects the company’s professionalism and values. The new site features an intuitive navigation structure, interactive service pages, team profiles and a news section.</p><p>The result is a polished online presence that instills trust and effectively communicates ABC’s capabilities to prospective clients and partners.</p>",
                'meta_title' => 'Corporate Website Project – ABC Industries | Webzy Portfolio',
                'meta_description' => 'See how Webzy redesigned ABC Industries’ corporate website with a modern look and improved user experience.',
                'meta_keywords' => 'corporate website, web design, portfolio',
            ],
            [
                'title' => 'E‑Commerce Platform for FashionHub',
                'client_name' => 'FashionHub',
                'category' => 'E‑commerce',
                'project_date' => '2025-11-20',
                'location' => 'Mumbai, India',
                'image' => 'portfolio/fashionhub.jpg',
                'short_description' => 'A scalable e‑commerce platform built for a fast‑growing fashion retailer.',
                'description' => "<p>FashionHub needed an e‑commerce solution that could keep pace with their rapid growth. Our team developed a custom Laravel e‑commerce platform featuring advanced product management, dynamic merchandising, secure checkout and seamless integration with payment gateways and logistics providers.</p><p>The new platform increased sales conversion rates and provided the flexibility FashionHub needed to expand into new markets.</p>",
                'meta_title' => 'E‑Commerce Platform Project – FashionHub | Webzy Portfolio',
                'meta_description' => 'Discover how Webzy developed a scalable e‑commerce platform for FashionHub, a leading fashion retailer.',
                'meta_keywords' => 'e‑commerce development, Laravel e‑commerce, portfolio',
            ],
            [
                'title' => 'Mobile App for Foodies',
                'client_name' => 'Foodies',
                'category' => 'Mobile App',
                'project_date' => '2024-08-10',
                'location' => 'Chandigarh, India',
                'image' => 'portfolio/foodies-app.jpg',
                'short_description' => 'A cross‑platform mobile app that connects food lovers with local restaurants and delivery services.',
                'description' => "<p>Foodies wanted to build a mobile platform to help users discover and order food from nearby restaurants. We designed and developed a Flutter application that provides a seamless user experience, from browsing menus to placing orders and tracking deliveries in real time.</p><p>The app integrates with Google Maps, payment gateways and push notifications to deliver a delightful experience that keeps users coming back.</p>",
                'meta_title' => 'Mobile App Project – Foodies | Webzy Portfolio',
                'meta_description' => 'Learn how Webzy created a cross‑platform food ordering app for Foodies that connects users with local restaurants.',
                'meta_keywords' => 'mobile app development, Flutter app, food delivery app',
            ],
            [
                'title' => 'Brand Identity & Website for StartupX',
                'client_name' => 'StartupX',
                'category' => 'Branding & Web',
                'project_date' => '2024-04-01',
                'location' => 'Bengaluru, India',
                'image' => 'portfolio/startupx.jpg',
                'short_description' => 'A comprehensive branding and website project for a tech startup entering the market.',
                'description' => "<p>StartupX partnered with Webzy to establish a strong brand identity and create a modern website ahead of their product launch. Our designers developed a logo, color palette and typography guidelines that reflect the brand’s innovative spirit.</p><p>We then designed and built a responsive website featuring animations, product showcases and lead capture forms to support their marketing efforts.</p>",
                'meta_title' => 'Branding & Website Project – StartupX | Webzy Portfolio',
                'meta_description' => 'See how Webzy helped StartupX with branding and a responsive website design for their product launch.',
                'meta_keywords' => 'branding, web design, startup branding',
            ],
        ];

        foreach ($projects as $project) {
            $project['slug'] = Str::slug($project['title']);
            Portfolio::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }
    }
}