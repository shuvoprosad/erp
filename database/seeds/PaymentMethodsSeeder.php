<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;
use App\PaymentNumbers;

class PaymentMethodsSeeder extends Seeder
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
            ['name' => 'Bkash'],
            ['name' => 'Rocket'],
            ['name' => 'FlexiLoad'],
        ];
        foreach ($data as $d) 
        {
            PaymentMethod::create($d);
        }

        $data2 = 
        [
            ['mobile' => '01740050057'],
            ['mobile' => '01712123434'],
            ['mobile' => '01700000000'],
        ];

        $pm2 = PaymentMethod::where('name','Bkash')->get()->first();
        foreach ($data2 as $d) 
        {   
            $d['payment_method_id'] = $pm2->id;
            PaymentNumbers::create($d);
        }

        $data3 = 
        [
            ['mobile' => '01888888888'],
            ['mobile' => '01812123434'],
            ['mobile' => '01800000000'],
        ];

        $pm3 = PaymentMethod::where('name','Rocket')->get()->first();
        foreach ($data3 as $d) 
        {   
            $d['payment_method_id'] = $pm3->id;
            PaymentNumbers::create($d);
        }

        $data4 = 
        [
            ['mobile' => '013xxxxxxxx'],
            ['mobile' => '014xxxxxxxx'],
            ['mobile' => '019xxxxxxxx'],
        ];

        $pm4 = PaymentMethod::where('name','FlexiLoad')->get()->first();
        foreach ($data4 as $d) 
        {   
            $d['payment_method_id'] = $pm4->id;
            PaymentNumbers::create($d);
        }

    }
}
