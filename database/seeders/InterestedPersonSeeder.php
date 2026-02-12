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
            'last_name' => 'Weber',
            'email' => 'stefan.weber@example.com',
            'phone' => '+49 176 12345678',
            'street_address' => 'Hauptstraße 25',
            'postal_code' => '10115',
            'city' => 'Berlin',
            'notes' => '',
            'is_active' => true,
        ]);

        InterestedPerson::create([
            'first_name' => 'Anna',
            'last_name' => 'Schmidt',
            'email' => 'anna.schmidt@example.com',
            'phone' => '+49 176 98765432',
            'street_address' => 'Friedrichstraße 12',
            'postal_code' => '10117',
            'city' => 'Berlin',
            'notes' => '',
            'is_active' => true,
        ]);

        InterestedPerson::create([
            'first_name' => 'Thomas',
            'last_name' => 'Müller',
            'email' => 'thomas.mueller@example.com',
            'phone' => '+49 176 55544433',
            'street_address' => 'Kurfürstendamm 88',
            'postal_code' => '10709',
            'city' => 'Berlin',
            'notes' => '',
            'is_active' => true,
        ]);
    }
}
