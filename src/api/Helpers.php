<?php

namespace src\api;

class Helpers
{
    public static array $modules = ['category', 'customer', 'supplier', 'item'];

    public static function validModule($module): bool
    {
        return in_array($module, self::$modules);
    }
    public static function dye($value): void
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        exit(1);
    }

    public static function formatResponse($status, $message, $data = []): array
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
    }

    public static function returnToAction(array $response): void
    {
        echo json_encode($response, http_response_code($response['status']));
    }

    public static function getFirstKeyName(array $array)
    {
        $keys = array_keys($array);
        return $keys[0];
    }

    public static function getFileAsArray($filename)
    {
        $fd = fopen($filename, 'r');
        $jsonData = fread($fd, filesize($filename));
        fclose($fd);

        return json_decode($jsonData, TRUE);;
    }
}
