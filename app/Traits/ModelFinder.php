<?php

namespace App\Traits;

use App\User;
use Spatie\Permission\Models\Role;

trait ModelFinder
{
    /**
     * Fetch all users.
     *
     * @return collection App\User
     */
    // public function getUsers()
    // {
    //     return User::with('roles')->get();
    // }

    /**
     * Fetch all roles
     *
     * @return collection App\Role
     */
    protected function getRoles()
    {
        return Role::orderBy('name')->get();
    }

    /**
     * Get the specified resource
     *
     * @param  int $id
     * @return \App\Role
     */
    protected function getRole($id)
    {
        return Role::whereId($id)->first();
    }

}