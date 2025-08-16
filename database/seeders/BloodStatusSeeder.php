<?php

namespace Database\Seeders;

use App\Models\BloodStatus;
use Illuminate\Database\Seeder;

class BloodStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodStatuses = [
            ['id' => 1, 'name' => 'Noble blood', 'short_name' => 'NB'],
            ['id' => 2, 'name' => 'Pure blood', 'short_name' => 'PB'],
            ['id' => 3, 'name' => 'Half blood', 'short_name' => 'HB'],
            ['id' => 4, 'name' => 'Muggle born', 'short_name' => 'MB'],
        ];

        foreach ($bloodStatuses as $bloodStatus) {
            BloodStatus::updateOrCreate(['id' => $bloodStatus['id']], $bloodStatus);
        }
    }
}
