<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 200; $i++) { 
            DB::table('customers')->insert([
                'name' => str_random(15),
                'mobile' => str_random(11),
                'address' => str_random(30),
            ]);
        }
        DB::table('customers')->insert([
            'name' => 'shuvo prosad',
            'mobile' => '01740050057',
            'address' => 'dhanmondi',
        ]);
    }
}
