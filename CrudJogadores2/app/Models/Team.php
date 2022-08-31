<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [ //campos preenchíveis da aplicação
        'name', 'foundation_year', 'country'
    ];

    public function players()
    {
        return $this->hasMany(Player::class); //hasMany(): relação de um para muitos
    }

}
