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
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");

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

        $admin_role = Role::create([ 'name' => 'super_admin',
                                'guard_name' => 'web'
                            ]);
        
        $admin = User::findOrFail(1);

        $admin->assignRole('super_admin');

        DB::statement("SET FOREIGN_KEY_CHECKS = 1");

        DB::commit();
    }
}
