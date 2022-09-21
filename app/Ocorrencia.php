<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    protected $table = 'ocorrencias';

    public $timestamps = false;

    protected $fillable = ['data', 'publicador', 'telefone', 'observacao'];
}
