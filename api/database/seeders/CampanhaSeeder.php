<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campanha;

class CampanhaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campanha::create([
            'grupo_id' => '1',
            'nome_campanha' => 'Peru de Natal',
            'status' => 1
        ]);

        Campanha::create([
            'grupo_id' => '2',
            'nome_campanha' => 'Frango de Natal',
            'status' => 1
        ]);

        Campanha::create([
            'grupo_id' => '3',
            'nome_campanha' => 'Panetone de Natal',
            'status' => 1
        ]);

        Campanha::create([
            'grupo_id' => '4',
            'nome_campanha' => 'Ovo de Natal',
            'status' => 1
        ]);
    }
}
