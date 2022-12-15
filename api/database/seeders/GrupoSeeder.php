<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grupo::create([
            'campanha_id' => '1',
            'nome_grupo' => 'Grupo A'
        ]);

        Grupo::create([
            'campanha_id' => '2',
            'nome_grupo' => 'Grupo B'
        ]);

        Grupo::create([
            'campanha_id' => '3',
            'nome_grupo' => 'Grupo C'
        ]);

        Grupo::create([
            'campanha_id' => '4',
            'nome_grupo' => 'Grupo D'
        ]);
    }
}
