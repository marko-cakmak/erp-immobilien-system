<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ApartmentSeeder::class,
            ApartmentImageSeeder::class,
            InterestedPersonSeeder::class,
            RepairTypeSeeder::class,
        ]);
    }
}
