<?php

namespace Database\Seeders; // ✅ Correct namespace

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {
        TeamMember::create([
            'name' => 'Christian Frimpong',
            'position' => 'Founder & CEO',
            'bio' => 'With over 15 years of experience in the food industry, Christian leads our team with passion.',
            'image_path' => 'images/team-1.jpg',
            'social_links' => json_encode([
                'linkedin' => 'https://linkedin.com/in/christian-frimpong',
                'twitter' => 'https://twitter.com/christianfrimpong'
            ])
        ]);

        TeamMember::create([
            'name' => 'Samuela Adjei',
            'position' => 'Head of Product Development',
            'bio' => 'Samuela brings expertise in nutrition and food science to create innovative products.',
            'image_path' => 'images/team-2.jpg',
            'social_links' => json_encode([
                'linkedin' => 'https://linkedin.com/in/samuela-adjei',
                'twitter' => 'https://twitter.com/samuelaadjei'
            ])
        ]);
    }
}
