<?php

namespace App\Observers;

use App\ActivationToken;
use App\User;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->slug = User::uniqueNameSlug($user->name);
    }

    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        ActivationToken::generateNewFor($user);
    }
}