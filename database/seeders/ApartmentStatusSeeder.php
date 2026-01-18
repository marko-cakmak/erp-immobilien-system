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
                'color' => 'danger',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'code' => 'reserved',
                'label' => 'Reserviert',
                'color' => 'warning',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'code' => 'viewing',
                'label' => 'In Besichtigung',
                'color' => 'info',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'code' => 'rented',
                'label' => 'Vermietet',
                'color' => 'success',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);
    }
}
