<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApartmentStatus;

class ApartmentStatusSeeder extends Seeder
{
    public function run(): void
    {
        ApartmentStatus::upsert(
            [
                [
                    'code'       => 'free',
                    'label'      => 'Frei',
                    'color'      => '#e03050',
                    'sort_order' => 1,
                    'is_active'  => true,
                ],
                [
                    'code'       => 'viewing',
                    'label'      => 'In Besichtigung',
                    'color'      => '#f47c20',
                    'sort_order' => 2,
                    'is_active'  => true,
                ],
                [
                    'code'       => 'reserved',
                    'label'      => 'Reserviert',
                    'color'      => '#2f7fd4',
                    'sort_order' => 3,
                    'is_active'  => true,
                ],
                [
                    'code'       => 'rented',
                    'label'      => 'Vermietet',
                    'color'      => '#1a9e5c',
                    'sort_order' => 4,
                    'is_active'  => true,
                ],
            ],
            ['code'],
            ['color', 'label', 'sort_order', 'is_active']
        );
    }
}
