<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_name' => fake()->sentence(),
            'product_price_capital' => fake()->numberBetween(100,200),
            'product_price_sell' => fake()->numberBetween(100,200),
            'product_code' => fake()->numberBetween(300,400)
        ]);
    }
}
