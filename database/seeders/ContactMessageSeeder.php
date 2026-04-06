<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Rahul Sharma',
                'email' => 'rahul.sharma@example.com',
                'subject' => 'Project Enquiry',
                'message' => 'Hi Webzy team, I would like to discuss a new web project for my company.',
                'is_read' => false,
            ],
            [
                'name' => 'Priya Kapoor',
                'email' => 'priya.kapoor@example.com',
                'subject' => 'Collaboration Opportunity',
                'message' => 'We love your work and would like to explore collaboration opportunities.',
                'is_read' => true,
            ],
        ];
        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
}