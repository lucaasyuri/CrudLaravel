<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
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
            'name' => 'required|string|max:100|min:2',
            'position' => 'required|string|max:50|min:2',
            'number' => 'required|integer|max:100|min:0',
            'country' => 'required|string|max:100|min:2',
            'born_at' => 'date|before:today',
            'team_id' => 'required|integer|exists:teams,id'
            //before:today =  só aceita datas anteriores a de hoje
            //required: obrigatório | min\max: de caracteres no campo | integer: apenas números inteiros
            //exists: verificando se o time existe | teams: tabela | id do time
        ];
    }

    public function messages() //as mensagens por padrão retornam em inglês, mas queremos que retornem em português
    { 

        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.max' => 'O tamanho máximo do nome é 100 caracteres',
            'name.min' => 'O tamanho mínimo do nome é 2 caracteres',
            'name.string' => 'O campo nome deve ser do tipo string',
            'position.required' => 'O campo posição é obrigatório',
            'position.max' => 'O tamanho máximo da posição é 50 caracteres',
            'position.min' => 'O tamanho mínimo da posição é 2 caracteres',
            'position.string' => 'O campo posição deve ser do tipo string',
            'number.required' => 'O campo número é obrigatório',
            'number.integer' => 'O campo número deve ser do tipo inteiro',
            'number.max' => 'O tamanho máximo do número é 100 caracteres',
            'country.required' => 'O campo país é obrigaório',
            'country.string' => 'O campo country deve ser do tipo string',
            'country.max' => 'O tamanho máximo do país é 100 caracteres',
            'country.min' => 'O tamanho mínimo do país é 2 caracteres',
            'born_at.date' => 'O campo data de nascimento deve ser do tipo date',
            'born_at.before' => 'O campo data de nascimento deve ser anterior ao dia de hoje',
            'team_id.required' => 'O campo time é obrigatório',
            'team_id.integer' => 'O campo time deve ser do tipo inteiro',
            'team_id.exists' => 'O campo time deve ser equivalente ao id de um time existente',
        ];

    }

}
