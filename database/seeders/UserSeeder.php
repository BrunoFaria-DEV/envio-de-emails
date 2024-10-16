<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user = User::create([
			'name' => 'Administrador',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
            'slug' => 'administrador',
            'created_at' => now(),
            'updated_at' => now(),
		]);

        $user->assignRole('super-admin');
    }
}
