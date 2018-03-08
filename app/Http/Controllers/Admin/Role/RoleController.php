<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Traits\ModelFinder;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    use ModelFinder;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->getRoles();

        return view('roles.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\Role\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::create($request->all());

        return message('A new role has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $role = $this->getRole($id);
        $permissions = $this->getPermissions()->pluck('name')->toArray();

        if(request()->ajax()) {

            return [
                'role' => $role
            ];
        }

        return view('roles.show', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\Role\RoleRequest  $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = $this->getRole($id);

        $role->update($request->all());

        return message('The role has been changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->getRole($id)->delete();

        return message('The role has been deleted.');
    }
}
