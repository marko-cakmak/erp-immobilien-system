<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApartmentStatus;

class ApartmentStatusSeeder extends Seeder
{
    public function run(): void
    {
        ApartmentStatus::insert([
            [
                'code' => 'free',
                'label' => 'Frei',
                'color' => '#dc3545',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'code' => 'viewing',
                'label' => 'In Besichtigung',
                'color' => '#fd7e14',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'code' => 'reserved',
                'label' => 'Reserviert',
                'color' => '#0d6efd',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'code' => 'rented',
                'label' => 'Vermietet',
                'color' => '#198754',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);
    }
}
