<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterestedPersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->interested_person?->id;

        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => "required|email|max:255|unique:interested_persons,email,$id",
            'phone'      => 'required|string|max:255',
            'street_address' => 'nullable|string|max:255',
            'postal_code'    => 'nullable|string|max:10',
            'city'           => 'nullable|string|max:255',
            'notes'          => 'nullable|string',
        ];
    }
}
