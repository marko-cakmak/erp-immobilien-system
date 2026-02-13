<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'apartment_id' => 'required|exists:apartments,id',
            'type_id'      => 'required|exists:task_types,id',
            'assigned_to'  => 'nullable|exists:users,id',
            'deadline_at'  => 'nullable|date',
            'message'      => 'nullable|string',
        ];
    }
}
