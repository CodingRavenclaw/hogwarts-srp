<?php

namespace Database\Factories;

use App\Models\Diploma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Diploma>
 */
class DiplomaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;

        $diplomas = [
            ['name' => 'Nastily Exhausting Wizarding Test', 'short_name' => 'NEWT'],
            ['name' => 'Ordinary Wizarding Level', 'short_name' => 'OWL'],
            ['name' => 'Expelled', 'short_name' => 'EXP'],
            ['name' => 'Student Exchange', 'short_name' => 'SE'],
        ];

        $diploma = $diplomas[$counter % count($diplomas)];
        $counter++;

        return [
            'name' => $diploma['name'],
            'short_name' => $diploma['short_name'],
        ];
    }
}
