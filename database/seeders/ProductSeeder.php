<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Nutrition;
use App\Models\Review;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Sample products
        $products = [
            [
                'name' => 'Premium Oats',
                'slug' => 'premium-oats',
                'description' => 'Packed with nutrients and fiber for a healthy breakfast.',
                'regular_price' => 20.00,
                'category_id' => 1,
                'image_path' => 'images/product-oats.jpg',
                'badge' => 'Best Seller',
                'sku' => 'OAT-001',
                'availability' => 'In Stock'
            ],
            [
                'name' => 'Tom Brown Mix',
                'slug' => 'tom-brown-mix',
                'description' => 'A nutritious blend of roasted corn, millet, and groundnuts.',
                'regular_price' => 30.00,
                'category_id' => 2,
                'image_path' => 'images/product-tombrown.jpg',
                'badge' => 'New',
                'sku' => 'TB-002',
                'availability' => 'In Stock'
            ]
        ];

        foreach ($products as $data) {
            $product = Product::firstOrCreate(['slug' => $data['slug']], $data);

            // Seed product images
            ProductImage::firstOrCreate(['product_id' => $product->id, 'path' => 'images/'.$product->slug.'-1.jpg']);
            ProductImage::firstOrCreate(['product_id' => $product->id, 'path' => 'images/'.$product->slug.'-2.jpg']);

            // Seed nutrition facts
            Nutrition::firstOrCreate([
                'product_id' => $product->id
            ], [
                'calories' => rand(100, 250),
                'protein' => rand(2, 8),
                'carbs' => rand(15, 40),
                'fat' => rand(1, 10)
            ]);

            // Seed sample reviews (only if users exist)
            $user = User::first();
            if ($user) {
                Review::firstOrCreate([
                    'product_id' => $product->id,
                    'user_id' => $user->id
                ], [
                    'title' => 'Great product!',
                    'content' => 'Tastes amazing, perfect breakfast choice.',
                    'rating' => rand(3, 5)
                ]);
            }
        }
    }
}
