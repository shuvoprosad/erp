<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(UserCategorySeeder::class);
        $this->call(ProductsSeeder::class);
    }
}
