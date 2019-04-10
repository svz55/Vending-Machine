<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    const INSUFFICIENT ="Введенная вами сумма недостаточна";
    const SNACK_DISPENSED = "Пожалуйста, заберите напиток";
    const INVALID_ENTRY = "Неверная запись, выберите код, соответствующий слоту напитка";
    const INVALID_MONEY = "Неверное значение для добавления";
    const MONEY_OVERFLOW = "Максимальная емкость - 100 рублей";
    const OUT_OF_STOCK = "Извините, выбранного вами товара нет в наличии";
    const HAVE_A_NICE_DAY = "Спасибо за покупку";
}
