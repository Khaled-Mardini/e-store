<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'FirstName' => 'Mohamad',
            'LastName' => 'Zid',
            'City' => 'Beirut',
            'Country' => 'Lebanon',
            'Phone' => '02015485546',
        ]);

        Customer::create([
            'FirstName' => 'Samer',
            'LastName' => 'Salam',
            'City' => 'Damascus',
            'Country' => 'Syria',
            'Phone' => '555456687',
        ]);
    }
}
