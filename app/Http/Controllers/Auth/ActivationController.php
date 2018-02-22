<?php

namespace App\Http\Controllers\Auth;

use App\ActivationToken;
use App\Events\Auth\EmailVerified;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function show(ActivationToken $activationToken)
    {
        $activationToken->user->verifyEmail();

        event(new EmailVerified($activationToken->user));

        return $this->verified();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivationToken $activationToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivationToken $activationToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivationToken $activationToken)
    {
        //
    }

    /**
     * Get the response for a successfull email verification.
     *
     * @return mixed
     */
    protected function verified()
    {
        $response = message('Your account is now active. Please sign in to access the site content');

        return redirect($this->redirectPath())->with($response);
    }
}
