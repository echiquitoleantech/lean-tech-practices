<?php

namespace src\api\controllers;

use src\api\Helpers;

class ShoppingCartController
{
    public static function getDetails(array $request): array
    {
        $return = array();
        if (isset($request) && count($request) > 0) {
        } else $return = Helpers::formatResponse(403, 'Request Not Found', []);
        return $return;
    }
    public static function postItem(array $request): array
    {
        $return = array();
        if (isset($request) && count($request) > 0) {
        } else $return = Helpers::formatResponse(403, 'Request Not Found', []);
        return $return;
    }
    public static function putItem(array $request): array
    {
        $return = array();
        if (isset($request) && count($request) > 0) {
        } else $return = Helpers::formatResponse(403, 'Request Not Found', []);
        return $return;
    }
    public static function patchItem(array $request): array
    {
        $return = array();
        if (isset($request) && count($request) > 0) {
        } else $return = Helpers::formatResponse(403, 'Request Not Found', []);
        return $return;
    }
    public static function deleteItem(array $request): array
    {
        $return = array();
        if (isset($request) && count($request) > 0) {
        } else $return = Helpers::formatResponse(403, 'Request Not Found', []);
        return $return;
    }
}
