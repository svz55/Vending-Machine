<?php

use Illuminate\Database\Seeder;

class VendingMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vending_machines')->delete();

        DB::table('vending_machines')->insert([
            [
                'id'=>'1',
                'short_change' => 0,
                'string_change' => '',
                'inserted_money' => 0.0,
                'created_at'=> NOW(),
                'updated_at'=>NOW(),
            ],
        ]);
    }
}
