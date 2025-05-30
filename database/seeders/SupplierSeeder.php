<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'CompanyName' => 'tech company',
            'ContactName' => 'Ahmad',
            'City' => 'Damascus',
            'Country' => 'Syria',
            'Phone' => '33324587',
            'Fax' => '33324588',
        ]);

        Supplier::create([
            'CompanyName' => 'Durra',
            'ContactName' => 'سعيد',
            'City' => 'دمشق',
            'Country' => 'سوريا',
            'Phone' => '0113855454',
        ]);

        Supplier::create([
            'CompanyName' => 'كهربائيات المرصي',
            'ContactName' => 'Ahmad',
            'City' => 'حلب',
            'Country' => 'سوريا',
        ]);
    }
}
