<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desconto;

class DescontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Desconto::create([
            'produto_id' => '1',
            'desconto' => '10.2 %'
        ]);

        Desconto::create([
            'produto_id' => '2',
            'desconto' => '15.2 %'
        ]);

        Desconto::create([
            'produto_id' => '3',
            'desconto' => '16.2 %'
        ]);

        Desconto::create([
            'produto_id' => '4',
            'desconto' => '17.7 %'
        ]);
    }
}
