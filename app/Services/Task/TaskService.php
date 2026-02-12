<?php

namespace App\Services\Task;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskService
{
    public function search(Request $request)
    {
        return Task::with(['type', 'status', 'apartment'])
            ->latest()
            ->paginate(15);
    }
}
