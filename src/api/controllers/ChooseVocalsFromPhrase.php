<?php

namespace src\api\controllers;

use src\api\Helpers;

class ChooseVocalsFromPhrase
{
    public static function getVocalsData(array $request) : array
    {
        $return = array();
        if (isset($request['phrase']) && !empty($request['phrase'])) {
            $vocals = array('a', 'e', 'i', 'o', 'u');
            $counter = 0;
            for ($i = 0; $i < strlen($request['phrase']); $i++) {
                if (in_array($request['phrase'][$i], $vocals) || in_array($request['phrase'][$i], self::array_change_value_case($vocals, CASE_UPPER))) {
                    $counter++;
                }
            }
            $return[$request['phrase']]['vocalsQuantity'] = $counter;
            $return = Helpers::formatResponse(200, 'Vocals Data!', $return);
        }
        return $return;
    }

    public static function array_change_value_case(array $input, $ucase) : array
    {
        $case = $ucase;
        $narray = array();
        if (!is_array($input)) {
            return $narray;
        }
        foreach ($input as $key => $value) {
            if (is_array($value)) {
                $narray[$key] = self::array_change_value_case($value, $case);
                continue;
            }
            $narray[$key] = ($case == CASE_UPPER ? strtoupper($value) : strtolower($value));
        }
        return $narray;
    }
}
