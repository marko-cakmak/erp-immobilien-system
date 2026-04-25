<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBesichtigungRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'besichtigung_at'       => ['required', 'date'],
            'interessent_ids'       => ['required', 'array', 'min:1'],
            'interessent_ids.*'     => ['integer', 'exists:interested_persons,id'],
            'result_interessent_id' => ['nullable', 'integer', 'exists:interested_persons,id'],
            'notes'                 => ['nullable', 'string'],
            'status_id'             => ['required', 'integer', 'exists:task_statuses,id'],
        ];
    }
}
