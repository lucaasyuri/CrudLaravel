<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //todos os usuários podem acessar
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [ //regras são implementadas dentro do return[];
            'name' => 'required|max:50|unique:teams,name,' . $this->id . '|min:2',
            'country' => 'required|max:100|min:2',
            'foundation_year' => 'required|integer'
            //required: obrigatório | min\max: de caracteres no campo | integer: apenas números inteiros
            
            // quando edito e tento salvar o registro, da erro que o time ja está cadastrado, logo tenho que falar que o nome
            // pertence à esse time e não dê esse erro
            // unique:teams,name,' . $this->id . '
        ];

    }

    public function messages() //as mensagens por padrão retornam em inglês, mas queremos que retornem em português
    { 

        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.max' => 'O tamanho máximo do nome é 50 caracteres',
            'name.unique' => 'O nome do time já está cadastrado.',
            'name.min' => 'O tamanho mínimo do nome é 2 caracteres',
            'country.required' => 'O campo país é obrigaório',
            'country.max' => 'O tamanho máximo do país é 100 caracteres',
            'country.min' => 'O tamanho mínimo do país é 2 caracteres',
            'foundation_year.required' => 'O campo ano é obrigatório',
            'foundation_year.integer' => 'O ano deve ser um número inteiro',
        ];

    }
}
