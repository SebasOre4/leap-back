<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'denver_test' => ['required', 'json'],
            'recomendations' => [ 'string', 'between:3,500'],
            'result' => ['required', 'string', 'between:3,10'],
            'evaluated_age' => ['required', 'decimal:0,2']
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
            'denver_test.required' => "El Test es requerido.",
            'denver_test.string' => "El Test debe ser un json.",
            'recomendations.string' => 'La recomendación debe ser de tipo texto.',
            'recomendations.between' => 'La recomendación debe tener entre 3 y 500 caracteres.',
            'result.required' => 'El resultado es un campo obligatorio.',
            'result.string' => 'El resultado debe ser de tipo texto.',
            'result.between' => 'El resultado debe tener entre 3 y 10 caracteres.',
            'result.required' => 'La edad de evaluación es un campo obligatorio.',
            'result.double' => 'La edad de evaluación debe ser un número.',
        ];
    }
}
