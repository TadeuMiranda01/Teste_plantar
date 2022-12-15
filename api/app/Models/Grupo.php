<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    // protected $table = 'grupos';

    protected $fillable = [
        'campanha_id',
        'nome_grupo'
    ];

    public function rules(){
        return [
            'nome_grupo' =>'required|unique:grupos,nome_grupo,'.$this->id.'|min:3'
        ];

    }

    /**
     * Relacionamento tabelas
    */
    #region relacionamento

    public function cidade(){
        return $this->hasMany('App\Models\Cidade');
    }

    public function campanha(){
        return $this->belongsTo('App\Models\Campanha');
    }
}
