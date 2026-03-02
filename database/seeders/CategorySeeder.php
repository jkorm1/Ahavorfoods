<?php

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Oat Products', 'slug' => 'oat-products'],
            ['name' => 'Tom Brown', 'slug' => 'tom-brown'],
            ['name' => 'Cereal Mixes', 'slug' => 'cereal-mixes'],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
