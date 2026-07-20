<?php

namespace Database\Seeders;

use App\Models\RentalPackage;
use Illuminate\Database\Seeder;

class RentalPackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            ['name' => '1 Jam Trial', 'hours' => 1, 'price' => 5000, 'sort_order' => 1],
            ['name' => '2 Jam', 'hours' => 2, 'price' => 9000, 'sort_order' => 2],
            ['name' => '3 Jam Pro', 'hours' => 3, 'price' => 12000, 'sort_order' => 3],
            ['name' => '6 Jam', 'hours' => 6, 'price' => 20000, 'sort_order' => 4],
            ['name' => '12 Jam', 'hours' => 12, 'price' => 35000, 'sort_order' => 5],
            ['name' => 'Paket Begadang', 'hours' => 9, 'price' => 25000, 'open_time' => '21:00', 'close_time' => '06:00', 'sort_order' => 6],
        ];

        foreach ($packages as $p) {
            RentalPackage::firstOrCreate(['name' => $p['name']], $p);
        }
    }
}
