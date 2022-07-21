<?php

namespace src\api\controllers;

use src\api\Helpers;

class GeometricFigures
{
    public static function getGeometricFigureData($request)
    {
        $return = array();

        if (isset($request['figure']) && !empty($request['figure'])) {
            if (isset($request['side']) && !empty($request['side'])) {
                /*$return_value = match ($request['figure']) {
                    'square' == self::calcSquareAreaAndPerimeter($request['side'])
                };*/
                switch ($request['figure']) {
                    case 'square':
                        $return_value = self::calcSquareAreaAndPerimeter($request['side']);
                        break;
                    
                    default:
                        # code...
                        break;
                }
                $return = Helpers::formatResponse(200, 'Square Data!', $return_value);
            } else $return = Helpers::formatResponse(403, 'Key \'side\' Not Found', []);

        
        } else $return = Helpers::formatResponse(403, 'Key \'figure\' Not Found', []);

        return $return;
    }

    public static function calcSquareAreaAndPerimeter($a)
    {
        $area = 0;
        $perimeter = 0;

        if (isset($a) && !empty($a)) {
            $perimeter = 4 * $a;
            $area = pow($a, 2);
            $result['squareArea'] = $area;
            $result['squarePerimeter'] = $perimeter;
            $return = Helpers::formatResponse(200, 'Square Data!', $result);
        } else $return = Helpers::formatResponse(403, 'Data Not Found', []);

        return $return;
    }
}

?>