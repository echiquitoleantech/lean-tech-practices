<?php

namespace src\api\controllers;

use src\api\Helpers;

class GeometricFigures
{
    public static function getGeometricFigureData($request)
    {
        $return = array();

        if (isset($request['figures']) && !empty($request['figures'])) {
            foreach ($request['figures'] as $key => $figure) {
                switch ($figure['figure']) {
                    case 'square':
                        $return[] = self::calcSquareAreaAndPerimeter($figure['figure'], $figure['side']);
                        break;
                    case 'triangle':
                        $return[] = self::calcTriangleAreaAndPerimeter($figure['figure'], $figure['sideA'], $figure['sideB'], $figure['sideC'], $figure['base'], $figure['height']);
                        break;
                    case 'circle':
                        $return[] = self::calcCircleAreaAndPerimeter($figure['figure'], $figure['radio']);
                        break;
                    case 'trapeze':
                        $return[] = self::calcTrapezeAreaAndPerimeter($figure['figure'], $figure['baseB'], $figure['baseb'], $figure['height'], $figure['sideA'], $figure['sideB']);
                        break;
                    default:
                        # code...
                        break;
                }
            }


            $return = Helpers::formatResponse(200, 'Square Data!', $return);
        } else $return = Helpers::formatResponse(403, 'Key \'figure\' Not Found', []);

        return $return;
    }

    public static function calcSquareAreaAndPerimeter($figure, $a)
    {
        $area = 0;
        $perimeter = 0;

        if (isset($a) && !empty($a)) {
            $perimeter = 4 * floatval($a);
            $area = pow(floatval($a), 2);
            $result[$figure]['area'] = $area;
            $result[$figure]['perimeter'] = $perimeter;
            $return = Helpers::formatResponse(200, 'Square Data!', $result);
        } else $return = Helpers::formatResponse(403, 'Data Not Found', []);

        return $return;
    }

    public static function calcCircleAreaAndPerimeter($figure, $a)
    {
        $area = 0;
        $perimeter = 0;

        if (isset($a) && !empty($a)) {
            $perimeter = 2 * pi() * floatval($a);
            $area = pi() * pow(floatval($a), 2);
            $result[$figure]['area'] = $area;
            $result[$figure]['perimeter'] = $perimeter;
            $return = Helpers::formatResponse(200, 'Circle Data!', $result);
        } else $return = Helpers::formatResponse(403, 'Data Not Found', []);

        return $return;
    }

    public static function calcTriangleAreaAndPerimeter($figure, $a, $b, $c, $base, $height)
    {
        $area = 0;
        $perimeter = 0;

        if (isset($a) && !empty($a)) {
            $perimeter = floatval($a) + floatval($b) + floatval($c);
            $area = floatval($base) * floatval($height) / 2;
            $result[$figure]['area'] = $area;
            $result[$figure]['perimeter'] = $perimeter;
            $return = Helpers::formatResponse(200, 'Triangle Data!', $result);
        } else $return = Helpers::formatResponse(403, 'Data Not Found', []);

        return $return;
    }
    public static function calcTrapezeAreaAndPerimeter($figure, $baseB, $baseb, $height, $sideA, $sideB)
    {
        $area = 0;
        $perimeter = 0;

        if (isset($baseB) && !empty($baseB)) {
            $perimeter = floatval($sideA) + floatval($baseB) + floatval($baseb) + floatval($sideB);
            $area = (floatval($baseB) + floatval($baseb)) * floatval($height) / 2;
            $result[$figure]['area'] = $area;
            $result[$figure]['perimeter'] = $perimeter;
            $return = Helpers::formatResponse(200, 'Trapeze Data!', $result);
        } else $return = Helpers::formatResponse(403, 'Data Not Found', []);

        return $return;
    }
}
