<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminUserRequest extends FormRequest
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
            'fullname' => 'required',
            'cpf' => 'required|unique:tbadmins,adm_cpf',
            'email' => 'required|email',
            'pass' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Nome completo obrigatório!',
            'cpf.required' => 'O CPF é obrigatório!',
            'cpf.unique' => 'Este CPF já existe em nossa base de dados!',
            'email.required' => 'O E-mail é obrigatório!',
            'email.email' => 'Informe um endereço de E-mail válido!',
            'pass.required' => 'A Senha é obrigatória!',
            'pass.min' => 'A senha deve conter no mínimo :min caracteres!'
        ];
    }
}
