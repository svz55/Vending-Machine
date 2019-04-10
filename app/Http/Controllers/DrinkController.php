<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;

class DrinkController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drinks = Drink::availableDrinks()->get()->toArray();
        return response()->json([
            'results' => $drinks
        ]);
    }
}
