<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
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
            'titulo' => 'required|min:3',
            'data' => 'required',
            'descricao' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Preencha o campo Título',
            'data.required' => 'Preencha o campo Data',
            'descricao.required' => 'Preencha o campo Descrição'
        ];
    }
}
