<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('info')->insert([
            ['email1' => 'contato@hbcs.com.bo', 'user_id' => 1]
        ]);
    }
}
