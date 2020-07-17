<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Territorios extends Model
{
    protected $table = "territorios";
    public $timestamps = false;
    protected $fillable = ['condominio', 'endereco', 'revisao', 'total_apartamentos'];

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

}
