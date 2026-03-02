<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Define posts with associated tags
        $posts = [
            [
                'title' => 'Healthy Breakfast Ideas',
                'slug' => 'healthy-breakfast-ideas',
                'excerpt' => 'Start your day right with these nutritious breakfast recipes.',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
                'image_path' => 'images/blog/breakfast.jpg',
                'category_id' => 1,
                'author_id' => 1,
                'tags' => ['Nutrition', 'Healthy Eating'] // ✅ Attach tags
            ],
            [
                'title' => 'Benefits of Whole Grains',
                'slug' => 'benefits-of-whole-grains',
                'excerpt' => 'Discover why whole grains are essential for a healthy diet.',
                'content' => 'Whole grains provide essential nutrients like fiber and protein...',
                'image_path' => 'images/blog/grains.jpg',
                'category_id' => 2,
                'author_id' => 1,
                'tags' => ['Organic', 'Food Science'] // ✅ Attach tags
            ]
        ];

        foreach ($posts as $data) {
            // Create or retrieve post
            $post = Post::firstOrCreate(
                ['slug' => $data['slug']], 
                [
                    'title' => $data['title'],
                    'excerpt' => $data['excerpt'],
                    'content' => $data['content'],
                    'image_path' => $data['image_path'],
                    'category_id' => $data['category_id'],
                    'author_id' => $data['author_id']
                ]
            );

            // ✅ Attach tags to post using pivot table
            if (!empty($data['tags'])) {
                $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
                $post->tags()->sync($tagIds);
            }
        }
    }
}
