<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'between:4,100'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/'],
            'superadmin' => ['required', 'boolean']
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
            'name.required' => "El Nombre es requerido.",
            'name.string' => "El Nombre debe ser de tipo texto.",
            'name.between' => "El Nombre debe tener entre 4 y 100 caracteres.",
            'email.required' => "El Email es requerido.",
            'email.unique' => "El correo ya esta registrado",
            'email.string' => "El Email debe ser de tipo texto.",
            'email.email' => "Ingrese un Email Válido",
            'password.required' => "La Contraseña es requerida.",
            'password.regex' => "La Contraseña debe tener 8 caraceres y debe contener mayúsculas, minúsculas y números.",
            'superadmin.required' => "El Rol es requerido.",
            'superadmin.boolean' => "El Rol debe ser booleano."
        ];
    }
}
