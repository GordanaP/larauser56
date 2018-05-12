<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'identifier';

    public $incrementing = false;
}
