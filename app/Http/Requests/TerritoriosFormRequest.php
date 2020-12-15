<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerritoriosFormRequest extends FormRequest
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
            'condominio' => 'required | min:3',
            'endereco' => 'required | min:3',
            'data_revisao' => 'required | date | before:tomorrow | after:01/01/2014'
        ];
    }

    public function messages ()
    {
        return [
            'condominio.required' => 'Preencha o nome do Território no campo Condominio!',
            'condominio.min' => 'O nome do condominio deve ter mais do que 3 caracteres!',
            'endereco.required' => 'Preencha o endereço do Território!',
            'endereco.min' => 'O campo :attribute precisa ter mais do que 3 caracteres!',
            'data_revisao.required' => 'Informe a data de revisão do território',
            'data_revisao.before' => 'A data de revisão não pode ser maior do que a data de hoje!', 
            'data_revisao.after' => 'A data de revisão precisa ser maior do que 01/01/2014!'   
        ];
    }


}
