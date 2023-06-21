<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'between:4,100'],
            'email' => ['string', 'email'],
            'password' => ['regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/'],
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
            'password.regex' => "La Contraseña debe tener 8 caraceres y debe contener mayúsculas, minúsculas y números.",
            'superadmin.boolean' => "El Rol debe ser booleano."
        ];
    }
}
