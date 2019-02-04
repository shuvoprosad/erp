<?php

use Illuminate\Database\Seeder;
use App\Status0;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status0::create([ 
            'name' => 'Accepted'
        ]);
        Status0::create([ 
            'name' => 'Rejected'
        ]);
        Status0::create([ 
            'name' => 'Pending'
        ]);
    }
}
