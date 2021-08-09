<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EstoqueCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("pt_BR");
            DB::table('estoque_categoria')->insert(
                [
                    [
                        'categoria' => "Nacional",
                    ],
                    [
                        'categoria' => "Importado",
                    ]
                ]

            );
    }
}
