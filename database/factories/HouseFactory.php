<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<House>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;

        $houses = [
            ['name' => 'Gryffindor', 'short_name' => 'GRY', 'color' => '#740001'],
            ['name' => 'Hufflepuff', 'short_name' => 'HUF', 'color' => '#EEE117'],
            ['name' => 'Ravenclaw', 'short_name' => 'RAV', 'color' => '#000A90'],
            ['name' => 'Slytherin', 'short_name' => 'SLY', 'color' => '#1A472A'],
        ];

        $house = $houses[$counter % count($houses)];
        $counter++;

        return [
            'name' => $house['name'],
            'short_name' => $house['short_name'],
            'color' => $house['color'],
        ];
    }
}
