<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->state(function (){
                $color = Color::inRandomOrder()->first();
                $business = Business::inRandomOrder()->first();
                $material = Material::inRandomOrder()->first();
                    return [
                        'color_id' => $color->id,
                        'business_id' => $business->id,
                        'material_id' => $material->id,
                    ];
            })
            ->afterCreating(function (Product $product) {
                $categories = Category::inRandomOrder()->take(1)->get();
                $product->categories()->attach($categories);
            })
        ->create();

    }
}
