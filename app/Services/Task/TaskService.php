<?php

namespace App\Services\Task;

use App\Models\Apartment;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\User;
use Illuminate\Http\Request;

class TaskService
{
    public function search(Request $request)
    {
        return Task::with(['type', 'status', 'apartment'])
            ->latest()
            ->paginate(15);
    }

    public function getFormData(): array
    {
        $apartments = Apartment::with(['coverImage', 'interestedPersons'])
            ->where('is_active', true)
            ->orderBy('title')
            ->get();

        return [
            'apartments' => $apartments,
            'types'      => TaskType::orderBy('name')->get(),
            'users'      => User::orderBy('name')->get(),
        ];
    }

    public function create(array $data): Task
    {
        $data['status_id']  = TaskStatus::where('key', 'neu')->first()->id;
        $data['created_by'] = auth()->id();

        return Task::create($data);
    }
}
