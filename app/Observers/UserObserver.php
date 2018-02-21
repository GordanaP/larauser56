<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->slug = str_slug($user->name);
    }

    public function updating(User $user)
    {
        $user->slug = str_slug($user->name);
    }
}