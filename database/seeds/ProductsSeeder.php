<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([ 
            'category_id' => '1',
            'name' => 'Nokia 2',
            'description' => 'Nokia mobile is the ...',
            'sku' => 'MBH-02',
            'buy_price' => '7000',
            'sell_price' => '8500',
            'units_in_stock' => '12',
            'units_in_shipping' => '2',
            'note' => 'high in demand',
        ]);
        Product::create([ 
            'category_id' => '1',
            'name' => 'Nokia 2',
            'description' => 'Nokia mobile is the ...',
            'sku' => 'MBH-02',
            'buy_price' => '7000',
            'sell_price' => '8500',
            'units_in_stock' => '12',
            'units_in_shipping' => '2',
            'note' => 'high in demand',
        ]);
        Product::create([ 
            'category_id' => '1',
            'name' => 'Samsung s8',
            'description' => 'Samsung mobile is the ...',
            'sku' => 'SAM-04',
            'buy_price' => '86000',
            'sell_price' => '90000',
            'units_in_stock' => '5',
            'units_in_shipping' => '2',
            'note' => 'high in demand',
        ]);
        Product::create([ 
            'category_id' => '1',
            'name' => 'Iphone xs',
            'description' => 'Apple ...',
            'sku' => 'IPO-02',
            'buy_price' => '99000',
            'sell_price' => '120000',
            'units_in_stock' => '5',
            'units_in_shipping' => '1',
            'note' => 'high in demand',
        ]);
    }
}
