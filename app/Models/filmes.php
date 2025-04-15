<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class filmes extends Model
{
    protected $fillable = [
        'nome',
        'genero',
        'sinopse',
        'lancamento'
    ];
}
