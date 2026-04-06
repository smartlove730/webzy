<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Custom Website Development',
                'icon' => 'fa-code',
                'image' => 'services/custom-website.jpg',
                'short_description' => 'Tailor‑made websites that reflect your brand and deliver results.',
                'description' => "<p>We build bespoke websites from the ground up using modern technologies and best practices. Whether you need a marketing site, a corporate portal or a complex web application, our developers deliver clean, scalable code that performs.</p><p>Every project begins with a discovery phase where we learn about your goals, audience and competitive landscape. We then design and develop a custom solution that is visually stunning, user‑friendly and optimized for search engines.</p>",
                'meta_title' => 'Custom Website Development Services | Webzy',
                'meta_description' => 'Create a unique online presence with Webzy’s custom website development services. Bespoke design & coding tailored to your business.',
                'meta_keywords' => 'custom website development, bespoke web design, web development services',
            ],
            [
                'title' => 'E‑commerce Solutions',
                'icon' => 'fa-shopping-cart',
                'image' => 'services/ecommerce.jpg',
                'short_description' => 'Scalable and secure online stores that convert visitors into customers.',
                'description' => "<p>Launch your online store with confidence. We design and develop e‑commerce platforms that are easy to manage, mobile‑friendly and built for performance. Our solutions integrate inventory management, payment gateways, shipping and analytics so you can focus on growing your business.</p><p>Whether you need a simple catalogue or a complex multi‑vendor marketplace, our team will create an e‑commerce experience that delights customers and drives sales.</p>",
                'meta_title' => 'E‑commerce Development & Solutions | Webzy',
                'meta_description' => 'Build an e‑commerce store that sells. Webzy creates secure, scalable and conversion‑focused e‑commerce platforms.',
                'meta_keywords' => 'e‑commerce development, online store, ecommerce solutions',
            ],
            [
                'title' => 'Mobile App Development',
                'icon' => 'fa-mobile-screen',
                'image' => 'services/mobile-app.jpg',
                'short_description' => 'Native and cross‑platform mobile apps that engage users anywhere.',
                'description' => "<p>Reach your customers on the devices they use most with a beautifully designed mobile app. Our developers create native iOS and Android applications as well as cross‑platform solutions using Flutter and React Native.</p><p>From concept to deployment, we handle strategy, UI/UX design, development, testing and publishing. We build apps that are intuitive, secure and ready to scale as your user base grows.</p>",
                'meta_title' => 'Mobile App Development Services | Webzy',
                'meta_description' => 'Engage users on the go with Webzy’s native and cross‑platform mobile app development services.',
                'meta_keywords' => 'mobile app development, iOS app, Android app, cross‑platform apps',
            ],
            [
                'title' => 'UI/UX Design',
                'icon' => 'fa-paint-brush',
                'image' => 'services/ui-ux.jpg',
                'short_description' => 'Human‑centered design that transforms user interactions into memorable experiences.',
                'description' => "<p>User experience sits at the core of everything we do. Our UI/UX designers work with you to understand your audience and craft intuitive interfaces that are both beautiful and functional. From wireframes and prototypes to high‑fidelity mockups, we ensure every interaction is seamless.</p><p>We follow a user‑centric design process that includes research, personas, user flows, design systems and usability testing to deliver products that users love.</p>",
                'meta_title' => 'UI/UX Design Services | Webzy',
                'meta_description' => 'Improve engagement with human‑centered UI/UX design services from Webzy. Intuitive interfaces that delight users.',
                'meta_keywords' => 'UI design, UX design, user experience design, user interface design',
            ],
            [
                'title' => 'Content Management Systems',
                'icon' => 'fa-database',
                'image' => 'services/cms.jpg',
                'short_description' => 'Flexible CMS solutions that put you in control of your content.',
                'description' => "<p>Manage your website with ease using a custom content management system. We develop CMS solutions using Laravel, WordPress, Statamic and other platforms to give you full control over your site’s content, structure and functionality.</p><p>Our CMS implementations are secure, scalable and tailored to the unique needs of your business. Whether you need a simple blogging platform or a complex enterprise CMS, we’ve got you covered.</p>",
                'meta_title' => 'Content Management Systems & CMS Development | Webzy',
                'meta_description' => 'Take control of your website with a custom CMS developed by Webzy. Flexible and scalable content management solutions.',
                'meta_keywords' => 'CMS development, content management system, WordPress, Laravel CMS',
            ],
            [
                'title' => 'SEO & Digital Marketing',
                'icon' => 'fa-chart-line',
                'image' => 'services/seo.jpg',
                'short_description' => 'Grow your online visibility and attract more customers with strategic marketing.',
                'description' => "<p>Driving traffic to your website is just as important as building it. Our SEO and digital marketing experts help you rank higher on search engines, reach targeted audiences and generate qualified leads.</p><p>We offer on‑page optimization, technical SEO, keyword research, content marketing, PPC advertising and social media campaigns to ensure your digital presence delivers measurable results.</p>",
                'meta_title' => 'SEO & Digital Marketing Services | Webzy',
                'meta_description' => 'Increase traffic and conversions with Webzy’s SEO and digital marketing services. Data‑driven strategies to grow your business.',
                'meta_keywords' => 'SEO services, digital marketing, search engine optimization, content marketing',
            ],
        ];

        foreach ($services as $serviceData) {
            $serviceData['slug'] = Str::slug($serviceData['title']);
            Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData
            );
        }
    }
}