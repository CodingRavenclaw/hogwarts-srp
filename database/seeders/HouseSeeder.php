<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $houses = [
            [
                'id' => 4,
                'name' => 'Gryffindor',
                'short_name' => 'GRY',
                'color' => '#740001',
            ],
            [
                'id' => 3,
                'name' => 'Hufflepuff',
                'short_name' => 'HUF',
                'color' => '#EEE117',
            ],
            [
                'id' => 1,
                'name' => 'Ravenclaw',
                'short_name' => 'RAV',
                'color' => '#000A90',
            ],
            [
                'id' => 2,
                'name' => 'Slytherin',
                'short_name' => 'SLY',
                'color' => '#1A472A',
            ],
        ];

        foreach ($houses as $house) {
            House::updateOrCreate(['id' => $house['id']], $house);
        }
    }
}
