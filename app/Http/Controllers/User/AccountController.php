<?php

namespace App\Http\Controllers\User;

use App\Events\Auth\AccountCreatedByAdmin;
use App\Events\Auth\AccountUpdatedByAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AccountRequest;
use App\Role;
use App\Traits\ModelFinder;
use App\User;
use Auth;

class AccountController extends Controller
{
    use ModelFinder;

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
        $users = $this->getUsers();

        if (request()->ajax()) {

            return [ 'data' => $users ];
        }
    }

    public function accountsList()
    {
        $roles = $this->getRoles();

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

            $html = view('users.roles.partials._html', compact('user'))->render();

            return response([
                'data' => $user,
                'html' => $html
            ]);
        }

        return view('users.accounts.edit')->with([
            'user' => Auth::user()
        ]);
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
        if ($request->ajax()) {

            $user->updateAccount($request);

            if(! $user->isAdmin()) {
                event(new AccountUpdatedByAdmin($user, $request->password));
            }

            return message('The account has been updated');
        }

        Auth::user()->updateAccount($request);

        return $this->updated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (request()->ajax()) {

            $user->delete();

            return message('The account has been deleted.');
        }

        Auth::user()->delete();

        return $this->deleted();
    }

    /**
     * Get the response for a successfull account update.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function updated()
    {
        $response = message('Your account has been saved.');

        return redirect()->route('users.accounts.edit')->with($response);
    }

    /**
     * Get the response for a successfull account deletion.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function deleted()
    {
        $response = message('Your account has been deleted.');

        return redirect()->route('index')->with($response);
    }
}