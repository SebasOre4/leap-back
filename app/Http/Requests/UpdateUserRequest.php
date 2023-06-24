<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $user = Auth::user();

        return [
            'name' => ['string', 'between:4,100'],
            'email' => ['string', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', 'confirmed'],
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
            'email.unique' => "El correo ya esta registrado",
            'email.email' => "Ingrese un Email Válido",
            'password.regex' => "La Contraseña debe tener 8 caraceres y debe contener mayúsculas, minúsculas y números.",
            'password.confirmed' => 'La confirmación de contraseña no coincide con la contraseña.',
            'superadmin.boolean' => "El Rol debe ser booleano."
        ];
    }
}
