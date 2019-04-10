<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    protected $guarded = ['id', 'price', 'quantity', 'type'];

    public function scopeAvailableMoneyMachine($query)
    {
        return $query->where('type', 'machine')->where('quantity', '>', 0);
    }

    public function scopeAvailableMoneyUser($query)
    {
        return $query->where('type', 'user')->where('quantity', '>', 0);
    }

    public function scopeFindByPriceType($query, $price, $type)
    {
        return $query->where('price', $price)->where('type', $type)->firstOrFail();
    }
}
