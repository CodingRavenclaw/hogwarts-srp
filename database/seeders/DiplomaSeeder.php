<?php

namespace Database\Seeders;

use App\Models\Diploma;
use Illuminate\Database\Seeder;

class DiplomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diplomas = [
            ['id' => 1, 'name' => 'Nastily Exhausting Wizarding Test', 'short_name' => 'NEWT'],
            ['id' => 2, 'name' => 'Ordinary Wizarding Level', 'short_name' => 'OWL'],
            ['id' => 3, 'name' => 'Expelled', 'short_name' => 'EXP'],
            ['id' => 4, 'name' => 'Student Exchange', 'short_name' => 'SE'],
        ];

        foreach ($diplomas as $diploma) {
            Diploma::updateOrCreate(['id' => $diploma['id']], $diploma);
        }
    }
}
