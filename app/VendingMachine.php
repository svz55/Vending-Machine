<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Drink;


class VendingMachine extends Model
{
    private static $instance;
    private static $message;
    /**
     * VendingMachine constructor.
     */


    //  singleton
    public static function getInstance()
    {
        self::$message = '';

        if (!isset(self::$instance)) {
            self::$instance = VendingMachine::find(1)->first();
        }
        return self::$instance;

    }

    public function drink(){
        return $this->hasMany(Drink::class, 'vending_machine_id');
    }

    // Покупка напитка
    public function  buyDrink($drink){

        $instance = self::getInstance();
        if($instance->inserted_money >= $drink->price ) {
            $instance->short_change = $instance->inserted_money - $drink->price;
            $instance->inserted_money = 0;
            $instance->save();
            return true;
        }
        return false;

    }
    // уменьшаем количество и обновляем  флаг доступности напитка
    public function vendDrink($drink){
        $drink->quantity -= 1;
        $drink->is_available = $drink->quantity > 0 ? 1 : 0;
        $drink->save();
    }


}
