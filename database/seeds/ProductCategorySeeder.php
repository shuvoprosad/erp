<?php

use Illuminate\Database\Seeder;
use App\ProductType;

class ProductCategorySeeder extends Seeder
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
            ['name' => 'Mobile'],
            ['name' => 'Cloth'],
            ['name' => 'Jacket'],
            ['name' => 'Camera'],
            ['name' => 'Laptop'],
        ];

        foreach ($data as $d) 
        {
            ProductType::create($d);
        }
    }
}
