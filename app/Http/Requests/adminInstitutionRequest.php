<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminInstitutionRequest extends FormRequest
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
            'cnpj' => 'required|min:14',
            'description' => 'required',
            'address' => 'required',
            'district' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }


    public function messages()
    {
        return [
            'cnpj.required' => 'O CNPJ é obrigatório!',
            'cnpj.max' => 'O CNPJ deve conter 14 caracteres!',
            'cnpj.min' => 'O CNPJ deve conter 14 caracteres!',
            'description.required' => 'Informe o nome da instituição!',
            'address.required' => 'Informe o endereço da instituição!',
            'district.required' => 'O bairro é obrigatório!',
            'logo.image' => 'Arquivo de imagem inválido!',
            'logo.mimes' => 'Extensão de arquivo inválida!',
            'logo.max' => 'O tamanho do arquivo não pode exceder :max!'
        ];
    }
}
