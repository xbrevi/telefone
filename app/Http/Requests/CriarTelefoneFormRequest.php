<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CriarTelefoneFormRequest extends FormRequest
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
            'inputTel' => 'required',  // | digits_between:8,9',
            'selectUnidade' => ['required', Rule::in(['Apartamento', 'Casa', 'Portaria', 'Outro'])],
            'inputNumero' => 'required|max:60'
        ];
    }

    public function messages ()
    {
        return [
            'inputTel.digits_between' => 'O número do telefone precisa ter entre 8 e 9 dígitos!',
            'inputNumero.required' => 'O campo número da unidade é obrigatório',
        ];
    }



}
