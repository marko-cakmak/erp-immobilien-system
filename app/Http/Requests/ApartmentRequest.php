<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->hasFile('images')) {
            $tempImages = session()->get('apartment_temp_images', []);

            foreach ($this->file('images') as $position => $file) {
                if (!$file) {
                    continue;
                }

                $path = $file->store('tmp/apartments', 'public');
                $tempImages[$position] = $path;
            }

            session()->put('apartment_temp_images', $tempImages);
        }
    }

    public function rules(): array
    {
        $apartmentId = $this->route('apartment')?->id;

        return [
            'title' => 'required|string|max:255',

            'internal_number' => [
                'required',
                'string',
                'max:50',
                'unique:apartments,internal_number,' . $apartmentId,
            ],

            'street_address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',

            'floor' => 'nullable|integer',
            'rooms' => 'required|numeric|min:0',
            'size_sqm' => 'required|numeric|min:0',

            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),

            'rent_cold' => 'required|numeric|min:0',
            'rent_warm' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',

            'apartment_status_id' => 'required|exists:apartment_statuses,id',

            'notes' => 'nullable|string',
            'is_active' => 'nullable',

            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            'delete_images' => 'nullable|array',
            'delete_images.*' => 'nullable|integer',
        ];
    }
}
