<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderItem::create([
            'OrderId' => 1,
            'ProductId' => 4,
            'UnitPrice' => 500,
            'Quantity' => 2,
        ]);

        OrderItem::create([
            'OrderId' => 2,
            'ProductId' => 3,
            'UnitPrice' => 250,
            'Quantity' => 2,
        ]);

        OrderItem::create([
            'OrderId' => 2,
            'ProductId' => 2,
            'UnitPrice' => 300,
            'Quantity' => 1,
        ]);

    }
}
