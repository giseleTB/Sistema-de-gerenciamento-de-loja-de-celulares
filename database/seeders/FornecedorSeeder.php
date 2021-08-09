<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FornecedorSeeder extends Seeder
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
            DB::table('fornecedor')->insert([
                'nome' => $faker->name,
                'telefone' => $faker->e164PhoneNumber,
                'email' => $faker->email,
            ]);
        }
    }
}
