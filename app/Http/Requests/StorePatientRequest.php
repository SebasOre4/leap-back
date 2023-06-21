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
            'name' => ['string', 'between:4,100'],
            'email' => ['string', 'email'],
            'password' => ['regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$'],
            'superadmin' => ['boolean']
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
            'name.string' => "El Nombre debe ser de tipo texto.",
            'name.between' => "El Nombre debe tener entre 4 y 100 caracteres.",
            'email.string' => "El Email debe ser de tipo texto.",
            'email.email' => "Ingrese un Email Válido",
            'password.regex' => "La Contraseña debe tener 8 caraceres y debe contener mayúsculas, minúsculas, números y carácteres especiales.",
            'superadmin.boolean' => "El Rol debe ser booleano."
        ];
    }
}
