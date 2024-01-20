<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Product A',
                'price' => 100,
            ],
            [
                'name' => 'Product B',
                'price' => 200,
            ],
            [
                'name' => 'Product C',
                'price' => 99.99,
            ],
            [
                'name' => 'Product D',
                'price' => 299,
            ]
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
