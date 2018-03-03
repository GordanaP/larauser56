<?php

namespace App\Services\Utilities;

class Cruds
{
    /*
    *  A list of crud methods
    */
    protected static $methods = [
        'create' => "Create",
        'read' => "Read",
        'update' => "Update",
        'delete' => "Delete",
    ];

    /**
     * Get all crud methods
     *
     * @return array
     */
    public static function all()
    {
        return static::$methods;
    }
}