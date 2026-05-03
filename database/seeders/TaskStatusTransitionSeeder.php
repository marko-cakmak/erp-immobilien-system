<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\TaskStatusTransition;

class TaskStatusTransitionSeeder extends Seeder
{
    public function run(): void
    {
        $transitions = [
            ['from' => 'open', 'to' => 'in_progress'],
            ['from' => 'in_progress', 'to' => 'done'],
            ['from' => 'in_progress', 'to' => 'cancelled'],
            ['from' => 'open', 'to' => 'cancelled'],
        ];

        foreach ($transitions as $transition) {
            $fromStatusId = TaskStatus::where('key', $transition['from'])->value('id');
            $toStatusId = TaskStatus::where('key', $transition['to'])->value('id');

            if (!$fromStatusId || !$toStatusId) {
                continue;
            }

            TaskStatusTransition::updateOrCreate(
                [
                    'from_status_id' => $fromStatusId,
                    'to_status_id' => $toStatusId,
                ],
                []
            );
        }
    }
}
