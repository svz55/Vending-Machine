<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{

    protected $guarded = ['id', 'is_available', 'quantity'];

    public function scopeAvailableDrinks($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeFindByCode($query, $name)
    {
       return $query->where('code', $name)->firstOrFail();
    }

    public function vendingMachine()
    {
        return $this->belongsTo(VendingMachine::class);
    }
}
