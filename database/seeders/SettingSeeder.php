<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_title', 'value' => 'Webzy – Professional Web Development Agency'],
            ['key' => 'site_tagline', 'value' => 'Transforming your ideas into digital realities'],
            ['key' => 'contact_email', 'value' => 'info@webzy.co.in'],
            ['key' => 'contact_phone', 'value' => '+91 98765 43210'],
            ['key' => 'address', 'value' => 'Panchkula, Haryana, India'],
        ];
        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}