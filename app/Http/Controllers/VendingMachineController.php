<?php

namespace App\Http\Controllers;

use App\Exceptions\CodeNotFound;
use App\Exceptions\InsufficientChange;
use App\Constants\Message;
use App\Exceptions\InvalidMoneyInsertion;
use Illuminate\Http\Request;
use App\Drink;
use App\VendingMachine;
use App\Money;
use Exception;


class VendingMachineController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $vendingMachine;
    private $moneyUser;
    private $moneyMachine;

    const MAX_PER_TRANSACTION = 100;
    const AVAILABLE_MONEY = [10,5,2,1];

    /**
     * VendingMachineController constructor.
     * @param $vendingMachine
     */
    public function __construct()
    {
        $this->vendingMachine = VendingMachine::getInstance();
    }


    public function index()
    {
        $drinks = Drink::availableDrinks()->get()->toArray();
        $moneyMachine = Money::availableMoneyMachine()->get()->toArray();
        $moneyUser = Money::availableMoneyUser()->get()->toArray();

        $vendingMachine = $this->vendingMachine;
        $vendingMachine->save();
        $message = $vendingMachine->message;

        return view('VendingMachine', compact('drinks', 'vendingMachine', 'moneyMachine', 'moneyUser', 'message'));
    }

    // Добавление денег на баланс
    public function insertMoney(Request $request)
    {
        $validator = \Validator::make($request->all(),
            [
                'amount' => 'numeric',
                'amount' => 'in:1,2,5,10'
            ]
        );

        if ($validator->fails()) {
            $statusCode = 422;
            $response = [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
            return \Response::json($response, $statusCode);
        }

       if ($request->amount > 0 AND (Money::FindByPriceType($request->amount, 'user')->quantity > 0)) {
            // обновление баланса текущего пользователя
            $this->vendingMachine->inserted_money += $request->amount;
            if($this->vendingMachine->inserted_money > self::MAX_PER_TRANSACTION)
                // Общий баланс не должен превышать 100 рублей
                throw new InvalidMoneyInsertion(Message::MONEY_OVERFLOW);
            $this->vendingMachine->short_change = 0;
            $this->vendingMachine->string_change = '';
            $this->vendingMachine->save();

            $moneyUser = Money::FindByPriceType($request->amount, 'user');
            $moneyUser->quantity --;
            $moneyUser->save();

            $moneyMachine = Money::FindByPriceType($request->amount, 'machine');
            $moneyMachine->quantity ++;
            $moneyMachine->save();

        }else{
           // Неверное значение
           throw new InvalidMoneyInsertion(Message::INVALID_MONEY);
       }

      return redirect('/');
    }

    // выбирая напиток, убераем его из списка
    public function selectDrink(Request $request)
    {
        $this->validate(request(), [
            'code' => 'string']);
        $drink = null;
        try{
            $drink = Drink::findByCode($request->code);
        }catch (Exception $e){
            throw new CodeNotFound();
        }
        // Достаточно ли денег для покуаки
        $isSufficient = $this->vendingMachine->buyDrink($drink);
        if($isSufficient) {
            // удаляем напиток
            $this->vendingMachine->vendDrink($drink);
            $stringChange = $this->updateCountMoney();
            $this->vendingMachine->string_change = $stringChange;
            $this->vendingMachine->save();
        }
        else
            // Денег не хватает
            throw new InsufficientChange(Message::INSUFFICIENT);
        return redirect('/');
    }

    public function updateCountMoney()
    {
        $string = '';
        $shortChange = $this->vendingMachine->short_change;
        while ($shortChange > 0){
            foreach (self::AVAILABLE_MONEY as $money){
                a:
                if (($resDiv = intdiv($shortChange, $money)) > 0){
                    $moneyMachine = Money::FindByPriceType($money, 'machine');

                    if ($moneyMachine->quantity > 0){
                        $moneyMachine->quantity --;
                        $moneyMachine->save();

                        $moneyUser = Money::FindByPriceType($money, 'user');
                        $moneyUser->quantity ++;
                        $moneyUser->save();

                        $shortChange = $shortChange - $money;
                        $string .= $money.', ';

                        goto a;
                    }else{
                        continue;
                    }
                }
            }
        }
        return $string;
    }
}
