<?php

namespace src\api\controllers;

use src\api\Helpers;

class MoneyController
{
    public static function postCoinChange($request)
    {
        $return = array();
        $total = intval($request['total']);
        $currencies = array(100, 500, 200, 100, 50, 20, 10, 5, 2, 1);

        for ($i = 0; $i < count($currencies); $i++) {

            while ($total >= $currencies[$i]) {

                $total -= $currencies[$i];

                if (!isset($return[$currencies[$i]])) $return[$currencies[$i]] = 0;

                $return[$currencies[$i]]++;
            }
        }
        return Helpers::formatResponse(200, 'CoinChange: Thx for using our function!', $return);
    }
}
