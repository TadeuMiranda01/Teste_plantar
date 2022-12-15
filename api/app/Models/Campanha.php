<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_id',
        'nome_campanha'
    ];

    public function rules() {
        return [
            'grupo_id' => 'exists:grupos,id',
            'nome_campanha' => 'required|unique:cidades,nome_campanha,'.$this->id.'|min:3'
        ];
    }

    /**
     * Relacionamento tabelas
    */
    #region relacionamento}

    public function grupo(){
        return $this->belongsTo('App\Models\Grupo');
    }

    public function produto(){
        return $this->hasMany('App\Models\Produto');
    }
}

