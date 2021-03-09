<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telefone' => ['required', 'string', 'max:255'],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Preencha o campo Nome',
            'cpf.required' => 'Preencha o campo CPF',
            'email.required' => 'Preencha o campo E-mail',
            'telefone.required' => 'Preencha o campo Telefone',
            'password.required' => 'Preencha o campo Senha',
            'password_confirmation.required' => 'Preencha o campo Confirmação de Senha',
        ];
    }
}
