<?php

use App\Salario;
use Illuminate\Database\Seeder;

class SalarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salario::create([
            'nombre' => '10000',
        ]);
        Salario::create([
            'nombre' => '12000',
        ]);
        Salario::create([
            'nombre' => '15000',
        ]);
        Salario::create([
            'nombre' => 'No mostrar',
        ]);
    }
}
