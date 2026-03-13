<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RepairType;

class RepairTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['key' => 'wasser', 'name' => 'Wasser'],
            ['key' => 'heizung', 'name' => 'Heizung'],
            ['key' => 'strom', 'name' => 'Elektrik'],
            ['key' => 'sonstiges', 'name' => 'Sonstiges'],
        ];

        foreach ($types as $index => $type) {

            RepairType::updateOrCreate(
                ['key' => $type['key']],
                [
                    'name' => $type['name'],
                    'sort_order' => $index,
                ]
            );

        }
    }
}
