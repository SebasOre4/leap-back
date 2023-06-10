<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['string', 'between:5,100'],
            'nickname' => ['string', 'between:2,25'],
            'birthday' => ['date', 'before_or_equal:' . now()->format('Y-m-d')],
            'genre' => ['string', 'size:1']
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
            'fullname.string' => 'El Nombre debe ser de tipo texto.',
            'fullname.between' => 'El Nombre debe tener entre 5 y 100 caracteres.',
            'nickname.string' => 'El Apodo debe ser de tipo texto.',
            'nickname.between' => 'El Apodo debe tener entre 2 y 25 caracteres',
            'birthday.date' => 'La Fecha de Nacimiento debe ser de tipo Fecha',
            'birthday.before_or_equal' => 'La Fecha debe estar antes de la fecha actual',
            'genre.string' => 'El género debe ser de tipo texto.',
            'genre.size' => 'El género debe tener 1 caracter.'
        ];
    }
}
