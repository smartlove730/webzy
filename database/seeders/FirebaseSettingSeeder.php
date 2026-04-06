<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FirebaseSetting;

class FirebaseSettingSeeder extends Seeder
{
    public function run(): void
    {
        FirebaseSetting::truncate();
        FirebaseSetting::create([
            'server_key' => null,
            'sender_id' => null,
            'project_id' => null,
        ]);
    }
}