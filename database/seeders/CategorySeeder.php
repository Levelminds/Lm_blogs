<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Latest Articles', 'accent_color' => '#3248ad'],
            ['name' => 'Software Development', 'accent_color' => '#3f97d5'],
            ['name' => 'Data Science', 'accent_color' => '#22317d'],
            ['name' => 'Artificial Intelligence', 'accent_color' => '#182764'],
            ['name' => 'MBA', 'accent_color' => '#111c4d'],
            ['name' => 'General', 'accent_color' => '#5c6780'],
            ['name' => 'Digital Marketing', 'accent_color' => '#445068'],
            ['name' => "From Leader's Desk", 'accent_color' => '#2a3c90'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($category['name'])],
                $category
            );
        }
    }
}
