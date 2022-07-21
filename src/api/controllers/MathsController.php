<?php

namespace src\api\controllers;

use src\api\Helpers;

class MathsController
{
    public static $validMathsBasicCalculator = ['addition', 'subtraction', 'division',  'multiplication'];

    public static function getBasicCalculator(array $request): array
    {
        $return = array();

        if (isset($request['op']) && !empty($request['op']) && in_array(strval($request['op']), self::$validMathsBasicCalculator)) {

            $result = floatval(0);

            switch (strval($request['op'])) {

                case 'addition':
                    if (isset($request['values']) && count($request['values']) > 0) {
                        $result = array_sum($request['values']);
                        $return = Helpers::formatResponse(200, 'Success', $result);
                    } else $return = Helpers::formatResponse(403, 'Values Not Found', []);
                    break;

                case 'subtraction':
                    if (isset($request['total']) && !empty($request['total']) && is_numeric($request['total'])) {
                        if (isset($request['values']) && count($request['values']) > 0) {

                            $result = floatval($request['total']);
                            for ($i = 0; $i < count($request['values']); $i++) $result -= $request['values'][$i];
                            $return = Helpers::formatResponse(200, 'Success', $result);
                        } else $return = Helpers::formatResponse(403, 'Values Not Found', []);
                    } else $return = Helpers::formatResponse(403, 'Total Not Found', []);
                    break;

                default:
                    $return = Helpers::formatResponse(403, 'Basic Calculator: Thx for using our function!', []);
                    break;
            }
        } else $return = Helpers::formatResponse(403, 'Operation Not Found', []);

        return $return;
    }
}
