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

            TaskTypeSeeder::class,
            TaskStatusSeeder::class,
            TaskStatusTransitionSeeder::class,
            TaskAssignmentRoleSeeder::class,
            TaskTypeAssignmentRoleConfigSeeder::class,
            TaskStatusTransitionAssigneeRuleSeeder::class,
            TaskTypeApartmentStatusRuleSeeder::class,
            
            RepairTypeSeeder::class,
        ]);
    }
}
