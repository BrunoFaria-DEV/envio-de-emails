<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Schema::enableForeignKeyConstraints();

        $roles = [
            'super-admin',
			'admin',
            'suporte',
            'desenvolvimento',
        ];

        foreach ($roles as $role) {
			Role::create(['name' => $role]);
        }

        $permissions = Permission::get();

        $role = Role::find(1);

        $role->syncPermissions($permissions);
    }
}
