<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['name' => 'Koshi Province', 'number' => 1],
            ['name' => 'Madhesh Province', 'number' => 2],
            ['name' => 'Bagmati Province', 'number' => 3],
            ['name' => 'Gandaki Province', 'number' => 4],
            ['name' => 'Lumbini Province', 'number' => 5],
            ['name' => 'Karnali Province', 'number' => 6],
            ['name' => 'Sudurpashchim Province', 'number' => 7],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
