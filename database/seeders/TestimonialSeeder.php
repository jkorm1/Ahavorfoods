<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::insert([
            [
                'name' => 'Emily Johnson',
                'title' => 'Food Blogger',
                'message' => 'Absolutely love the organic products! The quality is outstanding.',
                'image_path' => 'images/testimonials/emily.jpg',
                'rating' => 5,
            ],
            [
                'name' => 'Mark Anderson',
                'title' => 'Chef',
                'message' => 'The best almond butter I have ever tasted! Highly recommended.',
                'image_path' => 'images/testimonials/mark.jpg',
                'rating' => 4.5,
            ],
            [
                'name' => 'Sophia Lee',
                'title' => 'Health Enthusiast',
                'message' => 'Great natural ingredients and amazing customer service!',
                'image_path' => 'images/testimonials/sophia.jpg',
                'rating' => 4,
            ],
            [
                'name' => 'James Carter',
                'title' => 'Nutritionist',
                'message' => 'Perfect balance of taste and nutrition. I recommend Ahavor Foods to my clients!',
                'image_path' => 'images/testimonials/james.jpg',
                'rating' => 5,
            ]
        ]);
    }
}
