<?php

namespace Database\Seeders;

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
        Product::create([
            'ProductName' => 'Chai',
            'SupplierId' => 1,
            'UnitPrice' => 150,
        ]);

        Product::create([
            'ProductName' => 'Rice',
            'SupplierId' => 1,
            'UnitPrice' => 300,
        ]);

        Product::create([
            'ProductName' => 'Sugar',
            'SupplierId' => 2,
            'UnitPrice' => 250,
        ]);

        Product::create([
            'ProductName' => 'Biscuit',
            'SupplierId' => 3,
            'UnitPrice' => 500,
        ]);

    }
}
