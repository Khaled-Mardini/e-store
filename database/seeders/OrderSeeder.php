<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'OrderDate' => '2020-7-5',
            'OrderNumber' => 5,
            'CustomerId' => 1,
            'TotalAmount' => 1000,
        ]);

        Order::create([
            'OrderDate' => '2020-8-14',
            'OrderNumber' => 8,
            'CustomerId' => 2,
            'TotalAmount' => 800,
        ]);

    }
}
