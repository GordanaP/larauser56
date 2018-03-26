<?php

namespace App\Http\Controllers\User;

use App\Events\Auth\AccountCreatedByAdmin;
use App\Events\Auth\AccountUpdatedByAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AccountRequest;
use App\Role;
use App\User;
use Auth;

class AccountController extends Controller
{
    /**
     * Create new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('access', User::class);

        $roles = Role::all();
        $users = User::with('roles:name')->get();

        if (request()->ajax()) {

            return [ 'data' => $users ];
        }

        return view('users.accounts.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $this->authorize('access', User::class);

        $user = User::createAccount($request);

        event(new AccountCreatedByAdmin($user, $request->password));

        return message("A new account has been created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(request()->ajax()) {

            $this->authorize('access', User::class);

            $html = view('users.roles.partials._html', compact('user'))->render();

            return response([
                'data' => $user,
                'html' => $html
            ]);
        }

        $this->authorize('update', $user);

        return view('users.accounts.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->updateAccount($request);

        if ($request->ajax()) {

            $this->authorize('access', User::class);

            event(new AccountUpdatedByAdmin($user, $request->password));

            return message('The account has been updated');
        }

        return $this->updated($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        ! Auth::user()->isAdmin() ? Auth::logout() : '';

        $user->delete();

        if (request()->ajax()) {

            return message('The account has been deleted.');
        }

        return $this->deleted($user);
    }

    /**
     * Get the response for a successfull account update.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function updated($user)
    {
        $response = message('Your account has been saved.');

        return redirect()->route('users.accounts.edit', $user)->with($response);
    }

    /**
     * Get the response for a successfull account deletion.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function deleted($user)
    {
        $response = message('Your account has been deleted.');

        return redirect()->route('index')->with($response);
    }
}