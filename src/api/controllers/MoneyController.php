<?php

namespace src\api\controllers;

use src\api\Helpers;

class MoneyController
{
    public static function getCoinChange($request)
    {
        $return = array();

        if (isset($request['total']) && !empty($request['total'])) {

            $result = array();
            $total = floatval($request['total']);

            if ($total >= -2147483648 && $total <= 2147483647) {

                $currencies = array(1000, 500, 200, 100, 50, 20, 10, 5, 2, 1, '0.5', '0.2', '0.1');

                for ($i = 0; $i < count($currencies); $i++) {

                    while ($total >= $currencies[$i]) {

                        if (!isset($result[$currencies[$i]])) $result[$currencies[$i]] = 0;

                        $total -= $currencies[$i];

                        $result[$currencies[$i]]++;
                    }
                }
                $return = Helpers::formatResponse(200, 'Coin Change: Thx for using our function!', $result);
            } else $return = Helpers::formatResponse(200, 'Total must betwwen -2147483648 and 2147483647', []);
        } else $return = Helpers::formatResponse(403, 'Key \'Total\' Not Found', []);

        return $return;
    }
}
