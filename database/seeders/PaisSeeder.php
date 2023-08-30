<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::create([
            'pais_idpais'=>5,
            'pais_nombre'=>"ARGENTINA",
            'pais_codarea'=>"54",
            'pais_convenio'=>"S"
        ]);
    }
}
