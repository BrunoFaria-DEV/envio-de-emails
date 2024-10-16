<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class StateSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['id' => 1, 'name' => 'Acre', 'abbreviation' => 'AC', 'ibge_code' => 12, 'ddd' => '68', 'country_id' => 1],
            ['id' => 2, 'name' => 'Alagoas', 'abbreviation' => 'AL', 'ibge_code' => 27, 'ddd' => '82', 'country_id' => 1],
            ['id' => 3, 'name' => 'Amapá', 'abbreviation' => 'AP', 'ibge_code' => 16, 'ddd' => '96', 'country_id' => 1],
            ['id' => 4, 'name' => 'Amazonas', 'abbreviation' => 'AM', 'ibge_code' => 12, 'ddd' => '97,92', 'country_id' => 1],
            ['id' => 5, 'name' => 'Bahia', 'abbreviation' => 'BA', 'ibge_code' => 29, 'ddd' => '77,75,73,74,71', 'country_id' => 1],
            ['id' => 6, 'name' => 'Ceará', 'abbreviation' => 'CE', 'ibge_code' => 23, 'ddd' => '88,85', 'country_id' => 1],
            ['id' => 7, 'name' => 'Distrito Federal', 'abbreviation' => 'DF', 'ibge_code' => 53, 'ddd' => '61', 'country_id' => 1],
            ['id' => 8, 'name' => 'Espírito Santo', 'abbreviation' => 'ES', 'ibge_code' => 32, 'ddd' => '28,27', 'country_id' => 1],
            ['id' => 9, 'name' => 'Goiás', 'abbreviation' => 'GO', 'ibge_code' => 52, 'ddd' => '62,64,61', 'country_id' => 1],
            ['id' => 10, 'name' => 'Maranhão', 'abbreviation' => 'MA', 'ibge_code' => 21, 'ddd' => '99,98', 'country_id' => 1],
            ['id' => 11, 'name' => 'Mato Grosso', 'abbreviation' => 'MT', 'ibge_code' => 51, 'ddd' => '65,66', 'country_id' => 1],
            ['id' => 12, 'name' => 'Mato Grosso do Sul', 'abbreviation' => 'MS', 'ibge_code' => 50, 'ddd' => '67', 'country_id' => 1],
            ['id' => 13, 'name' => 'Minas Gerais', 'abbreviation' => 'MG', 'ibge_code' => 31, 'ddd' => '34,37,31,33,35,38,32', 'country_id' => 1],
            ['id' => 14, 'name' => 'Pará', 'abbreviation' => 'PA', 'ibge_code' => 15, 'ddd' => '91,94,93', 'country_id' => 1],
            ['id' => 15, 'name' => 'Paraíba', 'abbreviation' => 'PB', 'ibge_code' => 25, 'ddd' => '83', 'country_id' => 1],
            ['id' => 16, 'name' => 'Paraná', 'abbreviation' => 'PR', 'ibge_code' => 41, 'ddd' => '43,41,42,44,45,46', 'country_id' => 1],
            ['id' => 17, 'name' => 'Pernambuco', 'abbreviation' => 'PE', 'ibge_code' => 26, 'ddd' => '81,87', 'country_id' => 1],
            ['id' => 18, 'name' => 'Piauí', 'abbreviation' => 'PI', 'ibge_code' => 22, 'ddd' => '89,86', 'country_id' => 1],
            ['id' => 19, 'name' => 'Rio de Janeiro', 'abbreviation' => 'RJ', 'ibge_code' => 33, 'ddd' => '43,41,42,44,45,46', 'country_id' => 1],
            ['id' => 20, 'name' => 'Rio Grande do Norte', 'abbreviation' => 'RN', 'ibge_code' => 24, 'ddd' => '84', 'country_id' => 1],
            ['id' => 21, 'name' => 'Rio Grande do Sul', 'abbreviation' => 'RS', 'ibge_code' => 43, 'ddd' => '53,54,55,51', 'country_id' => 1],
            ['id' => 22, 'name' => 'Rondônia', 'abbreviation' => 'RO', 'ibge_code' => 11, 'ddd' => '69', 'country_id' => 1],
            ['id' => 23, 'name' => 'Roraima', 'abbreviation' => 'RR', 'ibge_code' => 14, 'ddd' => '95', 'country_id' => 1],
            ['id' => 24, 'name' => 'Santa Catarina', 'abbreviation' => 'SC', 'ibge_code' => 42, 'ddd' => '47,48,49', 'country_id' => 1],
            ['id' => 25, 'name' => 'São Paulo', 'abbreviation' => 'SP', 'ibge_code' => 35, 'ddd' => '11,12,13,14,15,16,17,18,19', 'country_id' => 1],
            ['id' => 26, 'name' => 'Sergipe', 'abbreviation' => 'SE', 'ibge_code' => 28, 'ddd' => '79', 'country_id' => 1],
            ['id' => 27, 'name' => 'Tocantins', 'abbreviation' => 'TO', 'ibge_code' => 17, 'ddd' => '63', 'country_id' => 1],
            ['id' => 28, 'name' => 'Exterior', 'abbreviation' => 'EX', 'ibge_code' => 99, 'ddd' => '', 'country_id' => 1],
        ]);
    }

}