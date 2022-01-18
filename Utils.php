<?php

namespace app\core;

class Utils
{
    public static function debug($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}