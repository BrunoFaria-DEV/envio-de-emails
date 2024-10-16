<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('countries')->insert([
			'name' => 'Brazil',
            'pt_name' => 'Brasil',
            'abbreviation' => 'BR',
            'bacen' => 1058,
		]);
    }
}
