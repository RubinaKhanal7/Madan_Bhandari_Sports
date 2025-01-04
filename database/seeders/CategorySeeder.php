<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'title_ne' => 'श्रेणी १',
            'title_en' => 'Category 1',
            'description_ne' => 'नेपाली विवरण',
            'description_en' => 'English description',
            'is_active' => true,
        ]);
    }
}
