<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SettingSeeder::class,
            ThemeSettingSeeder::class,
            PageSeeder::class,
            SectionSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            BlogPostSeeder::class,
            MenuSeeder::class,
            FooterSeeder::class,
            SocialLinkSeeder::class,
            NewsletterSubscriberSeeder::class,
            ContactMessageSeeder::class,
            FirebaseSettingSeeder::class,
            MediaSeeder::class,
            SeoDataSeeder::class,
        ]);
    }
}