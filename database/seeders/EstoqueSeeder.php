<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EstoqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("pt_BR");
        foreach (\range(1, 10) as $index) {
            DB::table('estoque')->insert([
                'nome' => $faker->word,
                'codigo' => $faker->randomNumber($nbDigits = 9, $strict = false),
                'marca' => $faker->company,
                'preco' => $faker->numberBetween($min = 500, $max = 20000),
                'descricao' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true),
            ]);
        }
    }
}
