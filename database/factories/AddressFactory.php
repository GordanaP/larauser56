<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {

    $id = User::first()->id;

    return [
        'identifier' => hash('sha256', $id .config('app.key')),
        'shipping' => $faker->address
    ];

});