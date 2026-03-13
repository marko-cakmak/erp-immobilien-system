<?php

namespace App\Http\Requests;

use App\Models\TaskType;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'apartment_id' => ['required', 'exists:apartments,id'],
            'type_id'      => ['required', 'exists:task_types,id'],
            'repair_type_id' => [
                'nullable',
                'exists:repair_types,id',
                'required_if:type_id,' . TaskType::where('key','reparatur')->value('id')
            ],
            'assigned_to'  => ['required', 'exists:users,id'],
            'deadline_at'  => ['nullable', 'date', 'after:now'],
            'message'      => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'apartment_id.required' => 'Bitte eine Wohnung auswählen.',
            'apartment_id.exists'   => 'Die gewählte Wohnung existiert nicht.',
            'type_id.required'      => 'Bitte einen Aufgabentyp wählen.',
            'type_id.exists'        => 'Der gewählte Aufgabentyp ist ungültig.',
            'assigned_to.required'  => 'Bitte einen Bearbeiter auswählen.',
            'assigned_to.exists'    => 'Der gewählte Bearbeiter existiert nicht.',
            'deadline_at.date'      => 'Das Datum ist ungültig.',
            'deadline_at.after'     => 'Das Fälligkeitsdatum muss in der Zukunft liegen.',
            'message.max'           => 'Die Nachricht darf maximal 2000 Zeichen enthalten.',
        ];
    }
}
