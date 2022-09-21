<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class OcorrenciasRequest extends FormRequest
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
            'publicador' => 'required',
            'data' => 'required | date',
        ];
    }

    public function messages ()
    {
        return [
            'publicador.required' => 'Selecione um Publicador!',
            'data.required' => 'Informe a data da ocorrência',
            'data.date' => 'A data da ocorrência é inválida',
        ];
    }

}



