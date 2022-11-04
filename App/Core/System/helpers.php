<?php

/**
 *
 * Dump and Die
 * @param $arg
 * @return void
 *
 */
function dd($arg)
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";

    die;
}

function camelToUnderscore($string, $us = "_"): string
{
    return strtolower(preg_replace('/(?<!^)[A-Z]+|(?<!^|\d)[\d]+/', $us . '$0', $string));
}