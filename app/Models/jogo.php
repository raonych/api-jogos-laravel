<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jogo extends Model
{
    protected $fillable = [
        'nome',
        'desenvolvedora',
        'sinopse',
        'lancamento'
    ];
}
