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
        for ($i=0; $i < 20; $i++) { 
            DB::table('customers')->insert([
                'name' => str_random(15),
                'phone' => str_random(11),
                'address' => str_random(30),
            ]);
        }
    }
}
