<?php

use App\Experiencia;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class ExperienciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Experiencia::create([
            'nombre' => '0 - 6 Meses ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => '6 Meses - 1 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => ' 1 - 3 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => ' 3 - 5 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => ' 5 - 7 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => ' 7 - 10 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => ' 10 - 12 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Experiencia::create([
            'nombre' => ' 12 - 15 Años ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


    }
}
