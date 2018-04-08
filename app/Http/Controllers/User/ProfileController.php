<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(request()->ajax()){
            return [
                'profile' => $user->profile ?? '',
            ];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.profiles.edit')->with([
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, User $user)
    {
        if ($request->ajax()) {

            Profile::newOrUpdate($user, $request);
            return message('The profile has been saved.');
        }

        Profile::newOrUpdate(Auth::user(), $request);

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

            $user->deleteProfile();
            return message('The profile has been deleted.');
        }

        Auth::user()->deleteProfile();

        return $this->deleted();
    }

    /**
     * Get the response for the successfully updated profile.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function updated()
    {
        $response = message('Your profile has been saved.');

        return back()->with($response);
    }

    /**
     * Get the response for the successfully deleted profile.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function deleted()
    {
        $response = message('Your profile has been deleted.');

        return back()->with($response);
    }
}
