<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
    'campanha_id',
    'nome_produto',
    'descricao'
    ];

    public function rules(){
        return [
            'nome_produto' =>'required|unique:produtos,nome_produto,'.$this->id.'|min:3',
            'descricao' =>'required'
        ];

    }

    /**
     * Relacionamento tabelas
    */
    #region relacionamento

    public function campanha(){
        return $this->belongsTo('App\Models\Campanha');
    }
}
