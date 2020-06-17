<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = "telefones";
    protected $primaryKey = 'id_telefone';

    public $timestamps = false;

    protected $fillable = ['territorios_id', 'unidade', 'numero_unidade', 'telefone', 'status'];
     
    public function territorio()
    {
        return $this->belongsTo(Territorios::class);
    }

}
