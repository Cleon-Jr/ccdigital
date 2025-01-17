<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminLoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required|email',
            'pass' => 'required|min:8'
        ];
    }



    public function messages()
    {
        return[
            'login.required' => 'O E-mail é obrigatório!',
            'login.email' => 'Informe um endereço de E-mail válido!',
            'pass.required' => 'A senha é obrigatória!',
            'pass.min' => 'A senha deve conter no mínimo :min caracteres!'
        ];
    }
}
