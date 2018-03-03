<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permission\PermissionCollection;
use App\Http\Resources\Permission\PermissionResource;
use App\Traits\ModelFinder;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    use ModelFinder;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->getPermissions();

        return PermissionCollection::collection($permissions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->getPermission($id);

        return new PermissionResource($permission);

    }

}
