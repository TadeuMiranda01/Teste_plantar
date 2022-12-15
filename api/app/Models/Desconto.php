<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'desconto'
    ];

    public function rules(){
        return [
            'desconto' =>'required|unique:descontos,desconto,'.$this->id.'|min:3',
        ];

    }

    /**
     * Relacionamento tabelas
    */
    #region relacionamento

    public function produto(){
        return $this->belongsTo('App\Models\Produto');
    }
}
