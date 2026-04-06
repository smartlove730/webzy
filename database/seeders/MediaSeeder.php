<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\User;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        $mediaItems = [
            ['file_name' => 'logo.png', 'file_path' => 'images/logo.png', 'file_type' => 'image/png', 'file_size' => 102400],
            ['file_name' => 'favicon.ico', 'file_path' => 'images/favicon.ico', 'file_type' => 'image/x-icon', 'file_size' => 5120],
            ['file_name' => 'custom-website.jpg', 'file_path' => 'services/custom-website.jpg', 'file_type' => 'image/jpeg', 'file_size' => 204800],
            ['file_name' => 'ecommerce.jpg', 'file_path' => 'services/ecommerce.jpg', 'file_type' => 'image/jpeg', 'file_size' => 204800],
            ['file_name' => 'mobile-app.jpg', 'file_path' => 'services/mobile-app.jpg', 'file_type' => 'image/jpeg', 'file_size' => 204800],
            ['file_name' => 'ui-ux.jpg', 'file_path' => 'services/ui-ux.jpg', 'file_type' => 'image/jpeg', 'file_size' => 204800],
            ['file_name' => 'cms.jpg', 'file_path' => 'services/cms.jpg', 'file_type' => 'image/jpeg', 'file_size' => 204800],
            ['file_name' => 'seo.jpg', 'file_path' => 'services/seo.jpg', 'file_type' => 'image/jpeg', 'file_size' => 204800],
            ['file_name' => 'abc-industries.jpg', 'file_path' => 'portfolio/abc-industries.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
            ['file_name' => 'fashionhub.jpg', 'file_path' => 'portfolio/fashionhub.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
            ['file_name' => 'foodies-app.jpg', 'file_path' => 'portfolio/foodies-app.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
            ['file_name' => 'startupx.jpg', 'file_path' => 'portfolio/startupx.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
            ['file_name' => 'custom-vs-template.jpg', 'file_path' => 'blog/custom-vs-template.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
            ['file_name' => 'web-trends-2026.jpg', 'file_path' => 'blog/web-trends-2026.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
            ['file_name' => 'ui-ux-best-practices.jpg', 'file_path' => 'blog/ui-ux-best-practices.jpg', 'file_type' => 'image/jpeg', 'file_size' => 256000],
        ];
        foreach ($mediaItems as $item) {
            Media::updateOrCreate(
                ['file_path' => $item['file_path']],
                array_merge($item, ['user_id' => $admin ? $admin->id : null])
            );
        }
    }
}