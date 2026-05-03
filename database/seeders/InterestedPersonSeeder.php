<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestedPerson;

class InterestedPersonSeeder extends Seeder
{
    public function run(): void
    {
        InterestedPerson::create([
            'first_name' => 'Stefan',
            'last_name' => 'W.',
            'email' => 'stefan.w@example.com',
            'phone' => '+49 176 12345678',
            'street_address' => 'Hauptstraße 25',
            'postal_code' => '10115',
            'city' => 'Berlin',
            'notes' => '',
            'is_active' => true,
        ]);

        InterestedPerson::create([
            'first_name' => 'Anna',
            'last_name' => 'S.',
            'email' => 'anna.s@example.com',
            'phone' => '+49 176 98765432',
            'street_address' => 'Friedrichstraße 12',
            'postal_code' => '10117',
            'city' => 'Berlin',
            'notes' => '',
            'is_active' => true,
        ]);

        InterestedPerson::create([
            'first_name' => 'Thomas',
            'last_name' => 'M.',
            'email' => 'thomas.m@example.com',
            'phone' => '+49 176 55544433',
            'street_address' => 'Kurfürstendamm 88',
            'postal_code' => '10709',
            'city' => 'Berlin',
            'notes' => '',
            'is_active' => true,
        ]);
    }
}
