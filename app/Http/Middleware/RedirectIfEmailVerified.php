<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Foundation\Auth\RedirectsUsers;

class RedirectIfEmailVerified
{
    use RedirectsUsers;

    /**
     * Where to redirect users after failed response.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findBy($request->email);

        if($user->isVerified())
        {
            return $this->failedResponse();
        }

        return $next($request);
    }

    /**
     * The response has failed.
     *
     * @return mixed
     */
    protected function failedResponse()
    {
        $response = message('The email is already verified.');

        return redirect($this->redirectPath())->with($response);
    }
}
