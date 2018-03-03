<?php

namespace App\Traits;

use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait ModelFinder
{
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
     * Get the specified role
     *
     * @param  int $id
     * @return \App\Role
     */
    protected function getRole($id)
    {
        return Role::whereId($id)->first();
    }

        /**
     * Fetch all roles
     *
     * @return collection App\Role
     */
    protected function getPermissions()
    {
        return Permission::orderBy('name')->get();
    }

    /**
     * Get the specified role
     *
     * @param  int $id
     * @return \App\Role
     */
    protected function getPermission($id)
    {
        return Permission::whereId($id)->firstOrFail();
    }

}