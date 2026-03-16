<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTypeApartmentStatusRuleSeeder extends Seeder
{
    public function run(): void
    {
        $besichtigungTypeId = DB::table('task_types')->where('key', 'besichtigung')->value('id');

        $inProgressStatusId  = DB::table('task_statuses')->where('key', 'in_progress')->value('id');
        $abgeschlossenStatusId = DB::table('task_statuses')->where('key', 'abgeschlossen')->value('id');

        $viewingApartmentStatusId  = DB::table('apartment_statuses')->where('code', 'viewing')->value('id');
        $reservedApartmentStatusId = DB::table('apartment_statuses')->where('code', 'reserved')->value('id');

        DB::table('task_type_apartment_status_rules')->insert([
            [
                'task_type_id'        => $besichtigungTypeId,
                'task_status_id'      => $inProgressStatusId,
                'apartment_status_id' => $viewingApartmentStatusId,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
            [
                'task_type_id'        => $besichtigungTypeId,
                'task_status_id'      => $abgeschlossenStatusId,
                'apartment_status_id' => $reservedApartmentStatusId,
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);
    }
}
