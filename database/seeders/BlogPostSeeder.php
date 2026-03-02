<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            [
                'title' => 'The Power of Organic Foods',
                'slug' => 'power-of-organic-foods',
                'excerpt' => 'Organic foods provide health benefits and eliminate harmful chemicals.',
                'content' => '<p>Organic foods are packed with nutrients and free from synthetic pesticides...</p>',
                'image_path' => 'images/blog/organic-foods.jpg',
                'category_id' => 1, // Make sure this category exists!
                'author_id' => 1, // Ensure this author exists!
                'published_at' => Carbon::now(),
            ],
            [
                'title' => 'Healthy Eating Tips for a Balanced Life',
                'slug' => 'healthy-eating-tips',
                'excerpt' => 'Healthy eating ensures better wellness and long-term well-being.',
                'content' => '<p>Good nutrition leads to better health outcomes and daily energy...</p>',
                'image_path' => 'images/blog/healthy-eating.jpg',
                'category_id' => 2,
                'author_id' => 2,
                'published_at' => Carbon::now()->subDays(3),
            ]
        ]);
    }
}
