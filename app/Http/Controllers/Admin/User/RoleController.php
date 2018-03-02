<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\RoleRequest  $request
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
        return [
            'role' => $this->getRole($id)
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\RoleRequest  $request
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->getRole($id)->update($request->all());

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
