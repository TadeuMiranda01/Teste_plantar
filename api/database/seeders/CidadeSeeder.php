<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cidade::create([
            'nome' => 'Paulínia',
            'grupo_id' => '1',
            'idade' => '58',
            'estado' => 'SP'
        ]);

        Cidade::create([
            'nome' => 'Campinas',
            'grupo_id' => '2',
            'idade' => '248',
            'estado' => 'SP'
        ]);

        Cidade::create([
            'nome' => 'Maringá',
            'grupo_id' => '3',
            'idade' => '75',
            'estado' => 'PR'
        ]);

        Cidade::create([
            'nome' => 'Rio de Janeiro',
            'grupo_id' => '4',
            'idade' => '457',
            'estado' => 'RJ'
        ]);
    }
}
