<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ThemeSetting;

class ThemeSettingSeeder extends Seeder
{
    public function run(): void
    {
        ThemeSetting::truncate();
        ThemeSetting::create([
            'primary_color' => '#0A65CC',
            'secondary_color' => '#00A8E8',
            'logo_path' => 'images/logo.png',
            'favicon_path' => 'images/favicon.ico',
        ]);
    }
}