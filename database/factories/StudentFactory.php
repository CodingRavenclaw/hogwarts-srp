<?php

namespace Database\Factories;

use App\Models\BloodStatus;
use App\Models\Diploma;
use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['f', 'm']),
            'birthday' => $this->faker->date('Y-m-d', '2010-01-01'),
            'enrollment_date' => $this->faker->date('Y-m-d', '2015-01-01'),
            'graduation_date' => $this->faker->optional()->date('Y-m-d', '2023-01-01'),

            'house_id' => House::factory(),
            'blood_status_id' => BloodStatus::factory(),
            'diploma_id' => Diploma::factory(),
        ];
    }
}
