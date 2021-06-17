<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependente extends Model
{
    protected $fillable = ['nome', 'dt_nascimento'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected  $table = 'dependentes';

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 0;

    public function cadastros()
    {
        return $this->belongsToMany(Cadastro::class, 'cadastro_dependente', 'dependente_id');
    }

}
