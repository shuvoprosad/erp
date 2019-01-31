<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'ashik',
            'email' => 'ashik@gmail.com',
            'password' => bcrypt('0574'),
        ]);

        DB::table('users')->insert([
            'name' => 'shuvo prosad',
            'email' => 'shuvoprosad@gmail.com',
            'password' => bcrypt('0574'),
        ]);

        DB::table('users')->insert([
            'name' => 'abdur rahim',
            'email' => 'rahim@gmail.com',
            'password' => bcrypt('0574'),
        ]);

        $admin_role = Role::create([ 
            'name' => 'super_admin',
            'guard_name' => 'web'
        ]);
        
        $admin = User::findOrFail(1);

        $admin->assignRole('super_admin');

        $admin2 = User::findOrFail(2);

        $admin2->assignRole('super_admin');

    }
}
