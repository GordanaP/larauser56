<?php

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\ActivationToken::class, function (Faker $faker) {
    return [
        'user_id' => User::first()->id,
        'token' => str_limit(md5((User::first()->email).str_random()), 32),
        'expires_at' => Carbon::today()->addWeeks(2)
    ];
});
