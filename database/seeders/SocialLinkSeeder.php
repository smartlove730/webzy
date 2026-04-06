<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/webzy', 'icon' => 'fa-linkedin'],
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/webzy', 'icon' => 'fa-x-twitter'],
            ['platform' => 'Facebook', 'url' => 'https://facebook.com/webzy', 'icon' => 'fa-facebook'],
            ['platform' => 'Instagram', 'url' => 'https://instagram.com/webzy', 'icon' => 'fa-instagram'],
            ['platform' => 'YouTube', 'url' => 'https://youtube.com/@webzy', 'icon' => 'fa-youtube'],
        ];
        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['platform' => $link['platform']],
                $link
            );
        }
    }
}