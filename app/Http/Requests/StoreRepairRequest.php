<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRepairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'notes'           => ['nullable', 'string'],
            'status_id'       => ['required', 'exists:task_statuses,id'],
            'photos'          => ['nullable', 'array'],
            'photos.*'        => ['image', 'max:5120'],
            'delete_photos'   => ['nullable', 'array'],
            'delete_photos.*' => ['integer', 'exists:repair_images,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('bearbeitung')
        );
    }
}
