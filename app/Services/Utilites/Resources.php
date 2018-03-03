<?php

namespace App\Services\Utilities;

class Resources
{
    /**
     * Get all resources
     *
     * @return array
     */
    public static function all()
    {
        return static::resources();
    }

    protected static function resources()
    {
        $array = getResources();

        foreach (array_keys($array, 'ActivationToken') as $key) {
            unset($array[$key]);
        }

        return $array;
    }
}