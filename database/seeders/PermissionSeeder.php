<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $permissions = [
            'editar informacoes basicas',

            'visualizar usuario',
            'criar usuario',
            'editar usuario',
            'apagar usuario',

            'visualizar cliente',
            'criar cliente',
            'editar cliente',
            'apagar cliente',

            'visualizar conta',
            'criar conta',
            'editar conta',
            'apagar conta',

            'visualizar disparo',
            'criar disparo',
            'editar disparo',
            'apagar disparo',
        ];

        foreach ($permissions as $permission) {
			Permission::create(['name' => $permission]);
        }
    }
}
