<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status_id'      => ['required', 'exists:task_statuses,id'],
            'user_id'        => ['required', 'exists:users,id'],
            'note'           => ['nullable', 'string'],
            'repair_type_id' => ['nullable', 'exists:repair_types,id'],
            'deadline_at'    => ['nullable', 'date'],
        ];
    }
}
