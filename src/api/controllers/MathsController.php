<?php

namespace src\api\controllers;

use src\api\Helpers;

class MathsController
{
    public static $validMathsBasicCalculator = ['addition', 'subtraction', 'division', 'multiplication'];

    private static function getMathsCalculatorSign(string $op): string
    {
        switch ($op) {
            case 'addition':
                $return = '+';
                break;
            case 'subtraction':
                $return = '-';
                break;
            case 'division':
                $return = '/';
                break;
            case 'multiplication':
                $return = '*';
                break;
            default:
                $return = strval('');
                break;
        }

        return $return;
    }

    public static function getBasicCalculator(array $request): array
    {
        $return = array();
        if (isset($request['op']) && !empty($request['op']) && in_array(strval($request['op']), self::$validMathsBasicCalculator)) {
            $result = floatval(0);
            if (!isset($request['base']) || !is_numeric($request['base']) || !isset($request['values']) || count($request['values']) == 0) $return = Helpers::formatResponse(403, 'Basic Calculator: Thx for using our function!', []);
            else {
                $result = floatval($request['base']);
                for ($i = 0; $i < count($request['values']); $i++) $result = eval("return " . $result . self::getMathsCalculatorSign(strval($request['op'])) . $request['values'][$i] . " ;");
                $return = Helpers::formatResponse(200, 'Success', $result);
            }
        } else $return = Helpers::formatResponse(403, 'Operation Not Found', []);

        return $return;
    }

    public static function getCalcMultiplicateTableForXNumber(array $request): array
    {
        $return = strval('');
        if (isset($request['number'])) {
            for ($i = 1; $i <= 10; $i++) $result[$request['number']][] = $request['number'] . ' X ' . $i . ' = ' . intval($request['number']) * $i;
            $return = Helpers::formatResponse(200, 'Success', $result);
        } else $return = Helpers::formatResponse(403, 'Key \'number\' Not Found', []);

        return $return;
    }

    public static function getReorderNumbers(array $request): array
    {
        $return = array();
        if (isset($request['numbers']) && is_array($request['numbers']) && count($request['numbers']) > 0) {
            $numbers = $request['numbers'];
            $size = count($numbers) - 1;
            $out = [];
            $out2 = [];
            for ($i = 0; $i <= $size; $i++) {
                for ($e = 0; $e <= $size; $e++) {
                    if ($numbers[$i] > $numbers[$e]) {
                        $tmp = $numbers[$i];
                        $numbers[$i] = $numbers[$e];
                        $numbers[$e] = $tmp;
                        $out = $numbers;
                    }
                }
            }
            for ($i = 0; $i <= $size; $i++) {
                for ($e = 0; $e <= $size; $e++) {
                    if ($numbers[$i] < $numbers[$e]) {
                        $tmp = $numbers[$i];
                        $numbers[$i] = $numbers[$e];
                        $numbers[$e] = $tmp;
                        $out2 = $numbers;
                    }
                }
            }
            $result['Major2Minus'] = $out;
            $result['Minus2Major'] = $out2;
            $return = Helpers::formatResponse(200, 'Success', $result);
        } else $return = Helpers::formatResponse(403, 'Key \'numbers\' Not Found', []);

        return $return;
    }
}
