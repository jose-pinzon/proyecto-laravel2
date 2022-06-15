<?php

use App\Categoria;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Front end',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Categoria::create([
            'nombre' => 'Back end',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Categoria::create([
            'nombre' => 'Full stack',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Categoria::create([
            'nombre' => 'DevOps',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Categoria::create([
            'nombre' => 'DBA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Categoria::create([
            'nombre' => 'UX / UI',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Categoria::create([
            'nombre' => 'Techlead',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
