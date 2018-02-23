<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\RedirectsUsers;

class RedirectIfTokenExpired
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
        if($request->activationToken->hasExpired())
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
        $response = message('The activation token has expired. Click here to get a new one');

        return redirect($this->redirectPath())->with($response);
    }
}
