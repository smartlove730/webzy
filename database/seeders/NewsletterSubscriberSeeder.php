<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterSubscriber;

class NewsletterSubscriberSeeder extends Seeder
{
    public function run(): void
    {
        $subscribers = [
            ['email' => 'john@example.com'],
            ['email' => 'jane@example.com'],
        ];
        foreach ($subscribers as $subscriber) {
            NewsletterSubscriber::updateOrCreate(
                ['email' => $subscriber['email']],
                []
            );
        }
    }
}