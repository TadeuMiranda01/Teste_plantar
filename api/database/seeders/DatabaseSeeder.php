<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CidadeSeeder::class);
        $this->call(GrupoSeeder::class);
        $this->call(CampanhaSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(DescontoSeeder::class);
    }
}
