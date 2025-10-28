<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Latest Articles', 'slug' => 'latest-articles', 'accent_color' => '#3248ad'],
            ['name' => 'Software Development', 'slug' => 'software-development', 'accent_color' => '#3f97d5'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'accent_color' => '#22317d'],
            ['name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence', 'accent_color' => '#182764'],
            ['name' => 'MBA', 'slug' => 'mba', 'accent_color' => '#111c4d'],
            ['name' => 'General', 'slug' => 'general', 'accent_color' => '#5c6780'],
            ['name' => 'Digital Marketing', 'slug' => 'digital-marketing', 'accent_color' => '#445068'],
            ['name' => "From Leader's Desk", 'slug' => 'from-leaders-desk', 'accent_color' => '#2a3c90'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug'] ?? \Illuminate\Support\Str::slug($category['name'])],
                $category
            );
        }
    }
}
