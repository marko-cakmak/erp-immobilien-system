<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,

            ApartmentStatusSeeder::class,
            ApartmentSeeder::class,
            ApartmentImageSeeder::class,

            InterestedPersonSeeder::class,
            ApartmentInterestSeeder::class,

            TaskTypeSeeder::class,
            TaskStatusSeeder::class,

            TaskStatusTransitionSeeder::class,
            TaskStatusTransitionAssigneeRuleSeeder::class,
            TaskTypeApartmentStatusRuleSeeder::class,

            RepairTypeSeeder::class,
        ]);
    }
}
