<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Database\Factories\ProductFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $brands = ['Adidas', 'Puma', 'Reebok', 'Vans', 'Under Armour', 'New Balance'];
        $categories = [
            'Electronics',
            'Clothing',
            'Home',
            'Books',
            'Sports',
        ];

        foreach ($brands as $brand) {
            Brand::create(['name' => $brand]);
        }
        foreach ($categories as $category) {
            ProductCategory::create(['name' => $category]);
        }
        Product::factory(40)->create();
    }
}
