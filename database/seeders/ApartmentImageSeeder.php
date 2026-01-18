<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\ApartmentImage;

class ApartmentImageSeeder extends Seeder
{
    public function run(): void
    {
        $apartment = Apartment::first();

        if (! $apartment) {
            return;
        }

        ApartmentImage::create([
            'apartment_id' => $apartment->id,
            'path' => 'apartments/' . $apartment->id . '/living-room.jpg',
            'position' => 1,
            'is_cover' => true,
        ]);

        ApartmentImage::create([
            'apartment_id' => $apartment->id,
            'path' => 'apartments/' . $apartment->id . '/bedroom.jpg',
            'position' => 2,
            'is_cover' => false,
        ]);
    }
}
