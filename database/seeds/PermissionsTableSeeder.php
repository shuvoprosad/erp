<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        [
            ['name' => 'user.view'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],
            ['name' => 'user.name.view'],
            ['name' => 'user.image.view'],
            ['name' => 'user.email.view'],
            ['name' => 'user.mobile.view'],
            ['name' => 'user.address.view'],
            ['name' => 'user.type.view'],
            ['name' => 'user.name.edit'],
            ['name' => 'user.image.edit'],
            ['name' => 'user.email.edit'],
            ['name' => 'user.mobile.edit'],
            ['name' => 'user.address.edit'],
            ['name' => 'user.type.edit'],
            ['name' => 'productlead.view'],
            ['name' => 'productlead.create'],
            ['name' => 'productlead.update'],
            ['name' => 'productlead.delete'],
            ['name' => 'productorder.view'],
            ['name' => 'productorder.create'],
            ['name' => 'productorder.update'],
            ['name' => 'productorder.delete'],
        ];

        foreach ($data as $d) 
        {
            $d['guard_name'] = 'web';
            Permission::create($d);
        }
    }
}
