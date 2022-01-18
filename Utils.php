<?php

namespace carbon42\phpmvc;

class Utils
{
    public static function debug($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}