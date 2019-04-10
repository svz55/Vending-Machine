<?php

use Illuminate\Database\Seeder;

class MoneyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('money')->delete();

        DB::table('money')->insert([
            [
                'price' => 1,
                'quantity' => 100,
                'type' => 'machine',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'price' => 2,
                'quantity' => 100,
                'type' => 'machine',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'price' => 5,
                'quantity' => 100,
                'type' => 'machine',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'price' => 10,
                'quantity' => 100,
                'type' => 'machine',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],

            [
                'price' => 1,
                'quantity' => 10,
                'type' => 'user',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'price' => 2,
                'quantity' => 30,
                'type' => 'user',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'price' => 5,
                'quantity' => 20,
                'type' => 'user',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
            [
                'price' => 10,
                'quantity' => 15,
                'type' => 'user',
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
        ]);
    }
}
