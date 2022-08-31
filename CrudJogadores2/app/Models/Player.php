<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    //campos preenchíveis
    protected $fillable = [
        'name',
        'position',
        'number',
        'country',
        'born_at',
        'team_id',
    ];

    //as variáveis delcaradas são: nome e o tipo que ocorre o casts
    protected $casts = [
        'born_at' =>'datetime' //facilidate do Laravel para trabalhar com datas
    ];

    //relacionamento com a tabela de 'Times'
    public function team()
    {
        return $this->belongsTo(Team::class); //belongsTo(): jogador pertence à um time
    }

}
