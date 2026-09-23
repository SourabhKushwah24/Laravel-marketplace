<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mobiles',
                'subcategories' => [
                    'Android Phones',
                    'iPhone',
                    'Mobile Accessories',
                ],
            ],
            [
                'name' => 'Cars',
                'subcategories' => [
                    'Hatchback',
                    'Sedan',
                    'SUV',
                ],
            ],
            [
                'name' => 'Electronics',
                'subcategories' => [
                    'Laptop',
                    'Television',
                    'Camera',
                ],
            ],
            [
                'name' => 'Furniture',
                'subcategories' => [
                    'Sofa',
                    'Bed',
                    'Table',
                ],
            ],
            [
                'name' => 'Services',
                'subcategories' => [
                    'Repair',
                    'Cleaning',
                    'Consultancy',
                ],
            ],
        ];

        foreach ($categories as $categoryData) {

            $category = Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'status' => true,
            ]);

            foreach ($categoryData['subcategories'] as $subcategoryName) {

                $category->subcategories()->create([
                    'name' => $subcategoryName,
                    'slug' => Str::slug($subcategoryName),
                    'status' => true,
                ]);
            }
        }
    }
}
