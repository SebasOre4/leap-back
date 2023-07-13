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
            'fullname' => ['string', 'between:4,100'],
            'nickname' => ['string', 'between:2,25'],
            'birthday' => ['date', 'before_or_equal:' . now()->format('Y-m-d')],
            'genre' => ['string', 'size:1'],
            'nhc' => ['string', 'regex:/^\d+$/'],
            'prediagnosis' => ['string', 'between:0,250'],
            'crono_birthday' => ['nullable', 'date', 'before_or_equal:' . now()->format('Y-m-d')]
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
            'fullname.between' => 'El Nombre debe tener entre 4 y 100 caracteres.',
            'nhc.string' => 'El  Nro de historia clínica debe ser de tipo texto.',
            'nhc.regex' => 'El  Nro de historia clínica debe contener solo números.',
            'prediagnosis.string' => 'El Prediagnóstico debe ser de tipo texto.',
            'prediagnosis.between' => 'El Prediagnóstico debe tener entre 0 y 250 caracteres.',
            'nickname.string' => 'El Apodo debe ser de tipo texto.',
            'nickname.between' => 'El Apodo debe tener entre 2 y 25 caracteres',
            'birthday.date' => 'La Fecha de Nacimiento debe ser de tipo Fecha',
            'birthday.before_or_equal' => 'La Fecha de Nacimiento debe estar antes de la fecha actual',
            'crono_birthday.date' => 'La Edad Cronológica debe ser de tipo Fecha',
            'crono_birthday.before_or_equal' => 'La Edad Cronológica debe estar antes de la fecha actual',
            'genre.string' => 'El género debe ser de tipo texto.',
            'genre.size' => 'El género debe tener 1 caracter.'
        ];
    }
}
