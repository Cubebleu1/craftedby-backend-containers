<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->state(function (){
                $user = User::factory()->create();
                return [
                    'user_id' => $user->id,
                ];
            })
            ->afterCreating(function (Order $order) {
                $products = Product::inRandomOrder()->take(rand(1, 5))->get();
                $order->products()->attach($products);
            })
            ->create();
    }
}
