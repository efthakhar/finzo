<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public $categories = [
        ['id' => 1, 'name' => 'tution', 'category_type' => 'income'],
        ['id' => 2, 'name' => 'job', 'category_type' => 'income'],
        ['id' => 3, 'name' => 'freelancing', 'category_type' => 'income'],
        ['id' => 4, 'name' => 'house rental', 'category_type' => 'expense'],
        ['id' => 5, 'name' => 'car wash', 'category_type' => 'expense'],
        ['id' => 6, 'name' => 'buying book', 'category_type' => 'expense'],
    ];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create($category);
        }
    }
}
