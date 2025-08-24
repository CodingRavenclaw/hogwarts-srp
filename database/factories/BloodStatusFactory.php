<?php

namespace Database\Factories;

use App\Models\BloodStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BloodStatus>
 */
class BloodStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;

        $bloodStatuses = [
            ['name' => 'Noble blood', 'short_name' => 'NB'],
            ['name' => 'Pure blood', 'short_name' => 'PB'],
            ['name' => 'Half blood', 'short_name' => 'HB'],
            ['name' => 'Muggle born', 'short_name' => 'MB'],
        ];

        $bloodStatus = $bloodStatuses[$counter % count($bloodStatuses)];
        $counter++;

        return [
            'name' => $bloodStatus['name'],
            'short_name' => $bloodStatus['short_name'],
        ];
    }
}
