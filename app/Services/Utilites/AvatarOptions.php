<?php

namespace App\Services\Utilities;

class AvatarOptions
{
    /*
    *  A list of countries
    */
    protected static $options = [
      1 => "Upload a new avatar",
      2 => "Default"
    ];


    public static function all()
    {
        return static::$options;
    }
}