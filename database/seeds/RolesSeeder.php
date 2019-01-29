<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([ 
            'name' => 'manager',
            'guard_name' => 'web'
        ]);

        $role2 = Role::create([ 
            'name' => 'editor',
            'guard_name' => 'web'
        ]);
    }
}
