<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    protected $fillable = ['nome', 'dt_nascimento', 'email', 'size', 'file_name', 'status'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected  $table = 'cadastros';

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 0;


    public function dependentes()
    {
        return $this->belongsToMany(Dependente::class, 'cadastro_dependente', 'cadastro_id');
    }

}
