<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories_data = json_decode(file_get_contents(__DIR__ . '\category_db.json'), true);

        foreach ($categories_data as $category) {
            $new_category = new Category();
            $new_category->name = $category['name'];
            $new_category->slug = Category::generateSlug($category['name']);
            $new_category->save();
        }
    }
}
