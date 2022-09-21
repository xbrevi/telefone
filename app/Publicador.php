<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicador extends Model
{

    protected $table = 'publicadores';

    public $timestamps = false;

    protected $fillable = ['nome'];
    
}
