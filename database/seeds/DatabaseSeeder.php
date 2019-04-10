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
        //$this->call(UsersTableSeeder::class);
        $this->call(VendingMachineSeeder::class);
        $this->call(DrinkTableSeeder::class);
        $this->call(MoneyTableSeeder::class);
    }
}
