<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::insert([
            ['name' => 'Nutrition', 'slug' => 'nutrition'],
            ['name' => 'Organic', 'slug' => 'organic'],
            ['name' => 'Health Tips', 'slug' => 'health-tips'],
            ['name' => 'Food Science', 'slug' => 'food-science'],
            ['name' => 'Wellness', 'slug' => 'wellness'],
        ]);
        
    }
}
