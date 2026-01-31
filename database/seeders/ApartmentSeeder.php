<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\ApartmentStatus;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        $freeStatus = ApartmentStatus::where('code', 'free')->first();

        Apartment::create([
            'title' => '2-Zimmer Wohnung Neukölln',
            'internal_number' => 'APT-001',
            'street_address' => 'Sonnenallee 100',
            'postal_code' => '12045',
            'city' => 'Berlin',
            'state' => 'Berlin',
            'floor' => '1',
            'rooms' => 2,
            'size_sqm' => 55,
            'year_built' => 1995,
            'rent_cold' => 750.00,
            'rent_warm' => 950.00,
            'deposit' => 2250.00,
            'apartment_status_id' => $freeStatus->id,
            'notes' => 'Helle Wohnung mit Balkon',
            'is_active' => true,
        ]);

        Apartment::create([
            'title' => '3-Zimmer Wohnung Charlottenburg',
            'internal_number' => 'APT-002',
            'street_address' => 'Kantstraße 50',
            'postal_code' => '10625',
            'city' => 'Berlin',
            'state' => 'Berlin',
            'floor' => '2',
            'rooms' => 3,
            'size_sqm' => 78,
            'year_built' => 1980,
            'rent_cold' => 1050.00,
            'rent_warm' => 1300.00,
            'deposit' => 3150.00,
            'apartment_status_id' => $freeStatus->id,
            'notes' => null,
            'is_active' => true,
        ]);
    }
}
