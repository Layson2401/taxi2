<?php

declare(strict_types = 1);

namespace App\Core\System;

class Helper
{
    public static function camelToUnderscore($string, $us = "_"): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]+|(?<!^|\d)[\d]+/', $us . '$0', $string));
    }

    public static function randomString(int $length): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        for ($i = 0; $i < $length; $i++) {
            $randString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randString;
    }
}