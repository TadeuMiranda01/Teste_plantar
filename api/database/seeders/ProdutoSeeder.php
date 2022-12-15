<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produto::create([
            'campanha_id' => '1',
            'nome_produto' => 'Frango',
            'descricao' => 'Ta sem dimdim e quer enganar as pessoas'
        ]);

        Produto::create([
            'campanha_id' => '2',
            'nome_produto' => 'Peru',
            'descricao' => 'você é daquele que gosta de uma ave, mas não tem coragem de matar uma galinha...seus problemas acabaram'
        ]);

        Produto::create([
            'campanha_id' => '3',
            'nome_produto' => 'Coca-Cola',
            'descricao' => 'Gelada e melhor que cerveja '
        ]);

        Produto::create([
            'campanha_id' => '4',
            'nome_produto' => 'TV',
            'descricao' => 'TV de 42" para você e sua familia'
        ]);
    }
}
