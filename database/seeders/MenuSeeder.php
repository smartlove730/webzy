<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Create main header menu
        $menu = Menu::updateOrCreate(
            ['name' => 'Main Navigation'],
            ['location' => 'header']
        );

        $items = [
            ['title' => 'Home', 'url' => '/', 'order' => 1],
            ['title' => 'About Us', 'url' => '/about-us', 'order' => 2],
            ['title' => 'Services', 'url' => '/services', 'order' => 3],
            ['title' => 'Portfolio', 'url' => '/portfolio', 'order' => 4],
            ['title' => 'Blog', 'url' => '/blog', 'order' => 5],
            ['title' => 'Contact Us', 'url' => '/contact-us', 'order' => 6],
        ];

        foreach ($items as $item) {
            MenuItem::updateOrCreate(
                ['menu_id' => $menu->id, 'title' => $item['title']],
                array_merge($item, ['menu_id' => $menu->id, 'parent_id' => null])
            );
        }
    }
}