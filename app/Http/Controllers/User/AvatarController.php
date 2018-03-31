<?php

namespace App\Http\Controllers\User;

use App\Avatar;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\User;

class AvatarController extends Controller
{
    protected $avatarPath = 'images/avatars';

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(request()->ajax()) {
            return response([
                'filename' => optional($user->avatar)->filename
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.avatars.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AvatarRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AvatarRequest $request, User $user)
    {
        Avatar::newOrUpdate($user, $request, public_path($this->avatarPath));

        if($request->ajax()) {
            return message('The avatar has been saved.');
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
        //
    }

    /**
     * Get the response for the successfully updated avatar.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function updated($user)
    {
        $response = message('Your avatar has been saved.');

        return back()->with($response);
    }
}
