<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Social Media Marketing',
            'Digital Marketing',
            'SEO',
            'Graphic Design',
            'Web Development',
            'Positive Psychology',
            'Fitness',
            'Yoga'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'category_name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'image_path' => 'images/coursejpg.jpg' // Default image path
            ]);
        }
    }
}
