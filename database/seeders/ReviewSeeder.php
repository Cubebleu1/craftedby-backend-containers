<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::factory()
            ->state(function (){
                $user = User::inRandomOrder()->first();
                $product = Product::inRandomOrder()->first();
                return [
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ];
            })
        ->create();
    }
}
