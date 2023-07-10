<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UsuarioRequest extends FormRequest
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
            'nome' => 'required|min:4',
            'email' => 'required|email|unique:usuarios,email',
            'data_nascimento' => 'required|min:4',
            'cpf' => 'required|min:6',
            'password' => 'required|min:6',
            'cep' => 'required'

            /*
            ,
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->symbols()
            ]
             'estado' => 'min:4|max:16',
             'cidade' => 'min:4|max:16',
             'bairro' => 'min:4|max:16',
             'complemento' => 'min:4|max:16'
             */
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'data_nascimento.required' => 'Data de nascimento é obrigatório',
            'cpf.required' => 'CPF é obrigatório',
            'password.required' => 'Senha é obrigatório',
            'valor.decimal' => 'Formato do valor errado',
        ];
    }
}
