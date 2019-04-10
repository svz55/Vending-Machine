<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('drinks')->delete();

        DB::table('drinks')->insert([
            [
                'name' => 'Теа',
                'code' => 'A1',
                'price' => 13,
                'quantity' => 10,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Coffee',
                'code' => 'B2',
                'price' => 18,
                'quantity' => 10,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'CoffeeMilk',
                'code' => 'C3',
                'price' => 21,
                'quantity' => 6,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'name' => 'Juice',
                'code' => 'D4',
                'price' => 35,
                'quantity' => 15,
                'is_available' => 1,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
        ]);
    }
}
