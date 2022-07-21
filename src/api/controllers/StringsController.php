<?php

namespace src\api\controllers;

use src\api\Helpers;

class StringsController
{
    public static function getReverseString(array $request): array
    {
        $return = array();

        if (isset($request['string']) && !empty($request['string'])) {

            $result = strval('');
            $str = strval($request['string']);
            for ($i = (strlen($str) - 1); $i >= 0; $i--) $result .= $str[$i];
            $return = Helpers::formatResponse(200, 'Success', $result);
        } else $return = Helpers::formatResponse(403, 'String Not Found', []);
        return $return;
    }

    public static function getVocalsData(array $request): array
    {
        $return = array();

        if (isset($request['phrase']) && !empty($request['phrase'])) {

            $counter = 0;
            $vocals = array('a', 'e', 'i', 'o', 'u');

            for ($i = 0; $i < strlen($request['phrase']); $i++) {
                if (in_array($request['phrase'][$i], $vocals) || in_array($request['phrase'][$i], self::array_change_value_case($vocals, CASE_UPPER))) {
                    $counter++;
                }
            }

            $return[$request['phrase']]['vocalsQuantity'] = $counter;
            $return = Helpers::formatResponse(200, 'Vocals Data!', $return);
        } else $return = Helpers::formatResponse(403, 'Phrase Not Found', []);
        return $return;
    }

    public static function array_change_value_case(array $input, string $ucase): array
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

    public static function getHexOctBinFromCharacter(array $character): array
    {
        $return = array();
        if (isset($character['char']) && !empty($character['char'])) {
            if (strlen($character['char']) == 1) {
                $character = $character['char'];
                $return[$character]['DEC'] = ord($character);
                $return[$character]['HEX'] = dechex($return[$character]['DEC']);
                $return[$character]['OCT'] = decoct($return[$character]['DEC']);
                $return[$character]['BIN'] = decbin($return[$character]['DEC']);
                $return[$character]['HTML'] = '&#' . $return[$character]['DEC'] . ';';
            }else $return = Helpers::formatResponse(403, 'Character NOT SUpported Yet!', []);
        } else $return = Helpers::formatResponse(403, 'Character NOT Found', []);
        $return = Helpers::formatResponse(200, 'Results', $return);

        return $return;
    }
}
