<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserCategorySeeder extends Seeder
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
            ['name' => 'Manager'],
            ['name' => 'Office employee'],
            ['name' => 'Call centre employee'],
            ['name' => 'Team lead'],
        ];

        foreach ($data as $d) 
        {
            UserType::create($d);
        }
    }
}
