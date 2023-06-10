<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'between:5,100'],
            'nickname' => ['required', 'string', 'between:2,25'],
            'birthday' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d')],
            'genre' => ['required', 'string', 'size:1']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'fullname.required' => 'El Nombre es requerido.',
            'fullname.string' => 'El Nombre debe ser de tipo texto.',
            'fullname.between' => 'El Nombre debe tener entre 5 y 100 caracteres.',
            'nickname.required' => 'El Apodo es requerido.',
            'nickname.string' => 'El Apodo debe ser de tipo texto.',
            'nickname.between' => 'El Apodo debe tener entre 2 y 25 caracteres',
            'birthday.required' => 'La Fecha de Nacimiento es requerida.',
            'birthday.date' => 'La Fecha de Nacimiento debe ser de tipo Fecha',
            'birthday.before_or_equal' => 'La Fecha debe estar antes de la fecha actual',
            'genre.required' => 'El género es requerido.',
            'genre.string' => 'El género debe ser de tipo texto.',
            'genre.size' => 'El género debe tener 1 caracter.'
        ];
    }
}
