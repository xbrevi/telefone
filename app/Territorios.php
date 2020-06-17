<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Territorios extends Model
{
    protected $table = "territorios";
    public $timestamps = false;
    //protected $fillable = ['nome'];

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

}
