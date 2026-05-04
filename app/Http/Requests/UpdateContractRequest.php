<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasPermission('manage_contracts');
    }

    public function rules(): array
    {
        return [
            'apartment_id' => ['required', 'exists:apartments,id'],
            'interested_person_id' => ['required', 'exists:interested_persons,id'],
            'contract_status_id' => ['required', 'exists:contract_statuses,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after:start_date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
