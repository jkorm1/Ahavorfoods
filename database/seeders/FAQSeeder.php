<?php

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    public function run()
    {
        FAQ::create([
            'question' => 'Where can I purchase Ahavor Foods products?',
            'answer' => 'Our products are available at major supermarkets and online with delivery options.'
        ]);

        FAQ::create([
            'question' => 'Are your products suitable for dietary restrictions?',
            'answer' => 'Many are gluten-free, vegan, and labeled with allergen details.'
        ]);
    }
}
