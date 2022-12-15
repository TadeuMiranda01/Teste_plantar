<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    // protected $table = 'cidades';

    protected $fillable = [
        'grupo_id',
        'nome',
        'idade',
        'estado'
    ];

    public function rules(){
        return [
            'grupo_id' =>'exists:grupos,id',
            'nome' =>'required|unique:cidades,nome,'.$this->id.'|min:3',
            'idade' =>'required|integer',
            'estado' =>'required'
        ];

    }

    /**
     * Relacionamento tabelas
    */
    #region relacionamento

    public function grupo(){
        return  $this->belongsTo('App\Models\Grupo');
    }

}
